<?php

namespace App\Http\Controllers;

use App\Models\Kostum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminKostumController extends Controller
{
    // 1. TAMPILKAN SEMUA DATA (READ)
    public function index()
    {
        // Ambil data terbaru, paginasi 10 per halaman
        $kostums = Kostum::latest()->paginate(10);
        return view('admin.kostum.index', compact('kostums'));
    }

    // 2. FORM TAMBAH DATA (CREATE)
    public function create()
    {
        return view('admin.kostum.create');
    }

    // 3. SIMPAN DATA KE DATABASE (STORE)
    public function store(Request $request)
    {
        // Validasi Input
        $request->validate([
            'nama'      => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga'     => 'required|numeric',
            'stok'      => 'required|integer',
            'kategori'  => 'required|string',
            'gambar'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB
        ]);

        $data = $request->all();

        // Proses Upload Gambar
        if ($request->hasFile('gambar')) {
            // Simpan ke folder 'public/kostums'
            $path = $request->file('gambar')->store('kostums', 'public');
            $data['gambar'] = 'storage/' . $path;
        }

        Kostum::create($data);

        return redirect()->route('admin.kostum.index')->with('success', 'Kostum berhasil ditambahkan!');
    }

    // 4. FORM EDIT DATA (EDIT)
    public function edit($id)
    {
        $kostum = Kostum::findOrFail($id);
        return view('admin.kostum.edit', compact('kostum'));
    }

    // 5. UPDATE DATA KE DATABASE (UPDATE)
    public function update(Request $request, $id)
    {
        $kostum = Kostum::findOrFail($id);

        $request->validate([
            'nama'      => 'required|string|max:255',
            'harga'     => 'required|numeric',
            'stok'      => 'required|integer',
            'gambar'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        // Cek jika ada gambar baru yang diupload
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($kostum->gambar && file_exists(public_path($kostum->gambar))) {
                // Modifikasi path agar sesuai dengan path file fisik jika perlu
                // Atau gunakan Storage::disk('public')->delete(...) jika path sesuai storage
                $pathLama = str_replace('storage/', '', $kostum->gambar);
                Storage::disk('public')->delete($pathLama);
            }

            $path = $request->file('gambar')->store('kostums', 'public');
            $data['gambar'] = 'storage/' . $path;
        }

        $kostum->update($data);

        return redirect()->route('admin.kostum.index')->with('success', 'Data kostum berhasil diperbarui!');
    }

    // 6. HAPUS DATA (DESTROY)
    public function destroy($id)
    {
        $kostum = Kostum::findOrFail($id);

        // Hapus file gambar dari server
        if ($kostum->gambar) {
            $pathLama = str_replace('storage/', '', $kostum->gambar);
            Storage::disk('public')->delete($pathLama);
        }

        $kostum->delete();

        return redirect()->route('admin.kostum.index')->with('success', 'Kostum berhasil dihapus.');
    }
}
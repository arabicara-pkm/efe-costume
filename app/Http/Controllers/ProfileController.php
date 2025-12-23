<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User; // Tambahkan ini agar lebih jelas

class ProfileController extends Controller
{
    // 1. TAMPILKAN HALAMAN PROFIL
    public function edit()
    {
        $user = Auth::user();
        return view('profil', compact('user'));
    }

    // 2. SIMPAN PERUBAHAN
    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        // Baris di atas ^ memberitahu VS Code bahwa $user adalah Model User, bukan user biasa.
        $user = Auth::user();

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB
        ]);

        // Update data teks
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;

        // Cek jika ada upload foto baru
        if ($request->hasFile('avatar')) {
            
            // Hapus foto lama jika ada (Pakai disk 'public' agar aman)
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            
            // Simpan foto baru ke folder 'avatars' di disk 'public'
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        $user->save(); // Simpan ke database

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}
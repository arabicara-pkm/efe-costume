<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kostum;

class CatalogController extends Controller
{
    // 1. HALAMAN KATALOG (DAFTAR SEMUA KOSTUM)
    // Fungsi ini dipanggil saat membuka /katalog
    public function index()
    {
        // Ambil semua data kostum dari database
        $kostums = Kostum::all(); 

        // Kirim data tersebut ke view 'katalog.blade.php'
        return view('katalog', compact('kostums'));
    }

    // 2. HALAMAN DETAIL (SATU KOSTUM)
    // Fungsi ini dipanggil saat membuka /kostum/{id}
    public function show($id)
    {
        // Cari kostum berdasarkan ID, kalau tidak ada tampilkan error 404
        $kostum = Kostum::findOrFail($id);

        // Kirim data tersebut ke view 'detail.blade.php'
        return view('detail', compact('kostum'));
    }
}
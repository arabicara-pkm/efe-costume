<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order; // <--- KITA PAKAI ORDER SEKARANG

class AdminController extends Controller
{
    public function index()
    {
        // 1. Hitung Total Member (User biasa)
        $totalUser = User::where('role', 'member')->count();

        // 2. Hitung Total Pendapatan
        // Mengambil jumlah kolom 'total_harga' dari tabel orders
        $totalPendapatan = Order::where('status', '!=', 'menunggu_bayar')->sum('total_harga');

        // 3. Hitung Pesanan Aktif (Yang sedang diproses/disewa)
        $pesananAktif = Order::where('status', 'diproses')->count();

        // Kirim ke view
        return view('admin.dashboard', compact('totalUser', 'totalPendapatan', 'pesananAktif'));
    }
}
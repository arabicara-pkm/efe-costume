<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    // 1. TAMPILKAN PESANAN SAYA
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->with('kostum')->latest()->get();
        return view('pesanan', compact('orders'));
    }

    // 2. PROSES CHECKOUT (Dari Keranjang ke Order)
    public function checkout()
    {
        $userId = Auth::id();
        $carts = Cart::where('user_id', $userId)->get();

        if($carts->isEmpty()) {
            return back()->with('error', 'Keranjang kosong!');
        }

        foreach($carts as $item) {
            // Hitung Total Harga per Item
            $totalHarga = $item->kostum->harga * $item->jumlah_hari;

            Order::create([
                'invoice_number' => 'INV-' . strtoupper(Str::random(6)),
                'user_id' => $userId,
                'kostum_id' => $item->kostum_id,
                'tanggal_sewa' => $item->tanggal_sewa,
                'tanggal_kembali' => $item->tanggal_kembali,
                'ukuran' => $item->ukuran,
                'total_harga' => $totalHarga,
                'status' => 'diproses', // Anggap langsung sukses dulu
            ]);
        }

        // Kosongkan Keranjang setelah Checkout
        Cart::where('user_id', $userId)->delete();

        return redirect()->route('order.index')->with('success', 'Pesanan berhasil dibuat!');
    }
}
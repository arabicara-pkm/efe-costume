<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Kostum;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; // Untuk hitung tanggal

class CartController extends Controller
{
    // 1. TAMPILKAN KERANJANG
    public function index()
    {
        $userId = Auth::id();
        $carts = Cart::where('user_id', $userId)->with('kostum')->get();

        // Hitung Subtotal
        $subtotal = 0;
        foreach($carts as $item) {
            // Harga x Jumlah Hari
            $subtotal += $item->kostum->harga * $item->jumlah_hari;
        }

        return view('keranjang', compact('carts', 'subtotal'));
    }

    // 2. TAMBAH KE KERANJANG
    public function store(Request $request, $kostumId)
    {
        $request->validate([
            'tanggal_sewa' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_sewa',
            'ukuran' => 'required',
        ]);

        // Hitung durasi hari
        $start = Carbon::parse($request->tanggal_sewa);
        $end = Carbon::parse($request->tanggal_kembali);
        $days = $start->diffInDays($end) + 1; // Minimal 1 hari

        Cart::create([
            'user_id' => Auth::id(),
            'kostum_id' => $kostumId,
            'tanggal_sewa' => $request->tanggal_sewa,
            'tanggal_kembali' => $request->tanggal_kembali,
            'ukuran' => $request->ukuran,
            'jumlah_hari' => $days
        ]);

        return redirect()->route('cart.index')->with('success', 'Berhasil masuk keranjang!');
    }

    // 3. HAPUS ITEM
    public function destroy($id)
    {
        Cart::destroy($id);
        return back()->with('success', 'Item dihapus.');
    }
}
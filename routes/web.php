<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminKostumController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;

// ====================================================
// 1. ROUTE PUBLIK (Bisa diakses siapa saja)
// ====================================================

// Halaman Utama
Route::get('/', [HomeController::class, 'index'])->name('home');

// Katalog & Detail Kostum (Biasanya bisa dilihat tamu juga)
Route::get('/katalog', [CatalogController::class, 'index'])->name('katalog');
Route::get('/kostum/{id}', [CatalogController::class, 'show'])->name('kostum.detail');


// ====================================================
// 2. ROUTE TAMU (Hanya yang BELUM Login)
// ====================================================
Route::middleware('guest')->group(function () {
    // Register
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'registerUser'])->name('register.submit');

    // Login
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'loginUser'])->name('login.submit');
});


// ====================================================
// 3. ROUTE MEMBER / AUTH (Harus SUDAH Login)
// ====================================================
Route::middleware('auth')->group(function () {
    
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard User Biasa
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // --- Fitur Keranjang ---
    Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index');
    Route::post('/keranjang/add/{id}', [CartController::class, 'store'])->name('cart.add');
    Route::delete('/keranjang/delete/{id}', [CartController::class, 'destroy'])->name('cart.delete');

    // --- Fitur Notifikasi ---
    Route::get('/notifikasi', [NotificationController::class, 'index'])->name('notifikasi.index');

    // --- Fitur Pesanan / Checkout ---
    Route::get('/pesanan', [OrderController::class, 'index'])->name('order.index');
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout.process');

    // --- Fitur Profil ---
    Route::get('/profil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profil', [ProfileController::class, 'update'])->name('profile.update');

});


// ====================================================
// 4. ROUTE KHUSUS ADMIN (Login + Role Admin)
// ====================================================
Route::middleware(['auth', 'isAdmin'])->prefix('admin')->group(function () {
    
    // Dashboard Admin (URL: /admin/dashboard)
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('kostum', AdminKostumController::class, ['as' => 'admin']);

    // Nanti tambahkan route kelola barang disini...
    // Contoh: Route::resource('kostums', AdminKostumController::class);

});
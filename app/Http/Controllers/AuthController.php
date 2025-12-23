<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; // Penting untuk Login

class AuthController extends Controller
{
    // === BAGIAN REGISTER (DAFTAR) ===
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function registerUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // === BAGIAN LOGIN (MASUK) - BARU ===
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function loginUser(Request $request)
    {
        // 1. Validasi input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Coba Login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // === LOGIKA PENGECEKAN ROLE ===
            // Cek apakah user yang login memiliki role 'admin'
            if (Auth::user()->role === 'admin') {
                // Jika Admin, arahkan ke route admin dashboard
                return redirect()->intended(route('admin.dashboard')); 
                // Atau bisa pakai path: return redirect()->intended('/admin/dashboard');
            }

            // Jika Member biasa, arahkan ke dashboard biasa
            return redirect()->intended(route('dashboard'));
        }

        // 3. Jika Gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    // === BAGIAN LOGOUT (KELUAR) ===
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
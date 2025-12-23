<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        // Ambil notifikasi milik user yang sedang login
        $notifications = Auth::user()->notifications;

        // Tandai semua sebagai "Sudah Dibaca" saat halaman dibuka
        Auth::user()->unreadNotifications->markAsRead();

        return view('notifikasi', compact('notifications'));
    }
}
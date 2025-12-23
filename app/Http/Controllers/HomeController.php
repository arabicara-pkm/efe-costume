<?php

namespace App\Http\Controllers;

use App\Models\Kostum;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil 3 data kostum terbaru
        // latest() = urut dari yang paling baru diinput
        // take(3)  = ambil 3 saja
        // get()    = eksekusi query
        $kostums = Kostum::latest()->take(3)->get(); 
        
        return view('welcome', compact('kostums'));
    }
}

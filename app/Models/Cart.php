<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relasi ke Kostum (Agar bisa ambil nama, gambar, harga)
    public function kostum()
    {
        return $this->belongsTo(Kostum::class);
    }
}
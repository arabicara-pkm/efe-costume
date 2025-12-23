<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kostum extends Model
{
    use HasFactory;
    protected $table = 'kostums';

    protected $guarded = [];

    // Relasi ke Cart (Agar bisa tahu kostum ini ada di keranjang siapa)
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    // Relasi ke Order (Agar bisa tahu kostum ini ada di orderan siapa)
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}

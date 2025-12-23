<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Relasi ke Kostum
    public function kostum()
    {
        return $this->belongsTo(Kostum::class);
    }
}
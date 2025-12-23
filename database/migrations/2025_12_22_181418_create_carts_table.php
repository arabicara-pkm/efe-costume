<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('carts', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        
        // PERBAIKAN DI SINI:
        // Kita paksa Laravel membaca tabel 'kostums'
        $table->foreignId('kostum_id')->constrained('kostums')->onDelete('cascade'); 
        
        $table->date('tanggal_sewa');
        $table->date('tanggal_kembali');
        $table->string('ukuran');
        $table->integer('jumlah_hari');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
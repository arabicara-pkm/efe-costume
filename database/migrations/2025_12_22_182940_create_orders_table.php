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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number'); 
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // PERBAIKAN DI SINI:
            // Tambahkan 'kostums' di dalam kurung constrained()
            $table->foreignId('kostum_id')->constrained('kostums'); 
            
            $table->date('tanggal_sewa');
            $table->date('tanggal_kembali');
            $table->string('ukuran');
            $table->integer('total_harga');
            $table->string('status')->default('menunggu_bayar'); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kostum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ==========================================
        // 1. MEMBUAT USER (Admin & Member)
        // ==========================================
        
        // Akun Admin
        User::factory()->create([
            'name' => 'Admin Utama',
            'email' => 'admin@efe.com',
            'role' => 'admin',
            'password' => bcrypt('admin123'),
        ]);

        // Akun Member Biasa
        User::factory()->create([
            'name' => 'Member Test',
            'email' => 'member@efe.com',
            'role' => 'member',
            'password' => bcrypt('password123'),
        ]);

        // ==========================================
        // 2. MEMBUAT DATA KOSTUM DUMMY (LENGKAP)
        // ==========================================
        
        // 1. Tari Jaipong (Sunda)
        Kostum::create([
            'nama' => 'Kostum Tari Jaipong',
            'deskripsi' => 'Kostum feminim elegan khas Sunda dengan warna cerah (merah/ungu) dan selendang sampur yang indah. Cocok untuk pentas seni enerjik.',
            'harga' => 150000,
            'stok' => 5,
            'kategori' => 'Tari Sunda',
            'gambar' => 'images/tarijaipong.jpg',
        ]);
        
        // 2. Tari Kecak (Bali)
        Kostum::create([
            'nama' => 'Kostum Penari Kecak',
            'deskripsi' => 'Busana khas penari Kecak Bali dengan kain kotak-kotak poleng yang ikonik dan udeng. Simpel namun penuh makna spiritual.',
            'harga' => 120000,
            'stok' => 15, // Stok banyak karena biasanya berkelompok
            'kategori' => 'Tari Bali',
            'gambar' => 'images/tarikecak.jpg', 
        ]);

        // 3. Tari Merak (Sunda/Jawa)
        Kostum::create([
            'nama' => 'Kostum Tari Merak',
            'deskripsi' => 'Kostum memukau dengan sayap lebar bermotif bulu merak yang indah. Dilengkapi mahkota berbentuk kepala burung merak. Sangat artistik.',
            'harga' => 185000,
            'stok' => 3,
            'kategori' => 'Tari Sunda',
            'gambar' => 'images/tarimerak.jpg',
        ]);

        // 4. Tari Pendet (Bali)
        Kostum::create([
            'nama' => 'Kostum Tari Pendet',
            'deskripsi' => 'Busana tari penyambutan khas Bali dengan hiasan bunga emas di kepala dan kain prada yang mewah. Melambangkan keanggunan.',
            'harga' => 165000,
            'stok' => 6,
            'kategori' => 'Tari Bali',
            'gambar' => 'images/taripendet.jpg',
        ]);

        // 5. Tari Piring (Sumatera)
        Kostum::create([
            'nama' => 'Kostum Tari Piring',
            'deskripsi' => 'Baju kurung adat Minangkabau dengan warna merah dan emas yang menyala. Paket termasuk properti piring plastik aman.',
            'harga' => 140000,
            'stok' => 8,
            'kategori' => 'Tari Sumatera',
            'gambar' => 'images/taripiring.png',
        ]);

        // 6. Tari Wayang / Topeng (Jawa)
        Kostum::create([
            'nama' => 'Kostum Tari Wayang Topeng',
            'deskripsi' => 'Busana tari klasik Jawa dengan detail bordir rumit dan selendang panjang. Cocok untuk karakter satria atau kelana. (Topeng disewakan terpisah).',
            'harga' => 175000,
            'stok' => 4,
            'kategori' => 'Tari Jawa',
            'gambar' => 'images/tariwayang.jpg',
        ]);
    }
}
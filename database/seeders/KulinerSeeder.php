<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KulinerSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        // ✅ Hapus data lama dulu
        DB::table('kuliners')->truncate();

        // ✅ Insert 5 produk garam ke tabel kuliners dengan nomor_hp dan user_id
        DB::table('kuliners')->insert([
            [
                'image' => 'garam-konsumsi.jpg',
                'title' => 'Garam Konsumsi Premium',
                'alamat' => 'Pinggir Papas, Sumenep',
                'price' => 15000,
                'text' => 'Garam murni berkualitas tinggi untuk konsumsi sehari-hari. Telah tersertifikasi SNI dan aman dikonsumsi.',
                'nomor_hp' => '081234567890',
                'user_id' => 1,  // ✅ TAMBAHKAN user_id
                'published_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'image' => 'garam-gfk.jpg',
                'title' => 'Garam Fortifikasi Kelor (GFK)',
                'alamat' => 'Pinggir Papas, Sumenep',
                'price' => 25000,
                'text' => 'Garam diperkaya dengan nutrisi daun kelor. Kaya akan vitamin A, zat besi, dan kalsium untuk kesehatan keluarga.',
                'nomor_hp' => '081234567890',
                'user_id' => 1,  // ✅ TAMBAHKAN user_id
                'published_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'image' => 'garam-industri.jpg',
                'title' => 'Garam Industri',
                'alamat' => 'Pinggir Papas, Sumenep',
                'price' => 8000,
                'text' => 'Garam berkualitas untuk kebutuhan industri, pabrik, dan pengolahan makanan skala besar.',
                'nomor_hp' => '081234567890',
                'user_id' => 1,  // ✅ TAMBAHKAN user_id
                'published_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'image' => 'garam-spa.jpg',
                'title' => 'Garam SPA',
                'alamat' => 'Pinggir Papas, Sumenep',
                'price' => 20000,
                'text' => 'Garam khusus untuk perawatan spa dan kecantikan. Membantu relaksasi dan melembutkan kulit.',
                'nomor_hp' => '081234567890',
                'user_id' => 1,  // ✅ TAMBAHKAN user_id
                'published_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'image' => 'garam-kasar.jpg',
                'title' => 'Garam Kasar',
                'alamat' => 'Pinggir Papas, Sumenep',
                'price' => 10000,
                'text' => 'Garam dengan butiran kasar untuk kebutuhan masak tradisional dan pengawetan ikan.',
                'nomor_hp' => '081234567890',
                'user_id' => 1,  // ✅ TAMBAHKAN user_id
                'published_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        $this->command->info('✅ 5 Produk Garam berhasil ditambahkan ke tabel kuliners!');
    }
}

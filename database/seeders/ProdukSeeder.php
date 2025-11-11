<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        // ✅ Hapus data lama dulu
        DB::table('produks')->truncate();

        // ✅ Insert 5 produk garam TANPA kolom 'berat'
        DB::table('produks')->insert([
            [
                'id' => 1,
                'nama' => 'Garam Konsumsi Premium',
                'slug' => 'garam-konsumsi-premium',
                'kategori' => 'konsumsi',
                'deskripsi' => 'Garam murni berkualitas tinggi untuk konsumsi sehari-hari. Telah tersertifikasi SNI dan aman dikonsumsi.',
                'gambar' => 'garam-konsumsi.jpg',
                'harga' => 15000,
                'satuan' => 'kg',
                'status' => 'tersedia',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 2,
                'nama' => 'Garam Fortifikasi Kelor (GFK)',
                'slug' => 'garam-fortifikasi-kelor-gfk',
                'kategori' => 'fortifikasi',
                'deskripsi' => 'Garam diperkaya dengan nutrisi daun kelor. Kaya akan vitamin A, zat besi, dan kalsium untuk kesehatan keluarga.',
                'gambar' => 'garam-gfk.jpg',
                'harga' => 25000,
                'satuan' => 'kg',
                'status' => 'tersedia',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 3,
                'nama' => 'Garam Industri',
                'slug' => 'garam-industri',
                'kategori' => 'industri',
                'deskripsi' => 'Garam berkualitas untuk kebutuhan industri, pabrik, dan pengolahan makanan skala besar.',
                'gambar' => 'garam-industri.jpg',
                'harga' => 8000,
                'satuan' => 'kg',
                'status' => 'tersedia',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 4,
                'nama' => 'Garam SPA',
                'slug' => 'garam-spa',
                'kategori' => 'spa',
                'deskripsi' => 'Garam khusus untuk perawatan spa dan kecantikan. Membantu relaksasi dan melembutkan kulit.',
                'gambar' => 'garam-spa.jpg',
                'harga' => 20000,
                'satuan' => 'kg',
                'status' => 'tersedia',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 5,
                'nama' => 'Garam Kasar',
                'slug' => 'garam-kasar',
                'kategori' => 'tradisional',
                'deskripsi' => 'Garam dengan butiran kasar untuk kebutuhan masak tradisional dan pengawetan ikan.',
                'gambar' => 'garam-kasar.jpg',
                'harga' => 10000,
                'satuan' => 'kg',
                'status' => 'tersedia',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        $this->command->info('✅ 5 Produk Garam berhasil ditambahkan ke tabel produks!');
    }
}

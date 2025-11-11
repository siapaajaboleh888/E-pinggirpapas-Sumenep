<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KulinerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data lama jika ada, untuk fresh start
        // DB::table('kuliners')->truncate(); 

        $produks = [
            [
                'id' => 1,
                'title' => 'Garam Konsumsi Premium',
                'nama' => 'Garam Konsumsi Premium',
                'deskripsi' => 'Garam murni premium beryodium yang diproses higienis untuk konsumsi harian. Kualitas kristal tinggi, rasa gurih alami.',
                'text' => 'Garam dapur premium, beryodium, kualitas terbaik.',
                'alamat' => 'Pinggirpapas, Sumenep',
                'harga' => 15000,
                'satuan' => 'Kg',
                'image' => 'garam-premium.jpg',
                'published_at' => now(),
                'status' => 'published', // KRITIS: Status harus 'published'
                'nomor_hp' => '6281234567890',
                'kontak_whatsapp' => '6281234567890',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'title' => 'Garam Fortifikasi Kelor (GFK)',
                'nama' => 'Garam Fortifikasi Kelor (GFK)',
                'deskripsi' => 'Inovasi garam dengan tambahan nutrisi daun kelor. Kaya antioksidan dan mineral, baik untuk kesehatan keluarga.',
                'text' => 'Garam kesehatan, garam kelor, fortifikasi nutrisi.',
                'alamat' => 'Pinggirpapas, Sumenep',
                'harga' => 25000,
                'satuan' => 'Kg',
                'image' => 'garam-kelor.jpg',
                'published_at' => now(),
                'status' => 'published', // KRITIS: Status harus 'published'
                'nomor_hp' => '6281234567890',
                'kontak_whatsapp' => '6281234567890',
                'user_id' => 1,
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
            ],
            [
                'id' => 3,
                'title' => 'Garam Industri Kasar',
                'nama' => 'Garam Industri Kasar',
                'deskripsi' => 'Garam dengan kristal besar, cocok untuk kebutuhan industri pengolahan ikan, tekstil, atau pengeboran.',
                'text' => 'Garam untuk industri, garam kasar, garam non-konsumsi.',
                'alamat' => 'Pinggirpapas, Sumenep',
                'harga' => 8000,
                'satuan' => 'Kg',
                'image' => 'garam-industri.jpg',
                'published_at' => now(),
                'status' => 'published', // KRITIS: Status harus 'published'
                'nomor_hp' => '6281234567890',
                'kontak_whatsapp' => '6281234567890',
                'user_id' => 1,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
        ];

        DB::table('kuliners')->insert($produks);
    }
}

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

        // ✅ Insert 4 produk garam baru sesuai katalog
        DB::table('kuliners')->insert([
            [
                'title' => 'Garam Fortifikasi Kelor (Produk Unggulan)',
                'text' => 'Garam konsumsi kualitas super (NaCl >95%) yang diperkaya dengan ekstrak daun kelor pilihan melalui teknologi fortifikasi berbasis paten.',
                'price' => 15000,
                'satuan' => '250 gram',
                'image' => 'garam_fortifikasi_kelor.png',
                'alamat' => 'Pinggir Papas, Sumenep',
                'nomor_hp' => '087846297731',
                'user_id' => 1,
                'published_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Lulur Garam Kelor (Premium Body Scrub)',
                'text' => 'Perpaduan kristal garam murni hasil teknologi tunnel dengan bubuk kelor halus untuk eksfoliasi kulit secara alami. Manfaat: Mengangkat sel kulit mati, mencerahkan kulit, dan sebagai antioksidan alami.',
                'price' => 25000,
                'satuan' => '250 gram',
                'image' => 'lulur_garam_kelor.png',
                'alamat' => 'Pinggir Papas, Sumenep',
                'nomor_hp' => '087846297731',
                'user_id' => 1,
                'published_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Sabun Mandi Garam Kelor (Natural Soap)',
                'text' => 'Sabun mandi yang mengombinasikan mineral garam dan nutrisi daun kelor. Manfaat: Membersihkan kuman secara maksimal sekaligus menjaga kelembapan kulit sensitif.',
                'price' => 10000,
                'satuan' => '250 gram',
                'image' => 'sabun_garam_kelor.png',
                'alamat' => 'Pinggir Papas, Sumenep',
                'nomor_hp' => '087846297731',
                'user_id' => 1,
                'published_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Paket Hemat "Blue Economy"',
                'text' => 'Cocok untuk hampers kesehatan atau stok keluarga. Isi Paket : 2 Pouch Garam Kelor + 1 Lulur + 1 Sabun.',
                'price' => 55000,
                'satuan' => 'Paket',
                'image' => 'paket_hemat_blue_economy.png',
                'alamat' => 'Pinggir Papas, Sumenep',
                'nomor_hp' => '087846297731',
                'user_id' => 1,
                'published_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        $this->command->info('✅ 4 Produk Garam baru berhasil ditambahkan!');
    }
}

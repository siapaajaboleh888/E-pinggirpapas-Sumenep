<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // ❌ KOMEN ATAU HAPUS BARIS INI
            // UserSeeder::class,

            // ✅ HANYA PANGGIL SEEDER YANG DIPERLUKAN
            ProdukSeeder::class,
            KulinerSeeder::class,
            WhatsappContactSeeder::class,
        ]);

        $this->command->info('🎉 Seeding completed successfully!');
    }
}

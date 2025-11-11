<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ✅ Cek apakah admin sudah ada
        if (User::where('email', 'admin@wisatalembung.com')->exists()) {
            $this->command->info('⚠️  Admin user already exists. Skipping...');
            return;
        }

        // ✅ Buat admin default
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@wisatalembung.com',
            'password' => Hash::make('admin123'), // ⚠️ GANTI password ini di production!
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        $this->command->info('✅ Admin user created successfully!');
        $this->command->info('   Email: admin@wisatalembung.com');
        $this->command->info('   Password: admin123');
        $this->command->warn('   ⚠️  JANGAN LUPA GANTI PASSWORD DI PRODUCTION!');
    }
}

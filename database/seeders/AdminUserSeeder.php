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
        // ✅ Admin User - E-Pinggirpapas
        User::updateOrCreate(
            ['email' => 'admin@epinggirpapas.com'],
            [
                'name' => 'Admin E-Pinggirpapas',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'phone' => '081234567890',
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('✅ Admin user created: admin@epinggirpapas.com / admin123');

        // ✅ Test User
        User::updateOrCreate(
            ['email' => 'user@test.com'],
            [
                'name' => 'User Test',
                'password' => Hash::make('user123'),
                'role' => 'user',
                'phone' => '081234567891',
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('✅ Test user created: user@test.com / user123');
        $this->command->warn('⚠️  JANGAN LUPA GANTI PASSWORD DI PRODUCTION!');
    }
}

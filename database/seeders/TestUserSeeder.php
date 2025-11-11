<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ✅ Buat user biasa untuk testing
        if (!User::where('email', 'user@wisatalembung.com')->exists()) {
            User::create([
                'name' => 'Test User',
                'email' => 'user@wisatalembung.com',
                'password' => Hash::make('user123'),
                'role' => 'user', // Role default
                'email_verified_at' => now(),
            ]);

            $this->command->info('✅ Test user created successfully!');
            $this->command->info('   Email: user@wisatalembung.com');
            $this->command->info('   Password: user123');
            $this->command->info('   Role: user');
        } else {
            $this->command->info('⚠️  Test user already exists. Skipping...');
        }
    }
}

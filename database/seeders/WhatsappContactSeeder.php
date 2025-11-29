<?php

namespace Database\Seeders;

use App\Models\WhatsappContact;
use Illuminate\Database\Seeder;

class WhatsappContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contacts = [
            [
                'label' => 'Customer Service',
                'phone' => '081234567890',
                'jam_operasional' => 'Senin - Sabtu, 08:00 - 20:00',
                'keterangan' => 'Untuk informasi umum dan pemesanan paket wisata',
                'is_active' => true,
            ],
            [
                'label' => 'Support Teknis',
                'phone' => '082345678901',
                'jam_operasional' => 'Senin - Jumat, 09:00 - 17:00',
                'keterangan' => 'Untuk bantuan teknis dan troubleshooting',
                'is_active' => true,
            ],
            [
                'label' => 'Emergency',
                'phone' => '083456789012',
                'jam_operasional' => '24/7',
                'keterangan' => 'Untuk keadaan darurat selama perjalanan',
                'is_active' => false,
            ],
        ];

        foreach ($contacts as $contact) {
            WhatsappContact::create($contact);
        }
    }
}

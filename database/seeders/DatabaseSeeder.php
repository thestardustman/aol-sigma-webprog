<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Campaign;
use App\Models\Donation;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. Buat 1 Akun Admin/User Tetap (biar gampang login)
        // Login pakai: admin@sdghope.com / password
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@sdghope.com',
            'password' => bcrypt('password'),
            'phone' => '081234567890',
            'address' => 'Jl. SDG Pusat No. 1, Jakarta',
        ]);

        // 2. Buat 10 User Random lain
        User::factory(10)->create();

        // 3. Buat 5 Campaign (Kegiatan)
        $campaigns = Campaign::factory(5)->create();

        // 4. Buat Data Donasi Dummy
        // Ambil semua user
        $users = User::all();

        foreach ($users as $user) {
            // Setiap user melakukan 3 donasi
            
            // a. Donasi General (campaign_id = null)
            Donation::factory()->create([
                'user_id' => $user->id,
                'campaign_id' => null,
                'status' => 'successful'
            ]);

            // b. Donasi Spesifik ke Campaign acak
            Donation::factory()->create([
                'user_id' => $user->id,
                'campaign_id' => $campaigns->random()->id,
                'status' => 'successful'
            ]);
        }
    }
}
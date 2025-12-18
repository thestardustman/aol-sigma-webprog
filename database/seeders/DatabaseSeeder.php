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
        // 1. Buat 1 Akun Admin (untuk deploy)
        // Login pakai: admin@semuthitam.com / adminadmin
        User::create([
            'name' => 'Admin SemutHitam',
            'email' => 'admin@semuthitam.com',
            'password' => bcrypt('adminadmin'),
            'phone' => '081234567890',
            'address' => 'Jl. SemutHitam No. 1, Jakarta',
            'birth_date' => '2000-01-01',
            'birth_place' => 'Jakarta',
            'city' => 'Jakarta',
            'province' => 'DKI Jakarta',
            'country' => 'Indonesia',
            'zip_code' => '12345',
            'gender' => 'Laki-laki',
            'is_admin' => true,
            'kyc_status' => 'approved',
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
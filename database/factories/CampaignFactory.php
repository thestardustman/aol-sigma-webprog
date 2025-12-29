<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class CampaignFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        static $campaigns = [
            [
                'title' => 'Bangun Sekolah untuk Anak Pelosok Kalimantan',
                'community_name' => 'Yayasan Pendidikan Nusantara',
                'description' => 'Mari bersama membangun fasilitas sekolah yang layak untuk 300 anak di pedalaman Kalimantan. Dengan dukungan Anda, mereka akan mendapatkan akses pendidikan yang lebih baik, ruang kelas yang nyaman, dan buku pelajaran yang memadai.',
                'img' => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=640&h=480&fit=crop',
                'date' => '2025-03-15',
                'target' => 50000000,
            ],
            [
                'title' => 'Air Bersih untuk Desa Terpencil NTT',
                'community_name' => 'Komunitas Peduli Air Bersih',
                'description' => 'Ribuan warga di NTT masih kesulitan mendapatkan air bersih. Program ini akan membangun sumur bor dan sistem penyaringan air untuk 5 desa. Setiap tetes donasi Anda adalah harapan hidup yang lebih sehat bagi mereka.',
                'img' => 'https://images.unsplash.com/photo-1541591838774-46ce1d4e4e14?w=640&h=480&fit=crop',
                'date' => '2025-04-20',
                'target' => 35000000,
            ],
            [
                'title' => 'Bantuan Medis untuk Penderita Kanker Anak',
                'community_name' => 'Rumah Harapan Indonesia',
                'description' => 'Kami mengumpulkan dana untuk biaya pengobatan dan perawatan 50 anak penderita kanker dari keluarga kurang mampu. Setiap donasi memberikan kesempatan hidup dan harapan sembuh bagi buah hati Indonesia.',
                'img' => 'https://images.unsplash.com/photo-1578496479763-c21c718af028?w=640&h=480&fit=crop',
                'date' => '2025-05-10',
                'target' => 75000000,
            ],
            [
                'title' => 'Rehabilitasi Hutan Mangrove Pesisir Jawa',
                'community_name' => 'Gerakan Hijau Nusantara',
                'description' => 'Program penanaman 10,000 pohon mangrove untuk melindungi pesisir dari abrasi dan meningkatkan ekosistem laut. Mari jaga lingkungan untuk generasi mendatang dengan aksi nyata dimulai hari ini.',
                'img' => 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=640&h=480&fit=crop',
                'date' => '2025-06-05',
                'target' => 25000000,
            ],
            [
                'title' => 'Beasiswa Yatim Berprestasi',
                'community_name' => 'Lembaga Penduli Yatim Indonesia',
                'description' => 'Bantu 100 anak yatim berprestasi melanjutkan pendidikan ke jenjang SMA dan Universitas. Dengan beasiswa ini, mimpi mereka untuk meraih masa depan cerah dapat terwujud meski tanpa sosok orangtua.',
                'img' => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?w=640&h=480&fit=crop',
                'date' => '2025-07-01',
                'target' => 60000000,
            ],
        ];
        
        static $index = 0;
        $campaign = $campaigns[$index % count($campaigns)];
        $index++;
        
        return $campaign;
    }
}

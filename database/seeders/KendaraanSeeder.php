<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KendaraanSeeder extends Seeder
{
    public function run()
    {
        DB::table('kendaraan')->insert([
            [
                'id_kendaraan' => (string) Str::uuid(),
                'users_id' => 'U0004', // Rizky Pratama
                'nomor_polisi' => 'D 1234 ABC',
                'model_kendaraan' => 'Honda Vario 150',
                'warna_kendaraan' => 'Hitam Matte',
                'url_foto_kendaraan' => 'https://via.placeholder.com/300x200?text=Foto+Motor+Vario',
                'url_foto_stnk' => 'https://via.placeholder.com/300x200?text=Foto+STNK+Vario',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kendaraan' => (string) Str::uuid(),
                'users_id' => 'U0004',
                'nomor_polisi' => 'B 9999 XYZ',
                'model_kendaraan' => 'Yamaha NMAX',
                'warna_kendaraan' => 'Putih',
                'url_foto_kendaraan' => 'https://via.placeholder.com/300x200?text=Foto+Motor+NMAX',
                'url_foto_stnk' => 'https://via.placeholder.com/300x200?text=Foto+STNK+NMAX',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

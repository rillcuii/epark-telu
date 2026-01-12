<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Users;
use App\Models\Kendaraan;
use App\Models\Parkir;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class SatpamDummySeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Dummy Mahasiswa
        $mhs1 = Users::create([
            'nama_user' => 'Rizky Sanusi',
            'username'  => 'rizky_mhs',
            'password'  => Hash::make('password123'),
            'role'      => 'mahasiswa',
            'email'     => 'rizky@student.com',
        ]);

        // 2. Buat Data Kendaraan (Kolom sesuai screenshot)
        $knd1 = Kendaraan::create([
            'users_id'           => $mhs1->id_user,
            'nomor_polisi'       => 'L 4040 LK',      //
            'model_kendaraan'    => 'Honda Jazz',    //
            'warna_kendaraan'    => 'Merah',        //
            'url_foto_kendaraan' => 'dummy_mobil.jpg', //
            'url_foto_stnk'      => 'dummy_stnk.jpg',  //
        ]);

        // 3. Buat Data Parkir (Monitoring Scan)
        Parkir::create([
            'users_id'     => $mhs1->id_user,     //
            'kendaraan_id' => $knd1->id_kendaraan, //
            'waktu_masuk'  => Carbon::now()->subMinutes(15), //
            'status'       => 'masuk',            //
        ]);

        // Tambah mahasiswa 2 untuk variasi di dashboard
        $mhs2 = Users::create([
            'nama_user' => 'Siti Aminah',
            'username'  => 'siti_mhs',
            'password'  => Hash::make('password123'),
            'role'      => 'mahasiswa',
            'email'     => 'siti@student.com',
        ]);

        $knd2 = Kendaraan::create([
            'users_id'           => $mhs2->id_user,
            'nomor_polisi'       => 'B 3321 XYZ',
            'model_kendaraan'    => 'Yamaha NMAX',
            'warna_kendaraan'    => 'Hitam',
            'url_foto_kendaraan' => 'dummy_nmax.jpg',
            'url_foto_stnk'      => 'dummy_stnk2.jpg',
        ]);

        Parkir::create([
            'users_id'     => $mhs2->id_user,
            'kendaraan_id' => $knd2->id_kendaraan,
            'waktu_masuk'  => Carbon::now()->subHours(1),
            'waktu_keluar' => Carbon::now()->subMinutes(5),
            'status'       => 'keluar',
        ]);
    }
}

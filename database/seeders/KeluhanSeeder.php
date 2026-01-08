<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Keluhan;
use Illuminate\Support\Facades\Hash;

class KeluhanSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Dummy Mahasiswa
        $mhs1 = User::create([
            'nama_user' => 'Rizky Pratama',
            'username'  => 'rizky2_mhs',
            'password'  => Hash::make('password123'),
            'role'      => 'mahasiswa',
            'email'     => 'rizky@student.com',
        ]);

        $mhs2 = User::create([
            'nama_user' => 'Siti Aminah',
            'username'  => 'siti2_mhs',
            'password'  => Hash::make('password123'),
            'role'      => 'mahasiswa',
            'email'     => 'siti@student.com',
        ]);

        // 2. Buat Dummy Keluhan (Sesuai Struktur Gambar)
        Keluhan::create([
            'users_id' => $mhs1->id_user, // Menggunakan FK users_id
            'judul_keluhan' => 'Parkiran Penuh',
            'keterangan_keluhan' => 'Parkiran di gedung A sangat penuh di jam 10 pagi, mohon ditambah space-nya.',
            'status_keluhan' => 'belum_ditangani',
            'created_at' => now()->subDays(2),
        ]);

        Keluhan::create([
            'users_id' => $mhs2->id_user,
            'judul_keluhan' => 'Kehilangan Helm',
            'keterangan_keluhan' => 'Saya kehilangan helm GM warna hitam di area parkir belakang tadi siang.',
            'status_keluhan' => 'sedang_ditangani',
            'created_at' => now()->subDay(),
        ]);

        $this->command->info('Data Dummy Keluhan Berhasil Dibuat!');
    }
}

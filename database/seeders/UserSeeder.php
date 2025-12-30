<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat akun Admin
        User::create([
            'nama_user' => 'Administrator E-Park',
            'nim'       => null, // Admin biasanya tidak punya NIM
            'username'  => 'admin_epark',
            'email'     => 'admin@epark.com',
            'password'  => Hash::make('password123'), // Ganti dengan password yang aman
            'role'      => 'admin',
        ]);

        // Membuat akun Satpam
        User::create([
            'nama_user' => 'Bapak Satpam Parkir',
            'nim'       => null,
            'username'  => 'satpam_epark',
            'email'     => 'satpam@epark.com',
            'password'  => Hash::make('satpam123'),
            'role'      => 'satpam',
        ]);
    }
}
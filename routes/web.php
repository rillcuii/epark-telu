<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ParkirController;
use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\KeluhanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KendaraanController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/login-sso', [LoginController::class, 'showLoginSSOForm'])->name('login.sso');
Route::post('/proses-login', [LoginController::class, 'login'])->name('proses.login');

Route::middleware(['auth'])->group(function () {

    //route admin
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');

        // Kelola Satpam
        Route::get('/satpam', [UserController::class, 'index'])->name('satpam.index');
        Route::get('/satpam/tambah', [UserController::class, 'create'])->name('satpam.create');
        Route::post('/satpam/simpan', [UserController::class, 'store'])->name('satpam.store');
        Route::get('/satpam/edit/{id}', [UserController::class, 'edit'])->name('satpam.edit');
        Route::post('/satpam/update/{id}', [UserController::class, 'update'])->name('satpam.update');
        Route::delete('/satpam/hapus/{id}', [UserController::class, 'destroy'])->name('satpam.destroy');

        // Kelola Keluhan
        Route::get('/keluhan', [KeluhanController::class, 'index'])->name('keluhan.index');
        Route::get('/keluhan/{id}', [KeluhanController::class, 'show'])->name('keluhan.show');
        Route::post('/keluhan/update/{id}', [KeluhanController::class, 'updateStatus'])->name('keluhan.update');
    });

    //route satpam
    Route::middleware(['role:satpam'])->group(function () {
        Route::get('/satpam/dashboard', [DashboardController::class, 'satpam'])->name('satpam.dashboard');

        //Lihat Riwayat Parkir
        Route::get('/satpam/riwayat', [ParkirController::class, 'riwayat'])->name('satpam.riwayat_parkir');
        Route::get('/satpam/riwayat/{id}', [ParkirController::class, 'detailRiwayat'])->name('satpam.riwayat.detail');

        // Manajemen QR Code Parkir
        Route::get('/satpam/qr-parkir', [QRCodeController::class, 'qrIndex'])->name('satpam.qr_display');
        Route::get('/satpam/api/new-qr', [QRCodeController::class, 'getNewQR'])->name('satpam.get_new_qr');

        // Verifikasi Parkir Masuk/Keluar
        Route::get('/satpam/verifikasi/{id_parkir}', [ParkirController::class, 'showVerifikasi'])->name('satpam.verifikasi');
    });

    //route mahasiswa
    Route::middleware(['role:mahasiswa'])->group(function () {
        Route::get('/mahasiswa/dashboard', [DashboardController::class, 'mahasiswa'])->name('mahasiswa.dashboard');

        // Pilih Kendaraan dan Scan QR Code
        Route::get('/mahasiswa/pilih-kendaraan', [ParkirController::class, 'pilihKendaraan'])->name('mahasiswa.pilih_kendaraan');
        Route::get('/mahasiswa/scan/{id_kendaraan}', [ParkirController::class, 'bukaScanner'])->name('mahasiswa.scanner');
        Route::post('/mahasiswa/scan/proses', [ParkirController::class, 'scanProses'])->name('mahasiswa.scan_proses');

        // riwayat parkir mahasiswa
        Route::get('/mahasiswa/riwayat', [ParkirController::class, 'riwayatMahasiswa'])->name('riwayat.mahasiswa');
        Route::get('/mahasiswa/riwayat/{id_parkir}', [ParkirController::class, 'detailRiwayatMahasiswa'])->name('riwayat.detail.mahasiswa');

        //kelola kendaraan
        Route::get('/mahasiswa/kendaraan', [KendaraanController::class, 'index'])->name('mahasiswa.kendaraan.index');
        Route::get('/mahasiswa/kendaraan/tambah', [KendaraanController::class, 'create'])->name('mahasiswa.kendaraan.create');
        Route::post('/mahasiswa/kendaraan/simpan', [KendaraanController::class, 'store'])->name('mahasiswa.kendaraan.store');
        Route::get('/mahasiswa/kendaraan/edit/{id}', [KendaraanController::class, 'edit'])->name('mahasiswa.kendaraan.edit');
        Route::post('/mahasiswa/kendaraan/update/{id}', [KendaraanController::class, 'update'])->name('mahasiswa.kendaraan.update');
        Route::post('/mahasiswa/kendaraan/hapus/{id}', [KendaraanController::class, 'destroy'])->name('mahasiswa.kendaraan.destroy');

        // keluhan mahasiswa
        Route::get('/mahasiswa/keluhan', [KeluhanController::class, 'indexMahasiswa'])->name('mahasiswa.keluhan.index');
        Route::get('/mahasiswa/keluhan/tambah', [KeluhanController::class, 'createMahasiswa'])->name('mahasiswa.keluhan.create');
        Route::post('/mahasiswa/keluhan/simpan', [KeluhanController::class, 'storeMahasiswa'])->name('mahasiswa.keluhan.store');
        Route::get('/mahasiswa/keluhan/detail/{id}', [KeluhanController::class, 'showMahasiswa'])->name('mahasiswa.keluhan.detail');
    });

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

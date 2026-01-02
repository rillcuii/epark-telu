<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KeluhanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ParkirController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
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
    });

    //route mahasiswa
    Route::middleware(['role:mahasiswa'])->group(function () {
        Route::get('/mahasiswa/dashboard', [DashboardController::class, 'mahasiswa'])->name('mahasiswa.dashboard');
    });

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
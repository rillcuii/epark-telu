<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/proses-login', [LoginController::class, 'login'])->name('proses.login');

Route::middleware(['auth'])->group(function () {

    //route admin
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
    });

    //route satpam
    Route::middleware(['role:satpam'])->group(function () {
        Route::get('/satpam/dashboard', [DashboardController::class, 'satpam'])->name('satpam.dashboard');
    });

    //route mahasiswa
    Route::middleware(['role:mahasiswa'])->group(function () {
        Route::get('/mahasiswa/dashboard', [DashboardController::class, 'mahasiswa'])->name('mahasiswa.dashboard');
    });

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

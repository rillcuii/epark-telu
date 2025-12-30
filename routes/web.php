<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/khalil', function () {
    return view('testkhalil');
});
Route::get('/login-mahasiswa', function () {
    return view('auth.login-mahasiswa');
});
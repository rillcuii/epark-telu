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

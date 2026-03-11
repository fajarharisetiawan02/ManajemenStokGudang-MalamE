<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Route untuk project Sistem Manajemen Stok Gudang
|--------------------------------------------------------------------------
*/

// ==========================
// HALAMAN UTAMA
// ==========================

// Halaman beranda
Route::get('/', [HomeController::class, 'index'])->name('home');

// Halaman kontak
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');


// ==========================
// LOGIN
// ==========================

// Halaman login
Route::get('/login', [LoginController::class, 'index'])->name('login');

// Proses login
Route::post('/login', [LoginController::class, 'login'])->name('login.process');


// ==========================
// DASHBOARD
// ==========================

// Halaman dashboard setelah login
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdukController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Sistem Manajemen Stok Gudang
|--------------------------------------------------------------------------
*/

// ==========================
// HALAMAN UTAMA
// ==========================

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index']);

// About
Route::get('/about', [HomeController::class, 'about'])->name('about');

// Product
Route::get('/product', [HomeController::class, 'product'])->name('product');

// Contact
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');


// ==========================
// LOGIN & REGISTER
// ==========================

// Login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');

// Register
Route::get('/register', [LoginController::class, 'register'])->name('register');


// ==========================
// DASHBOARD
// ==========================

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


// ==========================
// PRAKTIKUM CONTROLLER-VIEW
// ==========================

// Route untuk menampilkan data produk


Route::get('/produk_barang', [ProdukController::class, 'tampilkan']);
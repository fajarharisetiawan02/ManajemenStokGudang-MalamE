<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ListBarangController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==========================
// HALAMAN UTAMA
// ==========================

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index']);
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/product', [HomeController::class, 'product'])->name('product');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

// ==========================
// LOGIN & REGISTER
// ==========================

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::get('/register', [LoginController::class, 'register'])->name('register');

// ==========================
// DASHBOARD
// ==========================

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// ==========================
// PRODUK
// ==========================

Route::get('/produk_barang', [ProdukController::class, 'tampilkan']);

// ==========================
// ROUTE TAMBAHAN
// ==========================

Route::get('/welcome', function () {
    return "Selamat Datang di Praktikum Pemrograman Web";
});

Route::get('/user/{id}', function ($id) {
    return "User ID : " . $id;
});

// Group Admin
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return "Halaman Admin Dashboard";
    });

    Route::get('/users', function () {
        return "Halaman Admin Users";
    });
});

// List Barang
Route::get('/listbarang/{id}/{nama}', [ListBarangController::class, 'tampilkan']);
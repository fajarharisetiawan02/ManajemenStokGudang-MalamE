<?php

// Nama : Fajar Hari Setiawan
// NIM  : 3312511140

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
<<<<<<< HEAD
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
=======
use App\Http\Controllers\ListBarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;

Route::get('/welcome', function () {
    return "Selamat Datang di Praktikum Pemrograman Web";
});

Route::get('/user/{id}', function ($id) {
    return "User ID : " . $id;
});

Route::get('/', [HomeController::class, 'index']); 
Route::get('/contact', [HomeController::class, 'contact']);

// Routes Group Admin
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return "Halaman Admin Dashboard";
    });

    Route::get('/users', function () {
        return "Halaman Admin Users";
    });
});
// Route Dashboard
Route::get('/dashboard', [DashboardController::class, 'index']);


Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login']);
// Route Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Route List Barang (pakai Controller)
Route::get('/listbarang/{id}/{nama}', [ListBarangController::class, 'tampilkan']);
>>>>>>> 9e300dc63da50658d462d9cd23494f57b31cbdfc

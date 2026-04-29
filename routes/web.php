<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;

// ==========================
// HALAMAN UTAMA
// ==========================
Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/home', 'index');
    Route::get('/about', 'about')->name('about');
    Route::get('/product', 'product')->name('product');
    Route::get('/contact', 'contact')->name('contact');
});

// ==========================
// LOGIN
// ==========================
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'login');
    Route::get('/logout', 'logout')->name('logout');
});

// ==========================
// DASHBOARD
// ==========================
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


// ==========================
// KATEGORI
// ==========================
Route::resource('/kategori', KategoriController::class);


// ==========================
// DATA BARANG (FULL CRUD)
// ==========================
Route::resource('/data-barang', BarangController::class);


// ==========================
// SUPPLIER (JANGAN PAKAI VIEW LANGSUNG)
// ==========================
Route::resource('/supplier', SupplierController::class);


// ==========================
// LAPORAN
// ==========================
Route::view('/laporan', 'pages.admin.laporan')->name('laporan');


// ==========================
// INVENTORY
// ==========================
Route::view('/barang-masuk', 'pages.admin.barang-masuk')->name('barang.masuk');
Route::view('/barang-keluar', 'pages.admin.barang-keluar')->name('barang.keluar');
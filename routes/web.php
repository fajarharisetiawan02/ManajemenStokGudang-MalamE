<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;


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
// KATEGORI (FULL CRUD)
// ==========================
Route::resource('/kategori', KategoriController::class);


// ==========================
// DATA BARANG
// ==========================
Route::resource('/data-barang', BarangController::class);


// ==========================
// SUPPLIER (FULL CRUD)
// ==========================
Route::resource('/supplier', SupplierController::class);


// ==========================
// LAPORAN
// ==========================
Route::view('/laporan', 'pages.admin.laporan')->name('laporan');


// ==========================
// INVENTORY
// ==========================
Route::get('/barang-masuk', [BarangMasukController::class, 'index'])->name('barang-masuk.index');
Route::post('/barang-masuk', [BarangMasukController::class, 'store'])->name('barang-masuk.store');

Route::get('/barang-keluar', [BarangKeluarController::class, 'index'])->name('barang-keluar.index');
Route::post('/barang-keluar', [BarangKeluarController::class, 'store'])->name('barang-keluar.store');
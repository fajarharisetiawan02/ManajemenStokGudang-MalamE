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
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index']);
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/product', [HomeController::class, 'product'])->name('product');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

// ==========================
// LOGIN
// ==========================
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// ==========================
// DASHBOARD (FIX)
// ==========================
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// ==========================
// KATEGORI
// ==========================
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');

// ==========================
// DATA BARANG (SUDAH DIRAPIKAN)
// ==========================
Route::resource('/data-barang', BarangController::class);

// ==========================
// SUPPLIER
// ==========================
Route::get('/supplier', function () {
    return view('pages.admin.supplier');
});

// ==========================
// LAPORAN
// ==========================
Route::get('/laporan', function () {
    return view('pages.admin.laporan');
});
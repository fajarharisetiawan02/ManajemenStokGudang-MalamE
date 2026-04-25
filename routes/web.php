<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KategoriController;

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
// DASHBOARD
// ==========================
Route::get('/dashboard', function () {

    $sparepart = [
        ['nama' => 'Oli Mesin', 'stok' => 20, 'jenis' => 'Oli'],
        ['nama' => 'Ban Mobil', 'stok' => 5, 'jenis' => 'Ban'],
        ['nama' => 'Aki', 'stok' => 3, 'jenis' => 'Elektrik'],
        ['nama' => 'Kampas Rem', 'stok' => 12, 'jenis' => 'Rem'],
    ];

    return view('dashboard', compact('sparepart'));

})->name('dashboard');

// ==========================
// KATEGORI BARANG
// ==========================
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');

// ==========================
// HALAMAN APP LAIN
// ==========================
Route::get('/app', function () {
    return view('app');
});

Route::get('/data-barang', function () {
    return view('data-barang');
});
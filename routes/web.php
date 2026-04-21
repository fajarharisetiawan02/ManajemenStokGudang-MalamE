<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;

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
// LOGIN
// ==========================

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// ==========================
// DASHBOARD BENGKEL (NO DB)
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
// TAMBAHAN
// ==========================

Route::get('/welcome', function () {
    return "Selamat Datang di Sistem Bengkel Mobil";
});

Route::get('/app', function () {
return view('app');
});

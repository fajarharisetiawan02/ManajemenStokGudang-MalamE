<?php

use Illuminate\Support\Facades\Route;

/* =========================
   CONTROLLER
========================= */
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LoginController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\BarangMasukController;
use App\Http\Controllers\Admin\BarangKeluarController;
use App\Http\Controllers\Admin\LaporanController;

// ✅ INI YANG BENAR (BUKAN PATH FILE)
use App\Http\Controllers\Manager\DashboardManagerController;


/* =========================
   LANDING
========================= */
Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/home', 'index');
    Route::get('/about', 'about');
    Route::get('/contact', 'contact');
});


/* =========================
   AUTH
========================= */
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'login');
    Route::get('/logout', 'logout')->name('logout');
});


/* =========================
   ADMIN
========================= */
Route::prefix('admin')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::resource('kategori', KategoriController::class);
    Route::resource('data-barang', BarangController::class);
    Route::resource('supplier', SupplierController::class);

    Route::get('/barang-masuk', [BarangMasukController::class, 'index'])->name('barang-masuk.index');
    Route::post('/barang-masuk', [BarangMasukController::class, 'store'])->name('barang-masuk.store');

    Route::get('/barang-keluar', [BarangKeluarController::class, 'index'])->name('barang-keluar.index');
    Route::post('/barang-keluar', [BarangKeluarController::class, 'store'])->name('barang-keluar.store');

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');

});


/* =========================
   MANAGER
========================= */
Route::prefix('manager')->group(function () {

    Route::get('/dashboard', [DashboardManagerController::class, 'index'])
        ->name('manager.dashboard');

});
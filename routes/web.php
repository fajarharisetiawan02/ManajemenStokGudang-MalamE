<?php

use Illuminate\Support\Facades\Route;

/* === CONTROLLER === */
use App\Http\Controllers\Landing\HomeController;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminKategoriController;
use App\Http\Controllers\Admin\AdminSupplierController;
use App\Http\Controllers\Admin\AdminBarangController;
use App\Http\Controllers\Admin\AdminBarangMasukController;
use App\Http\Controllers\Admin\AdminBarangKeluarController;
use App\Http\Controllers\Admin\AdminLaporanController;

use App\Http\Controllers\Manager\ManagerDashboardController;
use App\Http\Controllers\Manager\ManagerBarangController;
use App\Http\Controllers\Manager\ManagerSupplierController;
use App\Http\Controllers\Manager\ManagerBarangMasukController;
use App\Http\Controllers\Manager\ManagerBarangKeluarController;
use App\Http\Controllers\Manager\ManagerLaporanController;


/* === LANDING ==== */
Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/home', 'index');
    Route::get('/about', 'about');
    Route::get('/contact', 'contact');
});


/* === AUTH === */
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'login');
    Route::get('/logout', 'logout')->name('logout');
});


/* === ADMIN === */
Route::prefix('admin')->middleware(['checkLogin'])->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');

    Route::resource('kategori', AdminKategoriController::class);
    Route::resource('data-barang', AdminBarangController::class);
    Route::resource('supplier', AdminSupplierController::class);

    Route::get('/barang-masuk', [AdminBarangMasukController::class, 'index'])
        ->name('barang-masuk.index');

    Route::post('/barang-masuk', [AdminBarangMasukController::class, 'store'])
        ->name('barang-masuk.store');

    Route::get('/barang-keluar', [AdminBarangKeluarController::class, 'index'])
        ->name('barang-keluar.index');

    Route::post('/barang-keluar', [AdminBarangKeluarController::class, 'store'])
        ->name('barang-keluar.store');

    Route::get('/laporan', [AdminLaporanController::class, 'index'])
        ->name('laporan.index');
});


/* === MANAGER === */
Route::prefix('manager')->middleware(['checkLogin'])->group(function () {

    Route::get('/dashboard', [ManagerDashboardController::class, 'index'])
        ->name('manager.dashboard');

    Route::get('/data-barang', [ManagerBarangController::class, 'index'])
        ->name('manager.data-barang');

    Route::get('/supplier', [ManagerSupplierController::class, 'index'])
        ->name('manager.supplier');

    Route::get('/barang-masuk', [ManagerBarangMasukController::class, 'index'])
        ->name('manager.barang-masuk');

    Route::get('/barang-keluar', [ManagerBarangKeluarController::class, 'index'])
        ->name('manager.barang-keluar');

    Route::get('/laporan', [ManagerLaporanController::class, 'index'])
        ->name('manager.laporan');

});
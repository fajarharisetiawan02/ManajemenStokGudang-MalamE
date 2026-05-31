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

    Route::post('/login', 'login')
        ->name('login.post');

    Route::get('/logout', 'logout')
        ->name('logout');

});


/* === ADMIN === */
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth'])
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        /* === KATEGORI === */
        Route::resource('kategori', AdminKategoriController::class);

        /* === DATA BARANG === */
        Route::resource('barang', AdminBarangController::class);

        /* === SUPPLIER === */
        Route::resource('supplier', AdminSupplierController::class);

         /* === BARANG MASUK === */
        Route::resource('barang-masuk', AdminBarangMasukController::class);

        /* === BARANG KELUAR === */
        Route::resource('barang-keluar', AdminBarangKeluarController::class);

        /* === LAPORAN === */
        Route::get('/laporan', [AdminLaporanController::class, 'index'])
            ->name('laporan.index');

});


/* === MANAGER === */
Route::prefix('manager')
    ->name('manager.')
    ->middleware(['auth'])
    ->group(function () {

        Route::get('/dashboard', [ManagerDashboardController::class, 'index'])
            ->name('dashboard');

        /* === DATA BARANG === */
        Route::get('/data-barang', [ManagerBarangController::class, 'index'])
            ->name('data-barang.index');

        /* === SUPPLIER === */
        Route::get('/supplier', [ManagerSupplierController::class, 'index'])
            ->name('supplier.index');

        /* === BARANG MASUK === */
        Route::get('/barang-masuk', [ManagerBarangMasukController::class, 'index'])
            ->name('barang-masuk.index');

        /* === BARANG KELUAR === */
        Route::get('/barang-keluar', [ManagerBarangKeluarController::class, 'index'])
            ->name('barang-keluar.index');

        /* === LAPORAN === */
        Route::get('/laporan', [ManagerLaporanController::class, 'index'])
            ->name('laporan.index');

});
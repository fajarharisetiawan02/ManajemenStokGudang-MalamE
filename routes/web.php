<?php

use Illuminate\Support\Facades\Route;

/* === CONTROLLER === */
use App\Http\Controllers\Landing\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\LanguageController;

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminKategoriController;
use App\Http\Controllers\Admin\AdminSupplierController;
use App\Http\Controllers\Admin\AdminBarangController;
use App\Http\Controllers\Admin\AdminBarangMasukController;
use App\Http\Controllers\Admin\AdminBarangKeluarController;
use App\Http\Controllers\Admin\AdminLaporanController;

use App\Http\Controllers\Manager\ManagerDashboardController;
use App\Http\Controllers\Manager\ManagerKategoriController;
use App\Http\Controllers\Manager\ManagerBarangController;
use App\Http\Controllers\Manager\ManagerSupplierController;
use App\Http\Controllers\Manager\ManagerBarangMasukController;
use App\Http\Controllers\Manager\ManagerBarangKeluarController;
use App\Http\Controllers\Manager\ManagerLaporanController;


/* === LANDING === */
Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/home', 'index');
});


/* === AUTH === */
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'login')->name('login.post');
    Route::post('/logout', 'logout')->name('logout');
});


/* === LANGUAGE === */
Route::post('/language/switch', [LanguageController::class, 'switch'])->name('language.switch');


/* === PROFIL & NOTIFIKASI & PING SESSION === */
Route::middleware(['auth'])->group(function () {
    Route::get('/gp/profil', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/gp/profil', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/gp/profil/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    Route::post('/gp/notifikasi/read', [NotifikasiController::class, 'markRead'])->name('notifikasi.read');

    Route::post('/gp/ping-session', function () {
        session()->put('last_activity', now());
        return response()->json(['status' => 'ok']);
    })->name('ping.session');
});


/* === ADMIN === */
Route::prefix('gp/dashboard')
    ->name('admin.')
    ->middleware(['auth'])
    ->group(function () {

        Route::get('/', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('kategori', AdminKategoriController::class);
        Route::resource('data-barang', AdminBarangController::class);
        Route::resource('supplier', AdminSupplierController::class);

        Route::get('/barang-masuk/cek-barang/{kode}', [AdminBarangMasukController::class, 'cekBarang'])
            ->name('barang-masuk.cek');
        Route::resource('barang-masuk', AdminBarangMasukController::class);

        Route::get('/barang-keluar/cek-barang/{kode}', [AdminBarangKeluarController::class, 'cekBarang'])
            ->name('barang-keluar.cek');
        Route::resource('barang-keluar', AdminBarangKeluarController::class);

        Route::get('/laporan', [AdminLaporanController::class, 'index'])
            ->name('laporan.index');
        Route::get('/laporan/export-excel', [AdminLaporanController::class, 'exportExcel'])
            ->name('laporan.export-excel');
        Route::get('/laporan/export-pdf', [AdminLaporanController::class, 'exportPdf'])
            ->name('laporan.export-pdf');
    });


/* === MANAGER === */
Route::prefix('gp/workspace')
    ->name('manager.')
    ->middleware(['auth'])
    ->group(function () {

        Route::get('/dashboard', [ManagerDashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/kategori', [ManagerKategoriController::class, 'index'])
            ->name('kategori.index');

        Route::get('/data-barang', [ManagerBarangController::class, 'index'])
            ->name('data-barang.index');
        Route::get('/data-barang/{id}', [ManagerBarangController::class, 'show'])
            ->name('data-barang.show');

        Route::get('/supplier', [ManagerSupplierController::class, 'index'])
            ->name('supplier.index');

        Route::get('/barang-masuk', [ManagerBarangMasukController::class, 'index'])
            ->name('barang-masuk.index');

        Route::get('/barang-keluar', [ManagerBarangKeluarController::class, 'index'])
            ->name('barang-keluar.index');

        Route::get('/laporan', [ManagerLaporanController::class, 'index'])
            ->name('laporan.index');
        Route::get('/laporan/export-excel', [ManagerLaporanController::class, 'exportExcel'])
            ->name('laporan.export-excel');
        Route::get('/laporan/export-pdf', [ManagerLaporanController::class, 'exportPdf'])
            ->name('laporan.export-pdf');
    });
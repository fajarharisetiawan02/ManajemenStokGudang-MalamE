<?php

// Nama : Fajar Hari Setiawan
// NIM  : 3312511140

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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
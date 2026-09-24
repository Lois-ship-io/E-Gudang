<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriBarangController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Dashboard accessible by both roles
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Manage Kategori & Barang (accessible by both superadmin and admin)
    Route::middleware('level:superadmin,admin')->group(function () {
        Route::resource('kategori', KategoriBarangController::class)->except(['show']);
        Route::resource('barang', BarangController::class);
    });
    
    // Manage Pengguna (only accessible by superadmin)
    Route::middleware('level:superadmin')->group(function () {
        Route::resource('user', UserController::class)->except(['show']);
    });
});

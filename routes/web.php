<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\ProfilController;
use Illuminate\Support\Facades\Route;

// AUTH (untuk guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// ROUTE UNTUK USER YANG SUDAH LOGIN
Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profil', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // ROUTE KHUSUS ADMIN
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        // User Management
        Route::get('/users', [UserController::class, 'adminIndex'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

        // Kategori
        Route::resource('kategori', KategoriController::class);

        // Pengaduan
        Route::get('/pengaduan', [PengaduanController::class, 'adminIndex'])->name('pengaduan.index');
        Route::get('/pengaduan/{pengaduan}/edit', [PengaduanController::class, 'edit'])->name('pengaduan.edit');
        Route::put('/pengaduan/{pengaduan}', [PengaduanController::class, 'update'])->name('pengaduan.update');
        Route::delete('/pengaduan/{pengaduan}', [PengaduanController::class, 'destroy'])->name('pengaduan.destroy');
    });

    // ROUTE KHUSUS PETUGAS
    Route::middleware('role:petugas')->prefix('petugas')->name('petugas.')->group(function () {
        Route::get('/users', [UserController::class, 'petugasIndex'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'petugasCreate'])->name('users.create');
        Route::post('/users', [UserController::class, 'petugasStore'])->name('users.store');
        Route::get('/users/{user}/edit', [UserController::class, 'petugasEdit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'petugasUpdate'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'petugasDestroy'])->name('users.destroy');

        Route::get('/pengaduan', [PengaduanController::class, 'petugasIndex'])->name('pengaduan.index');
        Route::put('/pengaduan/{pengaduan}/status', [PengaduanController::class, 'updateStatus'])->name('pengaduan.status');
    });

    // ROUTE KHUSUS CUSTOMER
    Route::middleware('role:customer')->prefix('customer')->name('customer.')->group(function () {
        Route::get('/pengaduan', [PengaduanController::class, 'customerIndex'])->name('pengaduan.index');
        Route::get('/pengaduan/create', [PengaduanController::class, 'create'])->name('pengaduan.create');
        Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
    });
});
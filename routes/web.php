<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

// Halaman utama (public)
Route::get('/', [BerandaController::class, 'index'])->name('home');

// Autentikasi
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ================= ADMIN AREA ================= //
Route::middleware(['admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // CRUD Pengguna (hanya admin)
    Route::prefix('admin/pengguna')->name('admin.pengguna.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/{id_user}', [UserController::class, 'destroy'])->name('destroy');
    });
});

// ================= MEMBER AREA ================= //
Route::middleware(['member'])->group(function () {
    Route::get('/member', function () {
        return view('member.beranda');
    })->name('member.dashboard');
});

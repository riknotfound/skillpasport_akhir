<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

// Halaman utama (public)
Route::get('/', [BerandaController::class, 'index'])->name('home');

// Halaman login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Halaman admin (hanya bisa diakses kalau login sebagai admin)
Route::get('/admin', function () {
    if (session('role') === 'admin') {
        return app(App\Http\Controllers\AdminController::class)->dashboard();
    } else {
        return redirect('/login')->with('error', 'Akses ditolak, kamu bukan admin!');
    }
})->name('admin.dashboard');

// Halaman member (kalau login sebagai member)
Route::get('/member', function () {
    if (session('role') === 'member') {
        return view('member.beranda');
    } else {
        return redirect('/login')->with('error', 'Akses ditolak, kamu bukan member!');
    }
})->name('member.dashboard');

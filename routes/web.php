<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TokoController;
use App\Models\Product;
use App\Models\Category;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;

// Halaman utama (public)
Route::get('/', [BerandaController::class, 'index'])->name('home');
Route::get('/produk', [ProdukController::class, 'produk'])->name('produk.all');
Route::get('/produk/{id}', [ProdukController::class, 'detail'])->name('produk.detail');
Route::get('/toko', [TokoController::class, 'toko'])->name('toko.public');
Route::get('/toko/{id}', [TokoController::class, 'detail_toko'])->name('toko.detail');

// Autentikasi
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin
Route::middleware(['admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('dashboard.admin');

    Route::prefix('admin/pengguna')->name('admin.pengguna.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/{id_user}', [UserController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('admin/toko')->name('admin.toko.')->group(function () {
        Route::get('/', [TokoController::class, 'index'])->name('index');
        Route::get('create', [TokoController::class, 'create'])->name('create');
        Route::post('/', [TokoController::class, 'store'])->name('store');
        Route::get('{toko}/edit', [TokoController::class, 'edit'])->name('edit');
        Route::put('{toko}', [TokoController::class, 'update'])->name('update');
        Route::delete('{toko}', [TokoController::class, 'destroy'])->name('destroy');
    });

    // ====== PRODUK ADMIN: LIHAT & HAPUS SEMUA PRODUK ======
    Route::prefix('admin/produk')->name('admin.produk.')->group(function () {
        Route::get('/', [AdminController::class, 'produkIndex'])->name('index');   // list semua produk
        Route::delete('/{id}', [AdminController::class, 'produkDestroy'])->name('destroy'); // hapus produk
    });
});

// Member
Route::middleware(['member'])->prefix('member')->name('member.')->group(function () {

    Route::get('/', function () {

        $user = Auth::user();
        $toko = Store::where('id_user', $user->id)->first();
        $totalProduk = Product::where('id_toko', $toko ? $toko->id : null)->count();
        $totalKategori = Category::count();

        return view('admin.dashboard', [
            'totalProduk'   => $totalProduk,
            'totalKategori' => $totalKategori
        ]);
    })->name('dashboard');

    Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('/produk/create', [ProdukController::class, 'create'])->name('produk.create');
    Route::post('/produk/store', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('/produk/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');

    Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');
});

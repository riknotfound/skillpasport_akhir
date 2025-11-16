<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    // =============================
    // HALAMAN BERANDA (PUBLIC)
    // =============================
    public function index()
    {
        // Ambil semua produk + relasi
        $produk = Product::with(['kategori', 'toko', 'gambarProduk'])
            ->orderBy('created_at', 'DESC')
            ->get();

        // Ambil semua kategori
        $kategori = Category::orderBy('nama_kategori')->get();

        return view('beranda', [
            'produk'   => $produk,
            'kategori' => $kategori,
        ]);
    }
}

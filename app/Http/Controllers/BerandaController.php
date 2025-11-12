<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        // Contoh data produk
        $produk = [
            ['nama' => 'Seragam Sekolah', 'harga' => 120000],
            ['nama' => 'Tas Sekolah', 'harga' => 90000],
            ['nama' => 'Sepatu Putih', 'harga' => 150000],
        ];

        // Kirim ke view
        return view('beranda', compact('produk'));
    }
}

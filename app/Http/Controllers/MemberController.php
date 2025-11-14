<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Produk; // pastikan model ini ada
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function dashboard()
    {
        $product = Product::with('gambarProduk')->latest()->get();

        return view('member.beranda', compact('produk'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Store;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalToko      = Store::count();
        $totalPengguna  = User::count();
        // TOTAL PRODUK DARI SELURUH TOKO
        $totalProdukAll = Product::count();

        return view('admin.dashboard', compact('totalPengguna', 'totalToko', 'totalProdukAll'));
    }

    // HALAMAN LIST PRODUK UNTUK ADMIN (SEMUA PRODUK SEMUA TOKO)
    public function produkIndex()
    {
        $products = Product::with(['category', 'store'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.produk.index', compact('products'));
    }

    // ADMIN HANYA BISA HAPUS PRODUK
    public function produkDestroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}

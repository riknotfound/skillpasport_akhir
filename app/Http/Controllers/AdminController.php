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

        if (session('role') !== 'admin') {
            return redirect()->route('login')->with('error', 'Akses ditolak! Kamu bukan admin.');
        }


        $totalProduk   = Product::count();
        $totalToko     = Store::count();
        $totalKategori = Category::count();
        $totalPengguna = User::count();

        return view('admin.dashboard', [
            'title'         => 'Dashboard Admin',
            'username'      => session('username') ?? 'Admin Utama',
            'totalProduk'   => $totalProduk,
            'totalToko'     => $totalToko,
            'totalKategori' => $totalKategori,
            'totalPengguna' => $totalPengguna,
        ]);
    }
}

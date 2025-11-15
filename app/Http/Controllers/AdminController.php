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
        $totalProduk   = Product::count();
        $totalToko     = Store::count();
        $totalKategori = Category::count();
        $totalPengguna = User::count();
        return view('admin.dashboard', compact('totalKategori','totalPengguna','totalProduk','totalToko'));
    }
}

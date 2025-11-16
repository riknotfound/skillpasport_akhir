<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function memberDashboard()
    {
        $totalProduk = Product::count();
        $totalKategori = Category::count();
        return view('admin.dashboard', compact('totalProduk','totalKategori'));
    }
}

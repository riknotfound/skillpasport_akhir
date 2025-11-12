<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Pastikan user punya role admin
        if (session('role') !== 'admin') {
            return redirect()->route('login')->with('error', 'Akses ditolak! Kamu bukan admin.');
        }

        // Kirim data ke view kalau perlu
        $data = [
            'title' => 'Dashboard Admin',
            'username' => 'Admin Utama',
        ];

        return view('admin.dashboard', $data);
    }
}

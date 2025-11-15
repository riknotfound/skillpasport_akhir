<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login (FIXED)
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Login menggunakan Laravel Auth
        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Arahkan sesuai role
            if ($user->role === 'admin') {
                return redirect()->route('dashboard.admin')->with('success', 'Selamat datang Admin!');
            }

            return redirect()->route('member.dashboard')->with('success', 'Selamat datang Member!');
        }

        return back()->with('error', 'Username atau password salah.');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Kamu berhasil logout.');
    }
}

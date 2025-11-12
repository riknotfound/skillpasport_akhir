<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function processLogin(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        // Simulasi login manual (tanpa database dulu)
        if ($email === 'admin@gmail.com' && $password === 'admin123') {
            session(['role' => 'admin']);
            return redirect()->route('admin.dashboard');
        }

        if ($email === 'member@gmail.com' && $password === 'member123') {
            session(['role' => 'member']);
            return redirect()->route('member.dashboard');
        }

        return back()->with('error', 'Email atau password salah!');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('login')->with('error', 'Berhasil logout!');
    }
}

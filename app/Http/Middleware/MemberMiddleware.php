<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Harus login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Role harus member
        if (Auth::user()->role !== 'member') {
            return redirect()->route('login')->with('error', 'Akses ditolak! Kamu bukan member.');
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MemberMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (session('role') !== 'member') {
            return redirect()->route('login')->with('error', 'Akses ditolak! Kamu bukan member.');
        }

        return $next($request);
    }
}

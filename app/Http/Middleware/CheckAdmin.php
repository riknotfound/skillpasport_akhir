<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (session('role') !== 'admin') {
            return redirect('/login')->with('error', 'Akses ditolak, kamu bukan admin!');
        }

        return $next($request);
    }
}

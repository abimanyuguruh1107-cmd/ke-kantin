<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CekLoginSiswa
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('siswa_id')) {
            return redirect('/')->with('error', 'Silakan login terlebih dahulu!');
        }

        return $next($request);
    }
}

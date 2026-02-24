<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\penjual;

class UpdateLastSeen
{
    public function handle($request, Closure $next)
    {
        if (session()->has('kantin_id')) {
            penjual::where('id', session('kantin_id'))
                ->update(['last_seen' => now()]);
        }

        return $next($request);
    }
}
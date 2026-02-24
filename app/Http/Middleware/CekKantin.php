<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CekKantin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!session('kantin_id')) {
            return redirect('/')->with('error', 'Silakan login terlebih dahulu!');
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmployerVerified
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! auth()->user()->companyProfile?->is_verified) {
            return redirect()->route('dashboard')->with('warning', 'Menunggu verifikasi admin.');
        }

        return $next($request);
    }
}

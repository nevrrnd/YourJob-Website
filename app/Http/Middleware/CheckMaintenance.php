<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckMaintenance
{
    /**
     * Show a maintenance page to everyone except admins
     * when maintenance mode is enabled in settings.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (setting('maintenance_mode', false)) {
            $user = $request->user();

            // Admins always pass through so they can manage the site.
            $isAdmin = $user && $user->role === 'admin';

            // Allow auth + admin routes so admin can log in and toggle it off.
            $allowed = $request->is('login', 'logout', 'admin', 'admin/*');

            if (! $isAdmin && ! $allowed) {
                return response()->view('maintenance', [
                    'message' => setting('maintenance_message', 'Situs sedang dalam pemeliharaan.'),
                ], 503);
            }
        }

        return $next($request);
    }
}

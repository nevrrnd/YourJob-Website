<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Supported application languages.
     *
     * @var array<int, string>
     */
    public const SUPPORTED = ['id', 'en'];

    /**
     * Resolve the active locale from: logged-in user preference,
     * then session, then config default.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = 'id'; // Indonesian is the base UI language.

        if ($user = $request->user()) {
            if (in_array($user->language, self::SUPPORTED, true)) {
                $locale = $user->language;
            }
        } elseif ($session = $request->session()->get('locale')) {
            if (in_array($session, self::SUPPORTED, true)) {
                $locale = $session;
            }
        }

        App::setLocale($locale);

        return $next($request);
    }
}

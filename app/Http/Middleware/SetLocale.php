<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Resolve and apply the active app locale on every request based on
     * (in order): session, cookie, fallback config value.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $supported = ['en', 'km'];

        $locale = $request->session()->get('app_locale')
            ?: $request->cookie('app_locale')
            ?: config('app.locale');

        if (! in_array($locale, $supported, true)) {
            $locale = 'en';
        }

        app()->setLocale($locale);

        return $next($request);
    }
}

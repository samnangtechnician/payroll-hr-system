<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LocaleController extends Controller
{
    /**
     * Persist the locale on the server (cookie + session) so the next
     * full page render uses the same locale. The client side flips UI
     * strings via vue-i18n without a page refresh.
     */
    public function store(Request $request): JsonResponse|RedirectResponse
    {
        $supported = ['en', 'km'];
        $locale = $request->input('locale');

        if (! in_array($locale, $supported, true)) {
            if (! $request->expectsJson()) {
                return redirect()->back();
            }

            return response()->json(['ok' => false, 'message' => 'unsupported locale'], 422);
        }

        session(['app_locale' => $locale]);
        cookie()->queue('app_locale', $locale, 60 * 24 * 365);

        app()->setLocale($locale);

        if (! $request->expectsJson()) {
            return redirect()->back();
        }

        return response()->json(['ok' => true, 'locale' => $locale]);
    }
}

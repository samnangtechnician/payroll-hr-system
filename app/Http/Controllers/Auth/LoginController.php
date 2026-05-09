<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\LoginHistory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $remember = $request->boolean('remember');

        if (! Auth::attempt(array_merge($credentials, ['is_active' => 1]), $remember)) {
            LoginHistory::create([
                'email' => $credentials['email'],
                'ip_address' => $request->ip(),
                'user_agent' => substr((string) $request->userAgent(), 0, 255),
                'was_successful' => false,
                'failure_reason' => 'invalid_credentials',
                'logged_in_at' => now(),
            ]);
            throw ValidationException::withMessages([
                'email' => __('auth.invalid_credentials'),
            ]);
        }

        $request->session()->regenerate();

        $user = Auth::user();
        $user->forceFill([
            'last_login_at' => now(),
            'last_login_ip' => $request->ip(),
            'failed_login_attempts' => 0,
        ])->save();

        LoginHistory::create([
            'user_id' => $user->id,
            'email' => $user->email,
            'ip_address' => $request->ip(),
            'user_agent' => substr((string) $request->userAgent(), 0, 255),
            'was_successful' => true,
            'logged_in_at' => now(),
        ]);

        sweetalert()->success(__('auth.login').' — '.__('common.welcome'));

        return redirect()->intended(route('admin.dashboard'));
    }

    public function logout(Request $request): RedirectResponse
    {
        $userId = Auth::id();
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($userId) {
            LoginHistory::where('user_id', $userId)
                ->whereNull('logged_out_at')
                ->latest('id')
                ->limit(1)
                ->update(['logged_out_at' => now()]);
        }

        return redirect()->route('login')->with('flash.success', __('auth.logged_out'));
    }
}

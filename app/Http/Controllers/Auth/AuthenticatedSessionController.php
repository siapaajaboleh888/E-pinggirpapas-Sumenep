<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(Request $request): View
    {
        // Optional: allow success message via query string
        if ($request->filled('success')) {
            session()->flash('success', $request->query('success'));
        }

        if ($request->filled('warning')) {
            session()->flash('warning', $request->query('warning'));
        }

        // If we have a persisted post-register success message, surface it
        if (!session()->has('success') && session()->has('post_register_success')) {
            session()->flash('success', session('post_register_success'));
        }

        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate input
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password harus diisi',
        ]);

        // Rate limiting
        $throttleKey = Str::lower($request->email) . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return back()->withErrors([
                'email' => "Terlalu banyak percobaan login. Silakan coba lagi dalam {$seconds} detik."
            ])->onlyInput('email');
        }

        // Attempt authentication
        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            $request->session()->regenerate();
            
            // Clear rate limiter on successful login
            RateLimiter::clear($throttleKey);
            
            $user = Auth::user();
            
            // Redirect based on role with Bahasa Indonesia messages
            if ($user->isAdmin()) {
                // Admin always redirect to dashboard (no intended URL)
                return redirect()->route('admin.dashboard')
                    ->with('success', 'Selamat datang kembali, ' . $user->name . '!');
            }
            
            // Regular user: redirect to intended URL or home as fallback
            return redirect()->intended(route('home'))
                ->with('success', 'Selamat datang kembali, ' . $user->name . '!');
        }

        // Increment rate limiter
        RateLimiter::hit($throttleKey, 60); // 60 seconds

        // Failed authentication
        return back()->withErrors([
            'email' => 'Email atau password salah',
        ])->onlyInput('email');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home')
            ->with('success', 'Anda telah berhasil logout');
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        try {
            $request->user()->sendEmailVerificationNotification();
            return back()->with('status', 'verification-link-sent')
                         ->with('success', 'Tautan verifikasi telah dikirim ulang ke email Anda.');
        } catch (\Throwable $e) {
            return back()->with('warning', 'Gagal mengirim email verifikasi. Periksa konfigurasi email pada server atau coba beberapa saat lagi.');
        }
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
            // Validate input with Bahasa Indonesia messages
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'phone' => ['nullable', 'string', 'max:20'],
                'password' => ['required', 'string', 'min:8', 'regex:/^(?=.*[A-Za-z])(?=.*\d).+$/', 'confirmed'],
            ], [
                'name.required' => 'Nama harus diisi',
                'name.max' => 'Nama maksimal 255 karakter',
                'email.required' => 'Email harus diisi',
                'email.email' => 'Format email tidak valid',
                'email.unique' => 'Email sudah terdaftar',
                'phone.max' => 'Nomor telepon maksimal 20 karakter',
                'password.required' => 'Password harus diisi',
                'password.min' => 'Password minimal 8 karakter',
                'password.regex' => 'Password wajib kombinasi huruf dan angka.',
                'password.confirmed' => 'Konfirmasi password tidak cocok',
            ]);

            // Check if email already exists
            if (User::where('email', $request->email)->exists()) {
                return back()
                    ->withInput($request->only('name', 'email', 'phone'))
                    ->withErrors(['email' => 'Email sudah terdaftar'])
                    ->with('warning', 'Email tersebut sudah digunakan. Silakan login atau pakai email lain.');
            }

            // Create user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'role' => 'user',
            ]);

            // DEV MODE: Auto-verify email (tanpa mengirim email)
            $warning = null;
            try {
                $user->forceFill(['email_verified_at' => now()])->save();
            } catch (\Throwable $e) {
                // abaikan jika gagal menandai verifikasi
            }

            // Auto-login after registration
            Auth::login($user);

            $successMsg = 'Akun berhasil dibuat. Cek email (INBOX/SPAM) untuk aktivasi. Jika belum menerima email, gunakan tombol Kirim Ulang.';

            // Persist success message for later (e.g., when user goes to /login manually)
            session(['post_register_success' => $successMsg]);

            $response = redirect()->route('home')
                ->with('success', 'Registrasi berhasil. Selamat datang, ' . $user->name . '!');

            if ($warning) {
                $response->with('warning', $warning);
            }

            return $response;
    }
}

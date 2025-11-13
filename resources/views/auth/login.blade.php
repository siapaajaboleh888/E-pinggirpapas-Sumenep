<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    @if (session('success'))
        <div class="mb-4 border border-green-400 bg-green-50 p-4 text-sm text-green-800 rounded">
            <div class="font-extrabold text-center text-green-700 mb-2">SUKSES!!!</div>
            <div class="text-justify">{!! nl2br(e(session('success'))) !!}</div>
        </div>
    @endif

    @if (session('warning'))
        <div class="mb-4 rounded-md bg-yellow-100 p-3 text-sm text-yellow-800">
            {{ session('warning') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 rounded-md bg-red-100 p-3 text-sm text-red-800">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <div class="relative">
                <x-text-input id="password" class="block mt-1 w-full pr-10"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
                
                <button type="button" 
                        onclick="togglePassword('password', 'togglePasswordIcon')" 
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-600 hover:text-gray-900">
                    <i class="fas fa-eye" id="togglePasswordIcon"></i>
                </button>
            </div>

            <p class="mt-2 text-xs text-gray-500">
                Gunakan password minimal 8 karakter dengan kombinasi huruf dan angka.
            </p>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="mt-4 space-y-3">
            <div class="text-sm text-gray-600">
                Belum punya akun?
                <a href="{{ route('register') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">
                    Daftar di sini
                </a>
            </div>
            <div class="flex items-center justify-end gap-3">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
                <x-primary-button>
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </div>
    </form>

    @push('scripts')
    <script>
        function togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
    @endpush
</x-guest-layout>

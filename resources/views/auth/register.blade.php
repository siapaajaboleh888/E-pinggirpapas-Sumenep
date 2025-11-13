<x-guest-layout>
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

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <div class="relative">
                <x-text-input id="password" class="block mt-1 w-full pr-10"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
                
                <button type="button" 
                        onclick="togglePassword('password', 'togglePasswordIcon')" 
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-600 hover:text-gray-900">
                    <i class="fas fa-eye" id="togglePasswordIcon"></i>
                </button>
            </div>

            <p class="mt-2 text-xs text-gray-500">
                Password wajib minimal 8 karakter dan berisi kombinasi huruf serta angka.
            </p>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <div class="relative">
                <x-text-input id="password_confirmation" class="block mt-1 w-full pr-10"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />
                
                <button type="button" 
                        onclick="togglePassword('password_confirmation', 'togglePasswordConfirmIcon')" 
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-600 hover:text-gray-900">
                    <i class="fas fa-eye" id="togglePasswordConfirmIcon"></i>
                </button>
            </div>

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
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

        // Simple client-side validation for password rules
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('form[action="{{ route('register') }}"]');
            const pwd = document.getElementById('password');
            const pwd2 = document.getElementById('password_confirmation');
            form.addEventListener('submit', function (e) {
                let messages = [];
                if (pwd.value.length < 8) {
                    messages.push('Password minimal 8 karakter.');
                }
                if (pwd.value !== pwd2.value) {
                    messages.push('Konfirmasi password tidak cocok.');
                }
                if (messages.length > 0) {
                    e.preventDefault();
                    alert(messages.join('\n'));
                }
            });
        });
    </script>
    @endpush
</x-guest-layout>


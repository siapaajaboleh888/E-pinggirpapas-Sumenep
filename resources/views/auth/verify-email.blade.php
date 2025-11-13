<x-guest-layout>
    @if (session('success'))
        <div class="mb-4 rounded-md bg-green-100 p-3 text-sm text-green-800">
            {{ session('success') }}
        </div>
    @endif
    <div class="mb-4 text-sm text-gray-600">
        Terima kasih telah mendaftar. Silakan verifikasi email Anda melalui tautan yang baru saja kami kirim. Jika belum menerima email, Anda dapat meminta kirim ulang.
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            Tautan verifikasi baru telah dikirim ke email yang Anda gunakan saat pendaftaran.
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    Kirim Ulang Email Verifikasi
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Keluar
            </button>
        </form>
    </div>

    <div class="mt-4 text-sm text-gray-600">
        <a href="{{ route('login', ['success' => 'Akun berhasil dibuat. Cek INBOX/SPAM untuk aktivasi. Jika belum menerima email, gunakan tombol Kirim Ulang.']) }}" class="text-indigo-600 hover:text-indigo-800">
            Kembali ke Login
        </a>
    </div>
</x-guest-layout>

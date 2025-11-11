<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-2">
                        Selamat Datang, {{ Auth::user()->name }}! 👋
                    </h3>
                    <p class="text-gray-600">
                        Anda login sebagai <span class="font-semibold text-blue-600">Administrator</span>
                    </p>
                    <p class="text-sm text-gray-500 mt-2">
                        Email: {{ Auth::user()->email }}
                    </p>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Total Users -->
                <div class="bg-blue-500 text-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-semibold uppercase">Total Users</div>
                        <div class="text-3xl font-bold mt-2">
                            {{ \App\Models\User::count() }}
                        </div>
                    </div>
                </div>

                <!-- Total Admins -->
                <div class="bg-green-500 text-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-semibold uppercase">Total Admins</div>
                        <div class="text-3xl font-bold mt-2">
                            {{ \App\Models\User::where('role', 'admin')->count() }}
                        </div>
                    </div>
                </div>

                <!-- Total Pemesanan -->
                <div class="bg-purple-500 text-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-semibold uppercase">Total Pemesanan</div>
                        <div class="text-3xl font-bold mt-2">
                            @php
                                try {
                                    echo \App\Models\Pemesanan::count();
                                } catch (\Exception $e) {
                                    echo '0';
                                }
                            @endphp
                        </div>
                    </div>
                </div>
            </div>

            <!-- Admin Info -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h4 class="text-lg font-bold mb-4">Informasi Admin Panel</h4>
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Akses penuh ke semua fitur administrasi</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Kelola user, produk, dan pemesanan</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Protected dengan role-based middleware</span>
                        </div>
                    </div>

                    <div class="mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                        <p class="text-sm text-yellow-800">
                            <strong>⚠️ Admin Panel:</strong> Halaman ini hanya bisa diakses oleh user dengan role 'admin'.
                            User biasa akan mendapat error 403 Forbidden jika mencoba mengakses halaman ini.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <!-- Logo & Brand -->
        <a class="navbar-brand d-flex align-items-center" href="/">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo E-Pinggirpapas" style="height: 60px; margin-right: 12px;">
            <div style="line-height: 1.3;">
                <span style="font-size: 1.2rem; font-weight: 700; display: block;">E-Pinggirpapas-Sumenep</span>
                <span style="font-size: 0.75rem; opacity: 0.8; display: block;">Petambak Garam KUGAR</span>
            </div>
        </a>

        @if (session('success'))
            <div style="background-color: #ff5900; color: #ffffff; border: 1px solid #ff5900; padding: 10px; margin-bottom: 10px;">
                {{ session('success') }}
            </div>
        @endif

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a href="/" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="/about" class="nav-link">Tentang KUGAR</a></li>
                <li class="nav-item"><a href="/produk" class="nav-link">Produk Garam</a></li>
                <li class="nav-item"><a href="/blog" class="nav-link">Artikel & Edukasi</a></li>
                <li class="nav-item"><a href="/contacts" class="nav-link">Kontak</a></li>
                
                <!-- Dropdown Pemberdayaan -->
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Pemberdayaan
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow-lg rounded-lg p-3" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item font-weight-bold text-primary mb-2" href="/petambak">
                            <i class="fas fa-users"></i> Profil Petambak
                        </a>
                        <a class="dropdown-item text-dark mb-2" href="/pelatihan">
                            <i class="fas fa-chalkboard-teacher"></i> Program Pelatihan
                        </a>
                        <a class="dropdown-item text-dark mb-2" href="/galeri">
                            <i class="fas fa-images"></i> Galeri Kegiatan
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-muted" href="/blue-economy">
                            <i class="fas fa-water"></i> Blue Economy
                        </a>
                    </div>
                </li>

                <!-- Authentication Links -->
                @auth
                    <!-- User sudah login, tampilkan Dashboard & Logout -->
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow-lg rounded-lg p-2" aria-labelledby="userDropdown">
                            @if(Auth::user()->isAdmin())
                                {{-- Admin Menu --}}
                                <a class="dropdown-item py-2" href="{{ route('admin.dashboard') }}">
                                    <i class="fas fa-tachometer-alt text-primary me-2"></i> Admin Dashboard
                                </a>
                                <a class="dropdown-item py-2" href="{{ route('admin.produk.index') }}">
                                    <i class="fas fa-box text-success me-2"></i> Kelola Produk
                                </a>
                                <a class="dropdown-item py-2" href="{{ route('admin.pemesanan.index') }}">
                                    <i class="fas fa-clipboard-list text-info me-2"></i> Kelola Pesanan
                                </a>
                            @else
                                {{-- User Menu --}}
                                <a class="dropdown-item py-2" href="{{ route('home') }}">
                                    <i class="fas fa-tachometer-alt text-primary me-2"></i> Dashboard
                                </a>
                                <a class="dropdown-item py-2" href="{{ route('pemesanan.track.form') }}">
                                    <i class="fas fa-shopping-bag text-success me-2"></i> Pesanan Saya
                                </a>
                                <a class="dropdown-item py-2" href="{{ route('profile.edit') }}">
                                    <i class="fas fa-user text-info me-2"></i> Profil
                                </a>
                            @endif
                            <div class="dropdown-divider"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger py-2">
                                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                                </button>
                            </form>
                        </div>
                    </li>
                @else
                    <!-- User belum login, tampilkan Masuk & Daftar -->
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link" style="color: #fff; font-weight: 500;">
                            <i class="fas fa-sign-in-alt"></i> Masuk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="nav-link" style="background: #ff5900; color: #fff; padding: 8px 20px; border-radius: 20px; font-weight: 500; margin-left: 10px;">
                            <i class="fas fa-user-plus"></i> Daftar
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<style>
/* Styling tambahan untuk navbar dengan logo baru */
.navbar-brand {
    transition: transform 0.3s ease;
}

.navbar-brand:hover {
    transform: translateY(-2px);
}

.navbar-brand img {
    transition: transform 0.3s ease;
}

.navbar-brand:hover img {
    transform: rotate(5deg) scale(1.05);
}

/* Responsive untuk mobile */
@media (max-width: 768px) {
    .navbar-brand img {
        height: 45px !important;
        margin-right: 8px !important;
    }
    
    .navbar-brand div span:first-child {
        font-size: 1rem !important;
    }
    
    .navbar-brand div span:last-child {
        font-size: 0.65rem !important;
    }
}
</style>
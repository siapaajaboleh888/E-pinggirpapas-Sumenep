<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="E-Pinggirpapas-Sumenep - e-Business Petambak Garam KUGAR Desa Pinggirpapas">
    <title>E-Pinggirpapas-Sumenep | e-Business Petambak Garam KUGAR</title>
    <link rel="icon" href="{{ asset('assets/images/logo.png') }}" type="image/png">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #0066CC;
            --secondary-color: #00A86B;
            --accent-color: #FF6B35;
            --dark-blue: #003B73;
            --light-blue: #E8F4F8;
            --white: #FFFFFF;
            --dark: #1A1A2E;
            --text-gray: #6C757D;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            color: var(--dark);
            overflow-x: hidden;
        }
        
        /* ========== NAVBAR - FIXED ========== */
        .navbar {
            padding: 0.75rem 0;
            background: rgba(255, 255, 255, 0.98) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        
        /* Logo & Brand - NEW */
        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--primary-color) !important;
            transition: transform 0.3s ease;
        }
        
        .navbar-brand:hover {
            transform: translateY(-2px);
        }
        
        .navbar-brand img {
            height: 50px;
            width: 50px;
            object-fit: contain;
            transition: transform 0.3s ease;
        }
        
        .navbar-brand:hover img {
            transform: rotate(5deg) scale(1.05);
        }
        
        .brand-text {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }
        
        .brand-main {
            font-size: 1rem;
            font-weight: 700;
            color: var(--primary-color);
        }
        
        .brand-sub {
            font-size: 0.7rem;
            font-weight: 400;
            color: var(--text-gray);
            letter-spacing: 0.5px;
        }
        
        /* Nav Links - SPACING FIXED */
        .nav-link {
            font-weight: 500;
            margin: 0 0.4rem;
            padding: 0.5rem 0.8rem;
            font-size: 0.95rem;
            color: var(--dark) !important;
            transition: color 0.3s ease;
            white-space: nowrap;
        }
        
        .nav-link:hover {
            color: var(--primary-color) !important;
        }
        
        .nav-link.active {
            color: var(--primary-color) !important;
            font-weight: 600;
        }
        
        /* Button Pesan Sekarang */
        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary-color), #0052A3);
            border: none;
            padding: 0.65rem 1.75rem;
            font-weight: 600;
            border-radius: 50px;
            color: white;
            transition: all 0.3s ease;
            white-space: nowrap;
        }
        
        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 102, 204, 0.3);
            color: white;
        }
        
        /* Hero Section */
        .hero {
            position: relative;
            min-height: 100vh;
            background: linear-gradient(135deg, #0066CC 0%, #003B73 100%);
            display: flex;
            align-items: center;
            overflow: hidden;
            padding-top: 100px;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,138.7C960,139,1056,117,1152,112C1248,107,1344,117,1392,122.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
            background-size: cover;
            background-position: bottom;
            opacity: 0.5;
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
            color: white;
        }
        
        .hero h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }
        
        .hero p {
            font-size: 1.25rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }
        
        .hero-stats {
            display: flex;
            gap: 3rem;
            margin-top: 3rem;
        }
        
        .stat-item {
            text-align: center;
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            display: block;
        }
        
        .stat-label {
            font-size: 0.9rem;
            opacity: 0.8;
        }
        
        /* Section Styling */
        .section {
            padding: 5rem 0;
        }
        
        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 3rem;
            color: var(--dark-blue);
        }
        
        .section-subtitle {
            text-align: center;
            color: var(--text-gray);
            margin-bottom: 3rem;
            font-size: 1.1rem;
        }
        
        /* Product Cards */
        .product-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            height: 100%;
        }
        
        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }
        
        .product-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }
        
        .product-body {
            padding: 1.5rem;
        }
        
        .product-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--dark-blue);
        }
        
        .product-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--secondary-color);
            margin-bottom: 1rem;
        }
        
        /* Features */
        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
            color: white;
        }
        
        .feature-card {
            text-align: center;
            padding: 2rem;
            border-radius: 20px;
            transition: all 0.3s ease;
        }
        
        .feature-card:hover {
            background: var(--light-blue);
            transform: translateY(-5px);
        }

        /* Virtual Tour Section */
        .virtual-tour-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            position: relative;
        }

        .virtual-tour-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }

        .virtual-tour-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .virtual-tour-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, transparent, rgba(0,0,0,0.7));
            display: flex;
            align-items: flex-end;
            padding: 1.5rem;
            color: white;
        }

        .virtual-tour-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80px;
            height: 80px;
            background: rgba(0, 102, 204, 0.9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            transition: all 0.3s ease;
        }

        .virtual-tour-card:hover .virtual-tour-icon {
            transform: translate(-50%, -50%) scale(1.1);
        }
        
        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, var(--secondary-color), #008556);
            color: white;
            padding: 5rem 0;
            text-align: center;
        }
        
        .cta-section h2 {
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
        }
        
        .btn-light-custom {
            background: white;
            color: var(--secondary-color);
            padding: 1rem 3rem;
            font-weight: 600;
            border-radius: 50px;
            border: none;
            transition: all 0.3s ease;
        }
        
        .btn-light-custom:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        
        /* Footer */
        footer {
            background: var(--dark-blue);
            color: white;
            padding: 3rem 0 1rem;
        }
        
        .footer-links a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            display: block;
            margin-bottom: 0.5rem;
            transition: color 0.3s ease;
        }
        
        .footer-links a:hover {
            color: white;
        }
        
        .social-icons a {
            display: inline-block;
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            text-align: center;
            line-height: 40px;
            margin-right: 0.5rem;
            color: white;
            transition: all 0.3s ease;
        }
        
        .social-icons a:hover {
            background: var(--secondary-color);
            transform: translateY(-3px);
        }
        
        /* ========== RESPONSIVE ========== */
        @media (max-width: 768px) {
            .navbar-brand img {
                height: 40px;
                width: 40px;
            }
            
            .brand-main {
                font-size: 0.9rem;
            }
            
            .brand-sub {
                font-size: 0.65rem;
            }
            
            .nav-link {
                margin: 0.25rem 0;
                padding: 0.5rem 1rem;
            }
            
            .hero h1 {
                font-size: 2rem;
            }
            
            .hero-stats {
                flex-direction: column;
                gap: 1.5rem;
            }
            
            .section-title {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>

    <!-- ========== NAVBAR - FIXED ========== -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top bg-white">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo E-Pinggirpapas-Sumenep">
                <div class="brand-text">
                    <span class="brand-main">E-Pinggirpapas-Sumenep</span>
                    <span class="brand-sub">Petambak Garam KUGAR</span>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link active" href="{{ route('home') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('produk.index') }}">Produk Garam</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('gfk') }}">GFK</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('activities') }}">Aktivitas</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('virtual.index') }}">Virtual Tour</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('blue.economy') }}">Blue Economy</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Kontak</a></li>
                    
                    {{-- Authentication Links --}}
                    @auth
                        {{-- User sudah login - tampilkan dropdown --}}
                        <li class="nav-item dropdown ms-3">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle fa-lg me-2"></i>
                                <span>{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                @if(Auth::user()->isAdmin())
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i>Admin Dashboard</a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.produk.index') }}"><i class="fas fa-box me-2"></i>Kelola Produk</a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.pemesanan.index') }}"><i class="fas fa-clipboard-list me-2"></i>Kelola Pesanan</a></li>
                                @else
                                    <li><a class="dropdown-item" href="{{ route('home') }}"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
                                    <li><a class="dropdown-item" href="{{ route('pemesanan.track.form') }}"><i class="fas fa-shopping-bag me-2"></i>Pesanan Saya</a></li>
                                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-user me-2"></i>Profil</a></li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item ms-2">
                            <a href="{{ route('pemesanan.create') }}" class="btn btn-primary-custom">
                                <i class="fas fa-shopping-cart me-2"></i>Pesan Sekarang
                            </a>
                        </li>
                    @else
                        {{-- Guest - tampilkan tombol Login dan Register --}}
                        <li class="nav-item ms-3">
                            <a href="{{ route('login') }}" class="btn btn-outline-primary">
                                <i class="fas fa-sign-in-alt me-2"></i>Masuk
                            </a>
                        </li>
                        <li class="nav-item ms-2">
                            <a href="{{ route('register') }}" class="btn btn-primary-custom">
                                <i class="fas fa-user-plus me-2"></i>Daftar
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    @include('layouts.flash')

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-content" data-aos="fade-right">
                    <h1>Garam Berkualitas dari Petambak Tradisional</h1>
                    <p>Memberdayakan petambak garam Desa Pinggirpapas melalui e-Business dan Garam Fortifikasi Kelor (GFK) untuk penguatan Blue Economy</p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="{{ route('produk.index') }}" class="btn btn-light-custom">
                            <i class="fas fa-box me-2"></i>Lihat Produk
                        </a>
                        <a href="{{ route('gfk') }}" class="btn btn-outline-light btn-lg" style="border-radius: 50px;">
                            Tentang GFK
                        </a>
                        <a href="{{ route('virtual.index') }}" class="btn btn-outline-light btn-lg" style="border-radius: 50px;">
                            <i class="fas fa-vr-cardboard me-2"></i>Virtual Tour
                        </a>
                    </div>
                    
                    <div class="hero-stats">
                        <div class="stat-item" data-aos="fade-up" data-aos-delay="100">
                            <span class="stat-number">{{ $stats['area_tambak'] ?? '45 Ha' }}</span>
                            <span class="stat-label">Luas Tambak</span>
                        </div>
                        <div class="stat-item" data-aos="fade-up" data-aos-delay="200">
                            <span class="stat-number">{{ $stats['total_petambak'] ?? '45+' }}</span>
                            <span class="stat-label">Petambak</span>
                        </div>
                        <div class="stat-item" data-aos="fade-up" data-aos-delay="300">
                            <span class="stat-number">{{ $stats['produksi_tahunan'] ?? '500 Ton' }}</span>
                            <span class="stat-label">Produksi/Tahun</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    {{-- ✅ CHANGED: Unsplash → petambak-garam.jpg --}}
                    <img src="{{ asset('assets/images/petambak-garam.jpg') }}" alt="Petambak Garam" class="img-fluid rounded-4 shadow-lg">
                </div>
            </div>
        </div>
    </section>

    <!-- Produk Unggulan -->
    <section class="section bg-light">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">Produk Garam Unggulan</h2>
            <p class="section-subtitle" data-aos="fade-up">Garam berkualitas tinggi langsung dari petambak tradisional</p>
            
            <div class="row g-4">
                @forelse($produkUnggulan ?? [] as $produk)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="product-card">
                        <img src="{{ $produk->image_url }}" alt="{{ $produk->nama }}" class="product-image">
                        <div class="product-body">
                            <h3 class="product-title">{{ $produk->nama }}</h3>
                            <p class="text-muted">{{ Str::limit($produk->deskripsi, 100) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="product-price">Rp {{ number_format($produk->price, 0, ',', '.') }}</span>
                                <a href="{{ route('produk.show', $produk->id) }}" class="btn btn-primary-custom btn-sm">
                                    Detail <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                {{-- ✅ PLACEHOLDER dengan GAMBAR LOKAL --}}
                <div class="col-lg-4 col-md-6" data-aos="fade-up">
                    <div class="product-card">
                        <img src="{{ asset('assets/images/garam-konsumsi.jpg') }}" alt="Garam Konsumsi" class="product-image">
                        <div class="product-body">
                            <h3 class="product-title">Garam Konsumsi Premium</h3>
                            <p class="text-muted">Garam murni berkualitas tinggi untuk kebutuhan dapur</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="product-price">Rp 15.000</span>
                                <a href="{{ route('produk.index') }}" class="btn btn-primary-custom btn-sm">
                                    Detail <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="product-card">
                        <img src="{{ asset('assets/images/garam-gfk.jpg') }}" alt="Garam Fortifikasi Kelor" class="product-image">
                        <div class="product-body">
                            <h3 class="product-title">Garam Fortifikasi Kelor (GFK)</h3>
                            <p class="text-muted">Garam + nutrisi daun kelor untuk kesehatan keluarga</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="product-price">Rp 25.000</span>
                                <a href="{{ route('gfk') }}" class="btn btn-primary-custom btn-sm">
                                    Detail <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="product-card">
                        <img src="{{ asset('assets/images/garam-industri.jpg') }}" alt="Garam Industri" class="product-image">
                        <div class="product-body">
                            <h3 class="product-title">Garam Industri</h3>
                            <p class="text-muted">Garam untuk kebutuhan industri dan pengolahan</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="product-price">Rp 8.000</span>
                                <a href="{{ route('produk.index') }}" class="btn btn-primary-custom btn-sm">
                                    Detail <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>
            
            <div class="text-center mt-5" data-aos="fade-up">
                <a href="{{ route('produk.index') }}" class="btn btn-primary-custom btn-lg">
                    Lihat Semua Produk <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Virtual Tour Petambak -->
    @if(isset($virtualTours) && $virtualTours->count() > 0)
    <section class="section">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">Jelajahi Petambak Garam Secara Virtual</h2>
            <p class="section-subtitle" data-aos="fade-up">Lihat proses pembuatan garam dari dekat melalui Virtual Tour 360°</p>
            
            <div class="row g-4">
                @foreach($virtualTours as $tour)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="virtual-tour-card">
                        {{-- ✅ CHANGED: Unsplash → petambak-garam.jpg (jika thumbnail kosong) --}}
                        <img src="{{ $tour->thumbnail_url ?? asset('assets/images/petambak-garam.jpg') }}" alt="{{ $tour->title }}">
                        <div class="virtual-tour-icon">
                            <i class="fas fa-vr-cardboard"></i>
                        </div>
                        <div class="virtual-tour-overlay">
                            <div>
                                <h4 class="mb-1">{{ $tour->title }}</h4>
                                <p class="mb-0 small">{{ $tour->description ?? 'Virtual Tour 360°' }}</p>
                            </div>
                        </div>
                        <a href="{{ $tour->link ?? route('virtual.show', $tour->slug ?? $tour->id) }}" 
                           class="stretched-link" 
                           @if(!empty($tour->link)) target="_blank" @endif></a>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="text-center mt-5" data-aos="fade-up">
                <a href="{{ route('virtual.index') }}" class="btn btn-primary-custom btn-lg">
                    <i class="fas fa-vr-cardboard me-2"></i>Lihat Semua Virtual Tour
                </a>
            </div>
        </div>
    </section>
    @endif

    <!-- Keunggulan -->
    <section class="section bg-light">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">Mengapa Memilih E-Pinggirpapas?</h2>
            
            <div class="row g-4 mt-4">
                <div class="col-lg-3 col-md-6" data-aos="fade-up">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-certificate"></i>
                        </div>
                        <h4>100% Alami</h4>
                        <p class="text-muted">Diproses secara tradisional tanpa bahan kimia berbahaya</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4>Memberdayakan Petambak</h4>
                        <p class="text-muted">Langsung dari petambak lokal Desa Pinggirpapas</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-leaf"></i>
                        </div>
                        <h4>Inovasi GFK</h4>
                        <p class="text-muted">Garam fortifikasi kelor untuk nutrisi lebih baik</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-shipping-fast"></i>
                        </div>
                        <h4>Pengiriman Cepat</h4>
                        <p class="text-muted">Dikirim langsung ke seluruh Indonesia</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container" data-aos="fade-up">
            <h2>Siap Mencoba Garam Berkualitas dari E-Pinggirpapas?</h2>
            <p class="lead mb-4">Dukung petambak lokal dan dapatkan garam terbaik untuk keluarga Anda</p>
            <div class="d-flex gap-3 justify-content-center flex-wrap">
                <a href="{{ route('pemesanan.create') }}" class="btn btn-light-custom btn-lg">
                    <i class="fas fa-shopping-cart me-2"></i>Pesan Sekarang
                </a>
                <a href="{{ route('virtual.index') }}" class="btn btn-outline-light btn-lg" style="border-radius: 50px;">
                    <i class="fas fa-vr-cardboard me-2"></i>Virtual Tour
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="Logo E-Pinggirpapas" style="height: 50px; margin-right: 15px;">
                        <h4 class="mb-0">E-Pinggirpapas-Sumenep</h4>
                    </div>
                    <p class="text-white-50">Pemberdayaan Ekonomi Petambak Garam melalui e-Business dan Garam Fortifikasi Kelor untuk Blue Economy berkelanjutan.</p>
                    <div class="social-icons mt-3">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-whatsapp"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5 class="mb-3">Produk</h5>
                    <div class="footer-links">
                        <a href="{{ route('produk.index') }}">Garam Konsumsi</a>
                        <a href="{{ route('gfk') }}">Garam Fortifikasi Kelor</a>
                        <a href="{{ route('produk.index') }}">Garam Industri</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="mb-3">Informasi</h5>
                    <div class="footer-links">
                        <a href="{{ route('about') }}">Tentang Kami</a>
                        <a href="{{ route('activities') }}">Aktivitas Petambak</a>
                        <a href="{{ route('virtual.index') }}">Virtual Tour</a>
                        <a href="{{ route('blue.economy') }}">Blue Economy</a>
                        <a href="{{ route('contact') }}">Kontak</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="mb-3">Kontak</h5>
                    <div class="text-white-50">
                        <p><i class="fas fa-map-marker-alt me-2"></i>Desa Pinggirpapas, Sumenep<br>Jawa Timur, Indonesia</p>
                        <p><i class="fas fa-phone me-2"></i><a href="tel:+6285334159328" class="text-white-50 text-decoration-none">+62 85334159328</a></p>
                        <p><i class="fas fa-envelope me-2"></i><a href="mailto:kosabangsa25@gmail.com" class="text-white-50 text-decoration-none">kosabangsa25@gmail.com</a></p>
                    </div>
                </div>
            </div>
            <hr class="bg-white opacity-25 my-4">
            <div class="text-center text-white-50">
                <p class="mb-0">&copy; <script>document.write(new Date().getFullYear());</script> E-Pinggirpapas-Sumenep. Program Kosabangsa - Blue Economy & GFK Initiative</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- AOS Animation -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 100
        });
    </script>
</body>
</html>
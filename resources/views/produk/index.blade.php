<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Garam | E-Pinggirpapas-Sumenep</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #0066CC;
            --secondary: #00A86B;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            padding-top: 80px;
        }
        
        .navbar {
            background: white !important;
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
        }
        
        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .navbar-brand img {
            height: 50px;
            width: auto;
        }
        
        .brand-text {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }
        
        .brand-title {
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--primary);
            margin: 0;
        }
        
        .brand-subtitle {
            font-size: 0.75rem;
            color: #666;
            font-weight: 400;
        }
        
        .navbar-nav {
            gap: 0.5rem;
            align-items: center;
        }

        .nav-link {
            padding: 0.5rem 0.75rem;
            transition: all 0.3s ease;
            border-radius: 8px;
            white-space: nowrap;
        }
        
        .nav-link:hover {
            color: var(--primary);
            background-color: rgba(0, 102, 204, 0.1);
        }
        
        .nav-link.active {
            color: var(--primary) !important;
            font-weight: 600;
            background-color: rgba(0, 102, 204, 0.1);
        }

        .nav-item .btn-primary {
            transition: all 0.3s ease;
        }
        
        .nav-item .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 102, 204, 0.3);
        }
        
        .hero-section {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 4rem 0;
            margin-bottom: 3rem;
        }
        
        .product-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
            border-radius: 15px;
            overflow: hidden;
        }
        
        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        
        .product-image {
            height: 250px;
            object-fit: cover;
            width: 100%;
        }
        
        .price-tag {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--secondary);
        }
        
        /* ✅ IMAGE LOADING STATE */
        .image-loading {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }
        
        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
        
        @media (max-width: 768px) {
            .navbar-brand img {
                height: 40px;
            }
            
            .brand-title {
                font-size: 0.9rem;
            }
            
            .brand-subtitle {
                font-size: 0.65rem;
            }
            
            .hero-section {
                padding: 2rem 0;
            }
            
            .navbar-nav {
                gap: 0.25rem;
                margin-top: 1rem;
            }
            
            .nav-link {
                padding: 0.75rem;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('assets/images/logo.png') }}" alt="KUGAR Logo" onerror="this.style.display='none'">
                <div class="brand-text">
                    <span class="brand-title">E-Pinggirpapas-Sumenep</span>
                    <span class="brand-subtitle">Petambak Garam KUGAR</span>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('produk.index') }}">Produk Garam</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('gfk') }}">GFK</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('activities') }}">Aktivitas</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('virtual.index') }}">Virtual Tour</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('blue.economy') }}">Blue Economy</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Kontak</a></li>
                    
                    @auth
                        <li class="nav-item dropdown ms-3">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle fa-lg me-2"></i>
                                <span>{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="{{ route('home') }}"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-user me-2"></i>Profil</a></li>
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
                            <a href="{{ route('pemesanan.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-shopping-cart me-1"></i>Pesan Sekarang
                            </a>
                        </li>
                    @else
                        <li class="nav-item ms-3">
                            <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-sign-in-alt me-2"></i>Masuk
                            </a>
                        </li>
                        <li class="nav-item ms-2">
                            <a href="{{ route('register') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-user-plus me-2"></i>Daftar
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container text-center">
            <h1 class="display-4 fw-bold mb-3">Produk Garam Berkualitas</h1>
            <p class="lead">Dari Petambak Tradisional Desa Pinggirpapas - Sumenep</p>
            <p class="mb-0">Program Kosabangsa - Blue Economy & GFK Initiative</p>
        </div>
    </section>

    <!-- Breadcrumb -->
    <section class="py-3 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Produk Garam</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Products Grid -->
    <section class="py-5">
        <div class="container">
            {{-- Alert Messages --}}
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(isset($produks) && $produks->count() > 0)
                <div class="row mb-4">
                    <div class="col-12">
                        <h3 class="fw-bold">Semua Produk Garam <span class="badge bg-primary">{{ $produks->total() }}</span></h3>
                        <p class="text-muted">Pilih produk garam berkualitas dari petambak lokal</p>
                    </div>
                </div>

                <div class="row g-4">
                    @foreach($produks as $produk)
                    <div class="col-lg-4 col-md-6">
                        <div class="card product-card border-0 shadow">
                            {{-- ✅ SIMPLIFIED IMAGE HANDLING - USE ACCESSOR --}}
                            <img src="{{ $produk->image_url }}" 
                                 class="card-img-top product-image image-loading" 
                                 alt="{{ $produk->nama }}"
                                 loading="lazy"
                                 onload="this.classList.remove('image-loading')"
                                 onerror="this.src='{{ asset('assets/images/garam-default.jpg') }}'; this.classList.remove('image-loading')">
                            
                            <div class="card-body d-flex flex-column">
                                <span class="badge bg-success mb-2 align-self-start">Garam Premium</span>
                                <h5 class="card-title fw-bold">{{ $produk->nama }}</h5>
                                <p class="card-text text-muted flex-grow-1">{{ Str::limit($produk->deskripsi, 100) }}</p>
                                
                                <div class="mb-3">
                                    <div class="price-tag">{{ $produk->formatted_price }}</div>
                                    <small class="text-muted">Per {{ $produk->satuan }}</small>
                                </div>

                                <div class="mb-2">
                                    <small class="text-muted">
                                        <i class="fas fa-map-marker-alt me-1"></i>{{ $produk->alamat }}
                                    </small>
                                </div>
                                
                                <div class="d-grid gap-2 mt-auto">
                                    <a href="{{ route('produk.show', $produk->id) }}" class="btn btn-primary">
                                        <i class="fas fa-eye me-2"></i>Lihat Detail
                                    </a>
                                    <a href="{{ $produk->whatsapp_link }}" 
                                       target="_blank" 
                                       class="btn btn-success btn-sm">
                                        <i class="fab fa-whatsapp me-2"></i>Hubungi Penjual
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-5 d-flex justify-content-center">
                    {{ $produks->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-box-open fa-5x text-muted mb-4"></i>
                    <h3 class="text-muted mb-3">Belum Ada Produk</h3>
                    <p class="text-muted mb-4">Produk garam akan segera ditambahkan. Silakan cek kembali nanti.</p>
                    <a href="{{ route('home') }}" class="btn btn-primary">
                        <i class="fas fa-home me-2"></i>Kembali ke Beranda
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- Info Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="text-center">
                        <div class="mb-3">
                            <i class="fas fa-shield-alt fa-3x text-primary"></i>
                        </div>
                        <h5 class="fw-bold">Produk Terjamin</h5>
                        <p class="text-muted">Garam murni dari petambak lokal dengan kualitas terjaga</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <div class="mb-3">
                            <i class="fas fa-shipping-fast fa-3x text-success"></i>
                        </div>
                        <h5 class="fw-bold">Pengiriman Cepat</h5>
                        <p class="text-muted">Tersedia pengiriman ke seluruh Indonesia</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <div class="mb-3">
                            <i class="fas fa-handshake fa-3x text-info"></i>
                        </div>
                        <h5 class="fw-bold">Mendukung Petani</h5>
                        <p class="text-muted">Langsung dari petambak, mendukung ekonomi lokal</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container text-center">
            <p class="mb-0">&copy; 2024 E-Pinggirpapas-Sumenep | Petambak Garam KUGAR</p>
            <p class="mb-0 small">Program Kosabangsa - Blue Economy & GFK Initiative</p>
            <div class="mt-3">
                <a href="#" class="text-white me-3"><i class="fab fa-facebook fa-lg"></i></a>
                <a href="#" class="text-white me-3"><i class="fab fa-instagram fa-lg"></i></a>
                <a href="#" class="text-white me-3"><i class="fab fa-whatsapp fa-lg"></i></a>
                <a href="#" class="text-white"><i class="fab fa-youtube fa-lg"></i></a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
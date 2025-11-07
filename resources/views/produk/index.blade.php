<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Garam KUGAR | Desa Pinggirpapas</title>
    <link rel="icon" href="{{ asset('assets/images/logo.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #0066CC;
            --secondary: #00A86B;
            --dark: #1A1A2E;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            padding-top: 85px;
            background: #f8f9fa;
        }
        
        .navbar {
            background: white !important;
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
            padding: 0.75rem 0;
        }
        
        /* ✅ FIX 1: Logo & Brand Styling */
        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--primary) !important;
            text-decoration: none;
        }
        
        .navbar-brand:hover {
            color: var(--primary) !important;
        }
        
        .navbar-brand img {
            height: 45px;
            width: 45px;
            object-fit: contain;
        }
        
        .brand-text {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }
        
        .brand-main {
            font-size: 1rem;
            font-weight: 700;
            color: var(--primary);
        }
        
        .brand-sub {
            font-size: 0.7rem;
            font-weight: 400;
            color: #6C757D;
        }
        
        /* ✅ FIX 2: Navigation Spacing - LEBIH RAPAT */
        .navbar-nav {
            gap: 0;
        }
        
        .nav-link {
            margin: 0;
            padding: 0.5rem 0.5rem !important;
            font-size: 0.875rem;
            transition: all 0.3s ease;
            white-space: nowrap;
        }
        
        .nav-link:hover {
            color: var(--primary) !important;
        }
        
        .nav-link.active {
            color: var(--primary) !important;
            font-weight: 600;
        }
        
        /* ✅ FIX 3: Button Pesan - LEBIH KECIL & TIDAK TERPOTONG */
        .btn-pesan {
            background: linear-gradient(135deg, var(--primary), #0052A3);
            border: none;
            border-radius: 50px;
            padding: 0.4rem 1rem !important;
            color: white !important;
            font-weight: 600;
            font-size: 0.8rem;
            transition: all 0.3s ease;
            white-space: nowrap;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            text-decoration: none;
        }
        
        .btn-pesan:hover {
            background: linear-gradient(135deg, #0052A3, var(--primary));
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,102,204,0.3);
            color: white !important;
        }
        
        .btn-pesan i {
            font-size: 0.75rem;
        }
        
        .product-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            background: white;
        }
        
        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }
        
        .product-img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }
        
        .price {
            color: var(--secondary);
            font-size: 1.5rem;
            font-weight: 700;
        }
        
        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary), #0052A3);
            border: none;
            border-radius: 50px;
            padding: 0.5rem 1.5rem;
            color: white;
            font-weight: 600;
        }
        
        .category-badge {
            display: inline-block;
            padding: 0.5rem 1.5rem;
            background: var(--primary);
            color: white;
            border-radius: 50px;
            margin: 0.5rem;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
        }
        
        .category-badge:hover {
            background: var(--secondary);
            transform: scale(1.05);
            text-decoration: none;
            color: white;
        }
        
        /* Responsive Design */
        @media (max-width: 991px) {
            .navbar-brand img {
                height: 35px;
                width: 35px;
            }
            
            .brand-main {
                font-size: 0.85rem;
            }
            
            .brand-sub {
                font-size: 0.65rem;
            }
            
            .nav-link {
                padding: 0.4rem 0.5rem !important;
                font-size: 0.85rem;
            }
            
            .btn-pesan {
                padding: 0.35rem 0.8rem !important;
                font-size: 0.75rem;
                margin-top: 0.5rem;
            }
        }
        
        @media (max-width: 768px) {
            body {
                padding-top: 70px;
            }
            
            .navbar {
                padding: 0.5rem 0;
            }
            
            .navbar-brand img {
                height: 32px;
                width: 32px;
            }
            
            .brand-main {
                font-size: 0.8rem;
            }
            
            .brand-sub {
                font-size: 0.6rem;
            }
            
            .btn-pesan {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>

    <!-- ✅ FIXED Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <!-- ✅ Logo + Brand -->
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo E-Pinggirpapas">
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
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('produk.index') }}">Produk Garam</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('gfk') }}">GFK</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('activities') }}">Aktivitas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('virtual.index') }}">Virtual Tour</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('blue.economy') }}">Blue Economy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">Kontak</a>
                    </li>
                    <!-- ✅ FIX: Button TIDAK pakai route() tapi pakai URL langsung -->
                    <li class="nav-item ms-2">
                        <a href="/pemesanan/buat" class="btn-pesan">
                            <i class="fas fa-shopping-cart"></i>
                            <span>Pesan</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-4">
                <h1 class="display-4 fw-bold">Produk Garam KUGAR</h1>
                <p class="lead text-muted">Garam berkualitas tinggi dari Desa Pinggirpapas</p>
            </div>

            <!-- Filter Kategori -->
            @if($categories && $categories->count() > 0)
            <div class="text-center">
                <a href="{{ route('produk.index') }}" class="category-badge">Semua Produk</a>
                @foreach($categories as $cat)
                    <a href="{{ route('produk.category', $cat->slug ?? $cat->id) }}" class="category-badge">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>
            @endif
        </div>
    </section>

    <!-- Produk List -->
    <section class="py-4">
        <div class="container">
            <div class="row g-4">
                @forelse($produks as $produk)
                <div class="col-lg-4 col-md-6">
                    <div class="card product-card h-100">
                        <img src="{{ $produk->image ?? 'https://images.unsplash.com/photo-1560717845-968905ba5ebf?w=500' }}" 
                             alt="{{ $produk->name }}" 
                             class="product-img">
                        <div class="card-body">
                            @if(isset($produk->category))
                            <span class="badge bg-primary mb-2">{{ $produk->category }}</span>
                            @endif
                            <h5 class="card-title fw-bold">{{ $produk->name }}</h5>
                            <p class="text-muted">{{ Str::limit($produk->description ?? 'Garam berkualitas premium', 100) }}</p>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="price">Rp {{ number_format($produk->price ?? 0, 0, ',', '.') }}</span>
                                <a href="{{ route('produk.show', $produk->id) }}" class="btn btn-primary-custom btn-sm">
                                    Detail <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-info text-center py-4">
                        <i class="fas fa-info-circle me-2 fs-4"></i>
                        <h5 class="mb-2">Belum ada produk tersedia. Segera hadir!</h5>
                        <p class="mb-0">Kami sedang mempersiapkan produk garam terbaik untuk Anda</p>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if(method_exists($produks, 'links'))
            <div class="mt-4">
                {{ $produks->links() }}
            </div>
            @endif
        </div>
    </section>

    <!-- CTA -->
    <section class="py-4 bg-primary text-white">
        <div class="container text-center">
            <h2 class="mb-3">Tertarik Memesan Garam KUGAR?</h2>
            <p class="lead mb-4">Hubungi kami untuk pemesanan dalam jumlah besar</p>
            <a href="{{ route('contact') }}" class="btn btn-light btn-lg">
                <i class="fas fa-phone me-2"></i>Hubungi Kami
            </a>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- ✅ Script untuk memastikan link berfungsi -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Pastikan link tidak di-prevent
            const btnPesan = document.querySelector('.btn-pesan');
            if (btnPesan) {
                btnPesan.addEventListener('click', function(e) {
                    // Tidak prevent default, biarkan navigasi normal
                    console.log('Navigating to:', this.href);
                });
            }
        });
    </script>
</body>
</html>
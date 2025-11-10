<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Garam Fortifikasi Kelor (GFK) | E-Pinggirpapas-Sumenep</title>
    <link rel="icon" href="{{ asset('assets/images/logo.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #0066CC;
            --secondary-color: #00A86B;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            padding-top: 85px;
        }
        
        .navbar {
            background: white !important;
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
            padding: 0.75rem 0;
        }
        
        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--primary-color) !important;
            text-decoration: none;
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
            color: var(--primary-color);
        }
        
        .brand-sub {
            font-size: 0.7rem;
            font-weight: 400;
            color: #6C757D;
        }
        
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
            color: var(--primary-color) !important;
        }
        
        .nav-link.active {
            color: var(--primary-color) !important;
            font-weight: 600;
        }
        
        .btn-pesan {
            background: linear-gradient(135deg, var(--primary-color), #0052A3);
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
            background: linear-gradient(135deg, #0052A3, var(--primary-color));
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,102,204,0.3);
        }
        
        .hero-gfk {
            background: linear-gradient(135deg, #00A86B, #008556);
            color: white;
            padding: 100px 0;
        }
        
        .manfaat-card {
            padding: 2rem;
            border-radius: 20px;
            background: white;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            text-align: center;
            transition: all 0.3s;
            height: 100%;
        }
        
        .manfaat-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }
        
        .icon-large {
            font-size: 4rem;
            margin-bottom: 1rem;
        }
        
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
            
            .btn-pesan {
                padding: 0.35rem 0.8rem !important;
                font-size: 0.75rem;
                margin-top: 0.5rem;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
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
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('produk.index') }}">Produk Garam</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('gfk') }}">GFK</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('activities') }}">Aktivitas</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('virtual.index') }}">Virtual Tour</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('blue.economy') }}">Blue Economy</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Kontak</a></li>
                    <li class="nav-item ms-2">
                        <a href="{{ route('pemesanan.create') }}" class="btn-pesan">
                            <i class="fas fa-shopping-cart"></i>
                            <span>Pesan</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="hero-gfk">
        <div class="container text-center">
            <h1 class="display-3 fw-bold mb-4">🌿 Garam Fortifikasi Kelor (GFK)</h1>
            <p class="lead mb-4">Inovasi Garam Bergizi untuk Ketahanan Pangan & Kesehatan Keluarga Indonesia</p>
            <p class="fs-5">Menggabungkan kualitas garam laut alami dengan nutrisi super dari daun kelor</p>
        </div>
    </section>

    <!-- Manfaat GFK -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold">6 Manfaat Luar Biasa GFK</h2>
                <p class="lead text-muted">Kenapa GFK Baik untuk Kesehatan Anda?</p>
            </div>

            <div class="row g-4">
                @foreach($manfaat as $item)
                <div class="col-lg-4 col-md-6">
                    <div class="manfaat-card">
                        <div class="icon-large">{{ $item['icon'] }}</div>
                        <h4 class="fw-bold mb-3">{{ $item['title'] }}</h4>
                        <p class="text-muted">{{ $item['description'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Apa itu Daun Kelor -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <img src="{{ asset('assets/images/kelor.jpg') }}" 
                         alt="Daun Kelor" 
                         class="img-fluid rounded-4 shadow">
                </div>
                <div class="col-lg-6">
                    <h2 class="display-6 fw-bold mb-4">Apa itu Daun Kelor?</h2>
                    <p class="lead">Daun kelor (Moringa oleifera) dikenal sebagai "Pohon Ajaib" karena kandungan nutrisinya yang sangat tinggi.</p>
                    
                    <div class="mt-4">
                        <h5 class="fw-bold">Kandungan Nutrisi:</h5>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check-circle text-success me-2"></i>Vitamin A - 4x lebih banyak dari wortel</li>
                            <li><i class="fas fa-check-circle text-success me-2"></i>Vitamin C - 7x lebih banyak dari jeruk</li>
                            <li><i class="fas fa-check-circle text-success me-2"></i>Kalsium - 4x lebih banyak dari susu</li>
                            <li><i class="fas fa-check-circle text-success me-2"></i>Protein - 2x lebih banyak dari yogurt</li>
                            <li><i class="fas fa-check-circle text-success me-2"></i>Zat Besi - 3x lebih banyak dari bayam</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Produk GFK -->
    @if(isset($produkGFK) && $produkGFK->count() > 0)
    <section class="py-5">
        <div class="container">
            <h2 class="text-center display-6 fw-bold mb-5">Produk GFK Tersedia</h2>
            <div class="row g-4">
                @foreach($produkGFK as $produk)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ $produk->image ?? asset('assets/images/garam-kelor.jpg') }}" 
                             class="card-img-top" 
                             style="height: 250px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $produk->name }}</h5>
                            <p class="text-muted">{{ Str::limit($produk->description ?? '', 100) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fs-4 fw-bold text-success">Rp {{ number_format($produk->price ?? 0, 0, ',', '.') }}</span>
                                <a href="{{ route('produk.show', $produk->id) }}" class="btn btn-primary">Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- CTA -->
    <section class="py-5 bg-success text-white">
        <div class="container text-center">
            <h2 class="mb-3">Mulai Hidup Sehat dengan GFK!</h2>
            <p class="lead mb-4">Dukung program ketahanan pangan dan kesehatan keluarga Indonesia</p>
            <a href="{{ route('produk.index') }}" class="btn btn-light btn-lg me-3">
                <i class="fas fa-shopping-cart me-2"></i>Lihat Produk
            </a>
            <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg">
                <i class="fas fa-phone me-2"></i>Hubungi Kami
            </a>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
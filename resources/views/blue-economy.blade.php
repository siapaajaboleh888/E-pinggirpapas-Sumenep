<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Economy | E-Pinggirpapas-Sumenep</title>
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
        
        .hero-blue {
            background: linear-gradient(135deg, #0EA5E9, #0284C7);
            color: white;
            padding: 100px 0;
        }
        
        .prinsip-card {
            background: white;
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: all 0.3s;
            height: 100%;
            border-top: 5px solid;
        }
        
        .prinsip-card.primary { border-color: #0066CC; }
        .prinsip-card.success { border-color: #00A86B; }
        .prinsip-card.warning { border-color: #F59E0B; }
        .prinsip-card.info { border-color: #0EA5E9; }
        
        .prinsip-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }
        
        .icon-box {
            font-size: 3rem;
            margin-bottom: 1.5rem;
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
                    <li class="nav-item"><a class="nav-link" href="{{ route('gfk') }}">GFK</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('activities') }}">Aktivitas</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('virtual.index') }}">Virtual Tour</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('blue.economy') }}">Blue Economy</a></li>
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
    <section class="hero-blue">
        <div class="container text-center">
            <div class="mb-4">
                <i class="fas fa-water" style="font-size: 4rem;"></i>
            </div>
            <h1 class="display-3 fw-bold mb-3">Blue Economy</h1>
            <p class="lead mb-4">Pemberdayaan Berkelanjutan Petambak Garam KUGAR</p>
            <p class="fs-5">Program Kosabangsa untuk Penguatan Ekonomi Pesisir Desa Pinggirpapas</p>
        </div>
    </section>

    <!-- 4 Prinsip Blue Economy -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold">4 Prinsip Blue Economy KUGAR</h2>
                <p class="lead text-muted">Komitmen kami untuk pembangunan berkelanjutan</p>
            </div>

            <div class="row g-4">
                @foreach($prinsip as $item)
                <div class="col-lg-6">
                    <div class="prinsip-card {{ $item['color'] }}">
                        <div class="icon-box">{{ $item['icon'] }}</div>
                        <h3 class="fw-bold mb-3">{{ $item['title'] }}</h3>
                        <p class="text-muted mb-0">{{ $item['description'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Dampak Program -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="fw-bold mb-4">Dampak Positif Program</h2>
                    <p class="lead mb-4">Program Blue Economy KUGAR telah memberikan manfaat nyata bagi masyarakat pesisir</p>
                    
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="bg-white p-4 rounded-3 shadow-sm text-center">
                                <h2 class="fw-bold text-primary mb-2">45+</h2>
                                <p class="mb-0 text-muted">Petambak Diberdayakan</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-white p-4 rounded-3 shadow-sm text-center">
                                <h2 class="fw-bold text-success mb-2">45 Ha</h2>
                                <p class="mb-0 text-muted">Luas Area Tambak</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-white p-4 rounded-3 shadow-sm text-center">
                                <h2 class="fw-bold text-warning mb-2">500 Ton</h2>
                                <p class="mb-0 text-muted">Target Produksi/Tahun</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-white p-4 rounded-3 shadow-sm text-center">
                                <h2 class="fw-bold text-info mb-2">100%</h2>
                                <p class="mb-0 text-muted">Ramah Lingkungan</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="{{ asset('assets/images/blue-economy.jpg') }}" 
                         alt="Blue Economy" 
                         class="img-fluid rounded-4 shadow-lg">
                </div>
            </div>
        </div>
    </section>

    <!-- Artikel/Blog -->
    @if(isset($blogs) && $blogs->count() > 0)
    <section class="py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Artikel Blue Economy</h2>
            <div class="row g-4">
                @foreach($blogs as $blog)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="{{ $blog->image ?? asset('assets/images/blue-economy.jpg') }}" 
                             class="card-img-top" 
                             style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <span class="badge bg-primary mb-2">Blue Economy</span>
                            <h5 class="card-title fw-bold">{{ $blog->title }}</h5>
                            <p class="text-muted small">{{ Str::limit($blog->excerpt ?? '', 100) }}</p>
                            <a href="#" class="btn btn-outline-primary btn-sm">Baca Selengkapnya</a>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <small class="text-muted">
                                <i class="far fa-calendar me-2"></i>{{ $blog->created_at ? $blog->created_at->format('d M Y') : 'Baru' }}
                            </small>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- CTA -->
    <section class="py-5 text-white" style="background: linear-gradient(135deg, #0EA5E9, #0284C7);">
        <div class="container text-center">
            <h2 class="mb-3">Dukung Program Blue Economy Kami!</h2>
            <p class="lead mb-4">Mari bersama-sama membangun ekonomi pesisir yang berkelanjutan</p>
            <div class="d-flex gap-3 justify-content-center flex-wrap">
                <a href="{{ route('produk.index') }}" class="btn btn-light btn-lg">
                    <i class="fas fa-shopping-cart me-2"></i>Beli Produk Kami
                </a>
                <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg">
                    <i class="fas fa-handshake me-2"></i>Kemitraan
                </a>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
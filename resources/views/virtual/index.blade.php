<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Virtual Tour Petambak | E-Pinggirpapas-Sumenep</title>
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
            gap: 0.25rem;
            align-items: center;
        }
        
        .nav-item {
            margin: 0;
        }
        
        .nav-link {
            padding: 0.5rem 1rem !important;
            white-space: nowrap;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover {
            color: var(--primary) !important;
        }
        
        .nav-link.active {
            color: var(--primary) !important;
            font-weight: 500;
        }
        
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
        }
        
        .hero-vr {
            background: linear-gradient(135deg, #6B46C1, #9333EA);
            color: white;
            padding: 80px 0 60px;
        }
        
        .vr-card {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: all 0.3s;
            height: 100%;
        }
        
        .vr-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        
        .vr-img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }
        
        .vr-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, transparent, rgba(0,0,0,0.8));
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 2rem;
            color: white;
        }
        
        .vr-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80px;
            height: 80px;
            background: rgba(107, 70, 193, 0.9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }
        
        .vr-card:hover .vr-icon {
            transform: translate(-50%, -50%) scale(1.1);
            background: rgba(107, 70, 193, 1);
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
            
            .nav-link {
                padding: 0.5rem 0.75rem !important;
            }
            
            .btn-pesan {
                padding: 0.35rem 0.8rem !important;
                font-size: 0.75rem;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('assets/images/logo.png') }}" alt="KUGAR Logo">
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
                    <li class="nav-item"><a class="nav-link" href="{{ route('produk.index') }}">Produk Garam</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('gfk') }}">GFK</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('activities') }}">Aktivitas</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('virtual.index') }}">Virtual Tour</a></li>
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
    <section class="hero-vr">
        <div class="container text-center">
            <div class="mb-4">
                <i class="fas fa-vr-cardboard" style="font-size: 4rem;"></i>
            </div>
            <h1 class="display-4 fw-bold mb-3">Virtual Tour Petambak Garam</h1>
            <p class="lead">Jelajahi petambak garam KUGAR Desa Pinggirpapas dalam pengalaman 360° interaktif</p>
        </div>
    </section>

    <!-- Virtual Tours -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                @forelse($virtualTours as $tour)
                <div class="col-lg-4 col-md-6">
                    <a href="{{ $tour->link ?? route('virtual.show', $tour->id) }}" 
                       class="text-decoration-none" 
                       @if(!empty($tour->link)) target="_blank" @endif>
                        <div class="vr-card">
                            <img src="{{ $tour->thumbnail_url }}" 
                                 alt="{{ $tour->title }}" 
                                 class="vr-img">
                            
                            <div class="vr-icon">
                                <i class="fas fa-vr-cardboard fa-2x text-white"></i>
                            </div>
                            
                            <div class="vr-overlay">
                                <h4 class="fw-bold mb-2">{{ $tour->title }}</h4>
                                <p class="mb-0 small">{{ $tour->description ?? 'Klik untuk memulai tour' }}</p>
                            </div>
                        </div>
                    </a>
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-info text-center py-5">
                        <i class="fas fa-vr-cardboard fa-3x mb-3 d-block"></i>
                        <h4>Virtual Tour Segera Hadir!</h4>
                        <p class="mb-0">Kami sedang mempersiapkan pengalaman virtual tour terbaik untuk Anda</p>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if(method_exists($virtualTours, 'links'))
            <div class="mt-4">
                {{ $virtualTours->links() }}
            </div>
            @endif
        </div>
    </section>

    <!-- Info Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="fw-bold mb-4">Pengalaman Virtual Tour 360°</h2>
                    <p class="lead">Lihat langsung proses pembuatan garam di Petambak KUGAR tanpa harus datang langsung!</p>
                    
                    <div class="mt-4">
                        <div class="d-flex align-items-start mb-3">
                            <div class="me-3">
                                <i class="fas fa-check-circle text-success fa-2x"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold">360° Panoramic View</h5>
                                <p class="text-muted">Lihat setiap sudut petambak dengan teknologi panorama 360 derajat</p>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-start mb-3">
                            <div class="me-3">
                                <i class="fas fa-check-circle text-success fa-2x"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold">Interaktif & Edukatif</h5>
                                <p class="text-muted">Pelajari proses pembuatan garam dengan penjelasan detail</p>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-start">
                            <div class="me-3">
                                <i class="fas fa-check-circle text-success fa-2x"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold">Akses Kapan Saja</h5>
                                <p class="text-muted">Nikmati virtual tour dari mana saja, kapan saja</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="{{ asset('assets/images/virtual-tour.jpg') }}" 
                         alt="Virtual Tour" 
                         class="img-fluid rounded-4 shadow">
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-5 text-white" style="background: linear-gradient(135deg, #6B46C1, #9333EA);">
        <div class="container text-center">
            <h2 class="mb-3">Ingin Mengunjungi Langsung?</h2>
            <p class="lead mb-4">Hubungi kami untuk atur kunjungan ke petambak garam KUGAR</p>
            <a href="{{ route('contact') }}" class="btn btn-light btn-lg">
                <i class="fas fa-phone me-2"></i>Hubungi Kami
            </a>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
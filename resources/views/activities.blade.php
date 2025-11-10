<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aktivitas Petambak Garam | E-Pinggirpapas-Sumenep</title>
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
        
        .hero-aktivitas {
            background: linear-gradient(135deg, var(--primary), #003B73);
            color: white;
            padding: 80px 0 60px;
        }
        
        .activity-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: all 0.3s;
            height: 100%;
        }
        
        .activity-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }
        
        .activity-img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }
        
        .activity-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            position: absolute;
            top: -30px;
            left: 50%;
            transform: translateX(-50%);
        }
        
        .duration-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(0,0,0,0.7);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.875rem;
        }
        
        .highlight-card {
            border: 3px solid var(--secondary);
            position: relative;
        }
        
        .highlight-badge {
            position: absolute;
            top: -15px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--secondary);
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            z-index: 1;
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
                    <li class="nav-item"><a class="nav-link active" href="{{ route('activities') }}">Aktivitas</a></li>
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
    <section class="hero-aktivitas">
        <div class="container text-center">
            <h1 class="display-4 fw-bold mb-3">Aktivitas Petambak Garam</h1>
            <p class="lead">6 Tahapan Proses Pembuatan Garam Berkualitas KUGAR dengan Teknologi Rumah Tunnel</p>
        </div>
    </section>

    <!-- Aktivitas Cards -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <!-- Tahap 1: Pembuatan Rumah Tunnel -->
                <div class="col-lg-4 col-md-6">
                    <div class="activity-card">
                        <div class="position-relative">
                            <img src="{{ asset('assets/images/pembuatan-rumah-tunnel.jpg') }}" 
                                 alt="Pembuatan Rumah Tunnel" 
                                 class="activity-img">
                            <div class="duration-badge">
                                <i class="far fa-clock me-2"></i>2-3 hari
                            </div>
                        </div>
                        
                        <div class="card-body position-relative pt-5">
                            <div class="activity-icon">
                                <i class="fas fa-building"></i>
                            </div>
                            
                            <div class="text-center mb-3">
                                <span class="badge bg-primary">Tahap 1</span>
                            </div>
                            
                            <h4 class="text-center fw-bold mb-3">Pembuatan Rumah Tunnel</h4>
                            <p class="text-muted">Pembangunan struktur rumah tunnel yang melindungi proses kristalisasi garam dari hujan dan kontaminasi. Rumah tunnel dilengkapi atap transparan untuk memaksimalkan panas matahari.</p>
                        </div>
                    </div>
                </div>

                <!-- Tahap 2: Pengisian Air Laut -->
                <div class="col-lg-4 col-md-6">
                    <div class="activity-card">
                        <div class="position-relative">
                            <img src="{{ asset('assets/images/pengisian-air-laut.jpg') }}" 
                                 alt="Pengisian Air Laut" 
                                 class="activity-img">
                            <div class="duration-badge">
                                <i class="far fa-clock me-2"></i>1 hari
                            </div>
                        </div>
                        
                        <div class="card-body position-relative pt-5">
                            <div class="activity-icon">
                                <i class="fas fa-water"></i>
                            </div>
                            
                            <div class="text-center mb-3">
                                <span class="badge bg-primary">Tahap 2</span>
                            </div>
                            
                            <h4 class="text-center fw-bold mb-3">Pengisian Air Laut</h4>
                            <p class="text-muted">Pengisian air laut ke dalam petak-petak di rumah tunnel dengan kadar salinitas yang tepat menggunakan sistem pompa air. Air laut yang berkualitas sangat penting untuk kristal garam yang baik.</p>
                        </div>
                    </div>
                </div>

                <!-- Tahap 3: Proses Kristalisasi -->
                <div class="col-lg-4 col-md-6">
                    <div class="activity-card">
                        <div class="position-relative">
                            <img src="{{ asset('assets/images/proses-kristalisasi.jpg') }}" 
                                 alt="Proses Kristalisasi" 
                                 class="activity-img">
                            <div class="duration-badge">
                                <i class="far fa-clock me-2"></i>7-10 hari
                            </div>
                        </div>
                        
                        <div class="card-body position-relative pt-5">
                            <div class="activity-icon">
                                <i class="fas fa-sun"></i>
                            </div>
                            
                            <div class="text-center mb-3">
                                <span class="badge bg-primary">Tahap 3</span>
                            </div>
                            
                            <h4 class="text-center fw-bold mb-3">Proses Kristalisasi</h4>
                            <p class="text-muted">Penjemuran dan penguapan air laut secara alami dengan sinar matahari di dalam rumah tunnel hingga terbentuk kristal garam berkualitas. Proses ini memakan waktu 7-10 hari tergantung cuaca.</p>
                        </div>
                    </div>
                </div>

                <!-- Tahap 4: Pemanenan Garam -->
                <div class="col-lg-4 col-md-6">
                    <div class="activity-card">
                        <div class="position-relative">
                            <img src="{{ asset('assets/images/pemanenan-garam.jpg') }}" 
                                 alt="Pemanenan Garam" 
                                 class="activity-img">
                            <div class="duration-badge">
                                <i class="far fa-clock me-2"></i>1-2 hari
                            </div>
                        </div>
                        
                        <div class="card-body position-relative pt-5">
                            <div class="activity-icon">
                                <i class="fas fa-hand-holding-water"></i>
                            </div>
                            
                            <div class="text-center mb-3">
                                <span class="badge bg-primary">Tahap 4</span>
                            </div>
                            
                            <h4 class="text-center fw-bold mb-3">Pemanenan Garam</h4>
                            <p class="text-muted">Pengumpulan kristal garam yang sudah siap panen dari rumah tunnel. Garam dipanen dengan hati-hati menggunakan alat khusus untuk menjaga kualitas dan kebersihan kristal.</p>
                        </div>
                    </div>
                </div>

                <!-- Tahap 5: Fortifikasi Kelor (GFK) - HIGHLIGHT -->
                <div class="col-lg-4 col-md-6">
                    <div class="activity-card highlight-card">
                        <div class="highlight-badge">
                            <i class="fas fa-star me-2"></i>INOVASI GFK
                        </div>
                        
                        <div class="position-relative">
                            <img src="{{ asset('assets/images/proses-gfk.jpg') }}" 
                                 alt="Fortifikasi Kelor" 
                                 class="activity-img">
                            <div class="duration-badge">
                                <i class="far fa-clock me-2"></i>1 hari
                            </div>
                        </div>
                        
                        <div class="card-body position-relative pt-5">
                            <div class="activity-icon">
                                <i class="fas fa-leaf"></i>
                            </div>
                            
                            <div class="text-center mb-3">
                                <span class="badge bg-success">Tahap 5</span>
                            </div>
                            
                            <h4 class="text-center fw-bold mb-3">Fortifikasi Kelor (GFK) - INOVASI!</h4>
                            <p class="text-muted">Proses inovatif pencampuran garam dengan ekstrak daun kelor (Moringa oleifera) untuk menghasilkan Garam Fortifikasi Kelor (GFK) yang kaya nutrisi dan mendukung ketahanan pangan Indonesia.</p>
                        </div>
                    </div>
                </div>

                <!-- Tahap 6: Pengemasan & Quality Control -->
                <div class="col-lg-4 col-md-6">
                    <div class="activity-card">
                        <div class="position-relative">
                            <img src="{{ asset('assets/images/pengemasan.jpg') }}" 
                                 alt="Pengemasan & Quality Control" 
                                 class="activity-img">
                            <div class="duration-badge">
                                <i class="far fa-clock me-2"></i>1 hari
                            </div>
                        </div>
                        
                        <div class="card-body position-relative pt-5">
                            <div class="activity-icon">
                                <i class="fas fa-box"></i>
                            </div>
                            
                            <div class="text-center mb-3">
                                <span class="badge bg-primary">Tahap 6</span>
                            </div>
                            
                            <h4 class="text-center fw-bold mb-3">Pengemasan & Quality Control</h4>
                            <p class="text-muted">Proses pengemasan garam dengan standar higienis dan quality control ketat untuk memastikan produk yang sampai ke konsumen berkualitas tinggi dan aman dikonsumsi.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Virtual Tour Section -->
    @if(isset($virtualTours) && $virtualTours->count() > 0)
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center fw-bold mb-4">Lihat Langsung Aktivitas Petambak</h2>
            <p class="text-center text-muted mb-5">Jelajahi petambak garam kami melalui Virtual Tour 360°</p>
            
            <div class="row g-4">
                @foreach($virtualTours->take(3) as $tour)
                <div class="col-lg-4 col-md-6">
                    <div class="card shadow-sm border-0">
                        <div class="position-relative">
                            <img src="{{ $tour->thumbnail ?? asset('assets/images/petambak-garam.jpg') }}" 
                                 class="card-img-top" 
                                 style="height: 200px; object-fit: cover;">
                            <div class="position-absolute top-50 start-50 translate-middle">
                                <div style="width: 60px; height: 60px; background: rgba(0,102,204,0.9); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-vr-cardboard fa-2x text-white"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <h5 class="fw-bold">{{ $tour->title }}</h5>
                            <p class="text-muted small">{{ $tour->description ?? 'Virtual Tour 360°' }}</p>
                            <a href="{{ route('virtual.show', $tour->id) }}" class="btn btn-primary btn-sm">
                                Mulai Tour <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="text-center mt-4">
                <a href="{{ route('virtual.index') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-vr-cardboard me-2"></i>Lihat Semua Virtual Tour
                </a>
            </div>
        </div>
    </section>
    @endif

    <!-- CTA -->
    <section class="py-5 bg-primary text-white">
        <div class="container text-center">
            <h2 class="mb-3">Tertarik dengan Proses Pembuatan Garam KUGAR?</h2>
            <p class="lead mb-4">Kunjungi petambak kami atau pesan produk garam berkualitas</p>
            <a href="{{ route('produk.index') }}" class="btn btn-light btn-lg me-3">
                <i class="fas fa-box me-2"></i>Lihat Produk
            </a>
            <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg">
                <i class="fas fa-phone me-2"></i>Hubungi Kami
            </a>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
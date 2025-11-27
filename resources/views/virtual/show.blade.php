<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $tour->title }} | Virtual Tour Petambak</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body style="font-family: 'Poppins', sans-serif; padding-top: 80px;">

    <nav class="navbar navbar-expand-lg navbar-light fixed-top bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('assets/images/logo.png') }}" alt="KUGAR Logo" style="height: 50px; width: auto;">
                <div class="d-inline-flex flex-column ms-2">
                    <span class="fw-bold" style="color:#0066CC;">E-Pinggirpapas-Sumenep</span>
                    <small class="text-muted">Petambak Garam KUGAR</small>
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
                        <a href="{{ route('pemesanan.create') }}" class="btn btn-primary btn-sm d-flex align-items-center gap-1">
                            <i class="fas fa-shopping-cart"></i>
                            <span>Pesan</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="py-5 bg-light">
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-8">
                    <a href="{{ route('virtual.index') }}" class="text-decoration-none mb-3 d-inline-flex align-items-center">
                        <i class="fas fa-arrow-left me-2"></i> Kembali ke Virtual Tour
                    </a>
                    <h1 class="fw-bold mb-2">{{ $tour->title }}</h1>
                    @if($tour->description)
                        <p class="text-muted">{{ $tour->description }}</p>
                    @endif
                </div>
            </div>

            @php
                $isLocalVideo = Str::endsWith($tour->link, ['.mp4', '.webm', '.ogg']);
            @endphp

            <div class="row">
                <div class="col-lg-8 mb-4">
                    <div class="card border-0 shadow-sm mb-3">
                        <div class="position-relative">
                            @if($isLocalVideo)
                                <video controls class="w-100 rounded-3" style="max-height: 420px; object-fit: cover;">
                                    <source src="{{ $tour->link }}" type="video/mp4">
                                    Browser Anda tidak mendukung pemutar video.
                                </video>
                            @else
                                <img src="{{ $tour->thumbnail_url }}" 
                                     alt="{{ $tour->title }}" 
                                     class="img-fluid w-100" 
                                     style="max-height: 420px; object-fit: cover;">

                                <div class="position-absolute top-50 start-50 translate-middle text-center">
                                    <a href="{{ $tour->link }}" target="_blank" class="btn btn-danger btn-lg px-4 py-2">
                                        <i class="fab fa-youtube me-2"></i> Tonton di YouTube
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if(!$isLocalVideo)
                    <p class="text-muted small mb-0">
                        Video diputar langsung di YouTube untuk kualitas terbaik.
                    </p>
                    @endif
                </div>

                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm mb-3">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Informasi Virtual Tour</h5>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Akses kapan saja, di mana saja</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Melihat proses pembuatan garam</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Mendukung program Blue Economy</li>
                            </ul>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Kunjungi Langsung</h5>
                            <p class="mb-3">Ingin merasakan langsung suasana petambak garam KUGAR Desa Pinggirpapas?</p>
                            <a href="{{ route('contact') }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-phone me-2"></i>Hubungi Kami
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

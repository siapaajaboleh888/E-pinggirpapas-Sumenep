<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $produk->nama }} | E-Pinggirpapas-Sumenep</title>
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
            background-color: #f8f9fa;
        }
        
        .navbar {
            background: white !important;
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
            z-index: 1000;
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
        
        .product-image {
            width: 100%;
            height: 500px;
            object-fit: cover;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        
        .price-tag {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--secondary);
        }
        
        .feature-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
        
        /* Image Loading State */
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
            
            .product-image {
                height: 300px;
            }
            
            .price-tag {
                font-size: 2rem;
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

    <!-- Breadcrumb -->
    <section class="py-3 bg-white shadow-sm">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('produk.index') }}">Produk</a></li>
                    <li class="breadcrumb-item active">{{ $produk->nama }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Product Detail -->
    <section class="py-5">
        <div class="container">
            <div class="row g-5">
                <!-- Product Image -->
                <div class="col-lg-6">
                    {{-- ✅ USE ACCESSOR - SIMPLIFIED --}}
                    <img src="{{ $produk->image_url }}" 
                         alt="{{ $produk->nama }}" 
                         class="product-image image-loading"
                         loading="eager"
                         onload="this.classList.remove('image-loading')"
                         onerror="this.src='{{ asset('assets/images/garam-default.jpg') }}'; this.classList.remove('image-loading')">
                </div>

                <!-- Product Info -->
                <div class="col-lg-6">
                    <span class="badge bg-success mb-3 px-3 py-2">Garam Premium</span>
                    <h1 class="display-5 fw-bold mb-3">{{ $produk->nama }}</h1>
                    <p class="lead text-muted mb-4">{{ $produk->deskripsi }}</p>
                    
                    <div class="price-tag mb-2">{{ $produk->formatted_price }}</div>
                    <p class="text-muted mb-4">Per {{ $produk->satuan }}</p>
                    
                    <hr class="my-4">
                    
                    <!-- Info Produk -->
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3"><i class="fas fa-info-circle me-2 text-primary"></i>Informasi Produk</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="fas fa-map-marker-alt text-success me-2"></i>
                                <strong>Alamat:</strong> {{ $produk->alamat }}
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-phone text-success me-2"></i>
                                <strong>Kontak:</strong> {{ $produk->nomor_hp }}
                            </li>
                            @if($produk->published_at)
                            <li class="mb-2">
                                <i class="fas fa-calendar text-success me-2"></i>
                                <strong>Published:</strong> {{ $produk->published_at->format('d M Y') }}
                            </li>
                            @endif
                        </ul>
                    </div>
                    
                    <!-- Quantity -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">Jumlah:</label>
                        <div class="input-group" style="max-width: 200px;">
                            <button class="btn btn-outline-secondary" type="button" id="decreaseQty">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input type="number" class="form-control text-center" value="1" min="1" id="quantity">
                            <button class="btn btn-outline-secondary" type="button" id="increaseQty">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="d-grid gap-3">
                        <a href="{{ route('pemesanan.create', ['produk_id' => $produk->id]) }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-shopping-cart me-2"></i>Pesan Sekarang
                        </a>
                        <a href="{{ $produk->whatsapp_link }}" 
                           target="_blank" 
                           class="btn btn-success btn-lg">
                            <i class="fab fa-whatsapp me-2"></i>Hubungi via WhatsApp
                        </a>
                        <a href="{{ route('produk.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Produk
                        </a>
                    </div>
                </div>
            </div>

            <!-- Product Description -->
            <div class="row mt-5">
                <div class="col-12">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#description">
                                <i class="fas fa-info-circle me-2"></i>Deskripsi
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#benefits">
                                <i class="fas fa-star me-2"></i>Keunggulan
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content p-4 border border-top-0 bg-white">
                        <!-- Description Tab -->
                        <div class="tab-pane fade show active" id="description">
                            <h4 class="mb-3">Deskripsi Produk</h4>
                            <p>{{ $produk->deskripsi }}</p>
                            <p>Diproduksi langsung oleh petambak lokal di {{ $produk->alamat }} dengan pengawasan ketat untuk menjamin kualitas dan kemurnian garam.</p>
                        </div>

                        <!-- Benefits Tab -->
                        <div class="tab-pane fade" id="benefits">
                            <h4 class="mb-3">Keunggulan Produk</h4>
                            <div class="row g-4 mt-2">
                                <div class="col-md-4">
                                    <div class="text-center">
                                        <div class="feature-icon mx-auto">
                                            <i class="fas fa-shield-alt"></i>
                                        </div>
                                        <h5 class="fw-bold">Murni & Alami</h5>
                                        <p class="text-muted">100% dari air laut tanpa tambahan kimia</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="text-center">
                                        <div class="feature-icon mx-auto">
                                            <i class="fas fa-certificate"></i>
                                        </div>
                                        <h5 class="fw-bold">Bersertifikat</h5>
                                        <p class="text-muted">Telah memiliki standar kualitas</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="text-center">
                                        <div class="feature-icon mx-auto">
                                            <i class="fas fa-handshake"></i>
                                        </div>
                                        <h5 class="fw-bold">Mendukung Petani</h5>
                                        <p class="text-muted">Langsung dari petambak lokal</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Products -->
    @if(isset($produkLainnya) && $produkLainnya->count() > 0)
    <section class="py-5 bg-light">
        <div class="container">
            <h3 class="text-center fw-bold mb-4">Produk Lainnya</h3>
            <div class="row g-4">
                @foreach($produkLainnya as $item)
                <div class="col-md-4">
                    <div class="card border-0 shadow h-100">
                        {{-- ✅ USE ACCESSOR --}}
                        <img src="{{ $item->image_url }}" 
                             class="card-img-top image-loading" 
                             style="height: 250px; object-fit: cover;" 
                             alt="{{ $item->nama }}"
                             loading="lazy"
                             onload="this.classList.remove('image-loading')"
                             onerror="this.src='{{ asset('assets/images/garam-default.jpg') }}'; this.classList.remove('image-loading')">
                        
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $item->nama }}</h5>
                            <p class="card-text text-muted flex-grow-1">{{ Str::limit($item->deskripsi, 80) }}</p>
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                <span class="fw-bold text-primary">{{ $item->formatted_price }}</span>
                                <a href="{{ route('produk.show', $item->id) }}" class="btn btn-primary btn-sm">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container text-center">
            <p class="mb-0">&copy; 2025 E-Pinggirpapas-Sumenep | Petambak Garam KUGAR</p>
            <p class="mb-0 small">Program Kosabangsa - Blue Economy & GFK Initiative</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Quantity controls
        document.getElementById('increaseQty').addEventListener('click', function() {
            let qty = document.getElementById('quantity');
            qty.value = parseInt(qty.value) + 1;
        });
        
        document.getElementById('decreaseQty').addEventListener('click', function() {
            let qty = document.getElementById('quantity');
            if(parseInt(qty.value) > 1) {
                qty.value = parseInt(qty.value) - 1;
            }
        });
    </script>
</body>
</html>
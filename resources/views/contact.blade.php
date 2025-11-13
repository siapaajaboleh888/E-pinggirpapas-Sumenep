<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak Kami | E-Pinggirpapas-Sumenep</title>
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
        
        .contact-card {
            border-radius: 20px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            padding: 2rem;
            height: 100%;
            text-align: center;
        }
        
        .contact-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #0066CC, #00A86B);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
            color: white;
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
                    <li class="nav-item"><a class="nav-link" href="{{ route('blue.economy') }}">Blue Economy</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('contact') }}">Kontak</a></li>
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
    <section class="py-5 bg-primary text-white">
        <div class="container text-center">
            <h1 class="display-4 fw-bold">Hubungi Kami</h1>
            <p class="lead">Ada pertanyaan? Kami siap membantu Anda!</p>
        </div>
    </section>

    <!-- Contact Info -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4 mb-5">
                <div class="col-lg-4 col-md-6">
                    <div class="contact-card">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h5 class="fw-bold">Alamat</h5>
                        <p class="text-muted">Desa Pinggirpapas<br>Sumenep, Jawa Timur<br>Indonesia</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="contact-card">
                        <div class="contact-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <h5 class="fw-bold">Telepon</h5>
                        <p class="text-muted">
                            <a href="tel:+6285334159328" class="text-decoration-none">+62 85334159328</a>
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="contact-card">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h5 class="fw-bold">Email</h5>
                        <p class="text-muted">
                            <a href="mailto:kosabangsa25@gmail.com" class="text-decoration-none">kosabangsa25@gmail.com</a>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-lg border-0">
                        <div class="card-body p-5">
                            <h3 class="text-center mb-4">Kirim Pesan</h3>
                            
                            @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show">
                                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                            @endif

                            @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show">
                                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                            @endif

                            <form action="{{ route('contact.submit') }}" method="POST">
                                @csrf
                                
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Nama Lengkap *</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                               value="{{ old('name') }}" required>
                                        @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Email *</label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                               value="{{ old('email') }}" required>
                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Telepon</label>
                                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" 
                                               value="{{ old('phone') }}">
                                        @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Subjek *</label>
                                        <input type="text" name="subject" class="form-control @error('subject') is-invalid @enderror" 
                                               value="{{ old('subject') }}" required>
                                        @error('subject')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Pesan *</label>
                                        <textarea name="message" rows="5" class="form-control @error('message') is-invalid @enderror" required>{{ old('message') }}</textarea>
                                        @error('message')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-primary btn-lg px-5">
                                            <i class="fas fa-paper-plane me-2"></i>Kirim Pesan
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Social Media -->
    <section class="py-5 bg-light">
        <div class="container text-center">
            <h3 class="mb-4">Ikuti Kami di Media Sosial</h3>
            <div class="d-flex justify-content-center gap-3">
                <a href="#" class="btn btn-outline-primary btn-lg rounded-circle" style="width: 60px; height: 60px;">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="btn btn-outline-danger btn-lg rounded-circle" style="width: 60px; height: 60px;">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#" class="btn btn-outline-success btn-lg rounded-circle" style="width: 60px; height: 60px;">
                    <i class="fab fa-whatsapp"></i>
                </a>
                <a href="#" class="btn btn-outline-danger btn-lg rounded-circle" style="width: 60px; height: 60px;">
                    <i class="fab fa-youtube"></i>
                </a>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
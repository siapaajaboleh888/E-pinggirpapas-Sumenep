<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lacak Pesanan | E-Pinggirpapas-Sumenep</title>
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 2rem 0;
        }
        
        .track-container {
            max-width: 600px;
            margin: 0 auto;
        }
        
        .track-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            padding: 3rem;
            animation: fadeInUp 0.5s ease;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .track-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .track-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(0, 102, 204, 0.7);
            }
            50% {
                transform: scale(1.05);
                box-shadow: 0 0 0 20px rgba(0, 102, 204, 0);
            }
        }
        
        .track-icon i {
            font-size: 2rem;
            color: white;
        }
        
        .form-control {
            border-radius: 12px;
            padding: 0.875rem 1.25rem;
            border: 2px solid #e0e0e0;
            font-size: 1rem;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(0, 102, 204, 0.1);
        }
        
        .btn-track {
            background: linear-gradient(135deg, var(--primary-color), #0052A3);
            border: none;
            border-radius: 12px;
            padding: 0.875rem 2rem;
            font-weight: 600;
            color: white;
            width: 100%;
            transition: all 0.3s ease;
        }
        
        .btn-track:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 102, 204, 0.3);
            color: white;
        }
        
        .back-link {
            text-align: center;
            margin-top: 1.5rem;
        }
        
        .back-link a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .back-link a:hover {
            text-decoration: underline;
        }
        
        .info-text {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 1rem;
            margin-top: 1.5rem;
            font-size: 0.9rem;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="track-container">
        <div class="track-card">
            <div class="track-header">
                <div class="track-icon">
                    <i class="fas fa-search-location"></i>
                </div>
                <h2 class="fw-bold mb-2">Lacak Pesanan Anda</h2>
                <p class="text-muted">Masukkan nomor pesanan untuk melacak status pengiriman</p>
            </div>

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

            <form action="{{ route('pemesanan.track') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nomor_pesanan" class="form-label fw-semibold">
                        <i class="fas fa-receipt me-2"></i>Nomor Pesanan
                    </label>
                    <input type="text" 
                           class="form-control @error('nomor_pesanan') is-invalid @enderror" 
                           id="nomor_pesanan" 
                           name="nomor_pesanan" 
                           placeholder="Contoh: PS20250112001" 
                           value="{{ old('nomor_pesanan') }}"
                           required
                           autofocus>
                    @error('nomor_pesanan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        Nomor pesanan dapat dilihat di email konfirmasi atau nota pembelian
                    </small>
                </div>

                <button type="submit" class="btn btn-track">
                    <i class="fas fa-search me-2"></i>Lacak Pesanan
                </button>
            </form>

            <div class="info-text">
                <h6 class="fw-semibold mb-2">
                    <i class="fas fa-lightbulb me-2"></i>Tips Pelacakan:
                </h6>
                <ul class="mb-0 ps-4">
                    <li>Pastikan nomor pesanan benar dan lengkap</li>
                    <li>Nomor pesanan biasanya dimulai dengan "PS"</li>
                    <li>Cek email Anda untuk mendapatkan nomor pesanan</li>
                </ul>
            </div>
        </div>

        <div class="back-link">
            <a href="{{ route('home') }}">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Beranda
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

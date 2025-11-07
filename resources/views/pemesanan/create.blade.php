<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Pemesanan | E-Pinggirpapas-Sumenep</title>
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
            background: #f8f9fa;
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
        
        .nav-link {
            margin: 0 0.15rem;
            padding: 0.5rem 0.6rem;
            font-size: 0.9rem;
        }
        
        .hero-order {
            background: linear-gradient(135deg, var(--secondary-color), #008556);
            color: white;
            padding: 60px 0 40px;
        }
        
        .order-card {
            background: white;
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        
        .step-badge {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            margin-right: 1rem;
        }
        
        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary-color), #0052A3);
            border: none;
            color: white;
            font-weight: 600;
        }
        
        .btn-primary-custom:hover {
            background: linear-gradient(135deg, #0052A3, var(--primary-color));
            color: white;
        }
        
        @media (max-width: 768px) {
            .navbar-brand img {
                height: 35px;
                width: 35px;
            }
            .brand-main {
                font-size: 0.9rem;
            }
            .brand-sub {
                font-size: 0.65rem;
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
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Kontak</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="hero-order">
        <div class="container text-center">
            <h1 class="display-5 fw-bold mb-3">
                <i class="fas fa-shopping-cart me-3"></i>Buat Pemesanan
            </h1>
            <p class="lead">Pesan garam berkualitas E-Pinggirpapas dengan mudah</p>
        </div>
    </section>

    <!-- Form Pemesanan -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    
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

                    @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <strong>Terjadi kesalahan:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    <div class="order-card">
                        <form action="{{ route('pemesanan.store') }}" method="POST" id="orderForm">
                            @csrf
                            
                            <!-- Step 1: Data Pemesan -->
                            <div class="mb-5">
                                <div class="d-flex align-items-center mb-4">
                                    <span class="step-badge">1</span>
                                    <h4 class="mb-0">Data Pemesan</h4>
                                </div>
                                
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Nama Lengkap *</label>
                                        <input type="text" name="nama_pemesan" class="form-control @error('nama_pemesan') is-invalid @enderror" 
                                               value="{{ old('nama_pemesan') }}" required>
                                        @error('nama_pemesan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Email *</label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                               value="{{ old('email') }}" required>
                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Telepon / WhatsApp *</label>
                                        <input type="tel" name="telepon" class="form-control @error('telepon') is-invalid @enderror" 
                                               value="{{ old('telepon') }}" placeholder="08123456789" required>
                                        @error('telepon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Alamat Pengiriman *</label>
                                        <textarea name="alamat_pengiriman" rows="3" class="form-control @error('alamat_pengiriman') is-invalid @enderror" required>{{ old('alamat_pengiriman') }}</textarea>
                                        @error('alamat_pengiriman')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Step 2: Pilih Produk -->
                            <div class="mb-5">
                                <div class="d-flex align-items-center mb-4">
                                    <span class="step-badge">2</span>
                                    <h4 class="mb-0">Pilih Produk</h4>
                                </div>
                                
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label class="form-label fw-semibold">Produk Garam *</label>
                                        <select name="produk_id" class="form-select @error('produk_id') is-invalid @enderror" required id="produkSelect">
                                            <option value="">-- Pilih Produk --</option>
                                            @if(isset($produks) && $produks->count() > 0)
                                                @foreach($produks as $produk)
                                                <option value="{{ $produk->id }}" data-price="{{ $produk->harga ?? 0 }}">
                                                    {{ $produk->nama }} - Rp {{ number_format($produk->harga ?? 0, 0, ',', '.') }}/kg
                                                </option>
                                                @endforeach
                                            @else
                                                <option value="1" data-price="15000">Garam Konsumsi Premium - Rp 15.000/kg</option>
                                                <option value="2" data-price="25000">Garam Fortifikasi Kelor (GFK) - Rp 25.000/kg</option>
                                                <option value="3" data-price="8000">Garam Industri - Rp 8.000/kg</option>
                                            @endif
                                        </select>
                                        @error('produk_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Jumlah (kg) *</label>
                                        <input type="number" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror" 
                                               value="{{ old('jumlah', 1) }}" min="1" required id="jumlahInput">
                                        @error('jumlah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Harga Satuan</label>
                                        <input type="text" class="form-control" id="hargaSatuan" readonly value="Rp 0">
                                        <input type="hidden" name="harga_satuan" id="hargaSatuanHidden">
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="alert alert-success">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <strong>Total Harga:</strong>
                                                <h4 class="mb-0" id="totalHarga">Rp 0</h4>
                                            </div>
                                        </div>
                                        <input type="hidden" name="total_harga" id="totalHargaHidden">
                                    </div>
                                </div>
                            </div>

                            <!-- Step 3: Catatan -->
                            <div class="mb-4">
                                <div class="d-flex align-items-center mb-4">
                                    <span class="step-badge">3</span>
                                    <h4 class="mb-0">Catatan Tambahan (Opsional)</h4>
                                </div>
                                
                                <textarea name="catatan" rows="3" class="form-control" placeholder="Contoh: Tolong kirim secepatnya, butuh untuk acara...">{{ old('catatan') }}</textarea>
                            </div>

                            <!-- Submit Button -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-success btn-lg px-5">
                                    <i class="fas fa-paper-plane me-2"></i>Kirim Pesanan
                                </button>
                                <p class="text-muted small mt-3 mb-0">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Tim kami akan menghubungi Anda untuk konfirmasi pesanan
                                </p>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Info Box -->
                    <div class="mt-4 p-4 bg-white rounded-3 shadow-sm">
                        <h5 class="fw-bold mb-3">
                            <i class="fas fa-lightbulb text-warning me-2"></i>Informasi Pemesanan
                        </h5>
                        <ul class="mb-0">
                            <li class="mb-2">Minimal pemesanan 1 kg</li>
                            <li class="mb-2">Ongkir disesuaikan dengan lokasi pengiriman</li>
                            <li class="mb-2">Pembayaran: Transfer Bank / COD (area Sumenep)</li>
                            <li class="mb-2">Pesanan diproses setelah pembayaran dikonfirmasi</li>
                            <li class="mb-0">Customer service: <strong>+62 812-3456-7890</strong> (WhatsApp)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Hitung total harga otomatis
        const produkSelect = document.getElementById('produkSelect');
        const jumlahInput = document.getElementById('jumlahInput');
        const hargaSatuan = document.getElementById('hargaSatuan');
        const hargaSatuanHidden = document.getElementById('hargaSatuanHidden');
        const totalHarga = document.getElementById('totalHarga');
        const totalHargaHidden = document.getElementById('totalHargaHidden');
        
        function hitungTotal() {
            const selectedOption = produkSelect.options[produkSelect.selectedIndex];
            const price = parseInt(selectedOption.dataset.price || 0);
            const qty = parseInt(jumlahInput.value || 0);
            const total = price * qty;
            
            hargaSatuan.value = 'Rp ' + price.toLocaleString('id-ID');
            hargaSatuanHidden.value = price;
            totalHarga.textContent = 'Rp ' + total.toLocaleString('id-ID');
            totalHargaHidden.value = total;
        }
        
        produkSelect.addEventListener('change', hitungTotal);
        jumlahInput.addEventListener('input', hitungTotal);
        
        // Validasi form sebelum submit
        document.getElementById('orderForm').addEventListener('submit', function(e) {
            const produk = produkSelect.value;
            const jumlah = jumlahInput.value;
            
            if (!produk) {
                e.preventDefault();
                alert('Silakan pilih produk terlebih dahulu!');
                produkSelect.focus();
                return false;
            }
            
            if (jumlah < 1) {
                e.preventDefault();
                alert('Jumlah minimal 1 kg!');
                jumlahInput.focus();
                return false;
            }
            
            return true;
        });
    </script>
</body>
</html>
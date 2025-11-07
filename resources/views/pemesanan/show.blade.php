<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan | E-Pinggirpapas-Sumenep</title>
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
            align-items-center;
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
        
        .success-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--secondary-color), #008556);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            margin: 0 auto 2rem;
        }
        
        .order-detail-card {
            background: white;
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        
        .status-badge {
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            display: inline-block;
        }
        
        .status-pending {
            background: #FFF3CD;
            color: #856404;
        }
        
        .status-confirmed {
            background: #D1ECF1;
            color: #0C5460;
        }
        
        .status-processing {
            background: #CCE5FF;
            color: #004085;
        }
        
        .status-shipped {
            background: #E2E3E5;
            color: #383D41;
        }
        
        .status-delivered {
            background: #D4EDDA;
            color: #155724;
        }
        
        .status-cancelled {
            background: #F8D7DA;
            color: #721C24;
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
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Kontak</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-4">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    <!-- Success Icon -->
                    <div class="text-center mb-4">
                        <div class="success-icon">
                            <i class="fas fa-check"></i>
                        </div>
                        <h2 class="fw-bold mb-2">Pesanan Berhasil Dibuat!</h2>
                        <p class="text-muted">Terima kasih telah memesan di E-Pinggirpapas-Sumenep</p>
                    </div>

                    <!-- Order Details -->
                    <div class="order-detail-card">
                        <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                            <div>
                                <h5 class="mb-1">Nomor Pesanan</h5>
                                <h3 class="text-primary fw-bold mb-0">{{ $pemesanan->nomor_pesanan }}</h3>
                            </div>
                            <div class="text-end">
                                @php
                                    $statusClass = 'status-' . $pemesanan->status;
                                    $statusText = [
                                        'pending' => 'Menunggu Konfirmasi',
                                        'confirmed' => 'Dikonfirmasi',
                                        'processing' => 'Diproses',
                                        'shipped' => 'Dikirim',
                                        'delivered' => 'Selesai',
                                        'cancelled' => 'Dibatalkan'
                                    ];
                                @endphp
                                <span class="status-badge {{ $statusClass }}">
                                    {{ $statusText[$pemesanan->status] ?? 'Pending' }}
                                </span>
                            </div>
                        </div>

                        <!-- Customer Info -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6 class="fw-bold mb-3"><i class="fas fa-user text-primary me-2"></i>Data Pemesan</h6>
                                <table class="table table-sm table-borderless">
                                    <tr>
                                        <td width="120">Nama</td>
                                        <td>: <strong>{{ $pemesanan->nama_pemesan }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>: {{ $pemesanan->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Telepon</td>
                                        <td>: {{ $pemesanan->telepon }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold mb-3"><i class="fas fa-map-marker-alt text-danger me-2"></i>Alamat Pengiriman</h6>
                                <p class="mb-0">{{ $pemesanan->alamat_pengiriman }}</p>
                            </div>
                        </div>

                        <!-- Order Items -->
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3"><i class="fas fa-box text-success me-2"></i>Detail Produk</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Produk</th>
                                            <th width="100" class="text-center">Jumlah</th>
                                            <th width="150" class="text-end">Harga Satuan</th>
                                            <th width="150" class="text-end">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <strong>{{ $pemesanan->nama_produk ?? 'Produk #' . $pemesanan->produk_id }}</strong>
                                            </td>
                                            <td class="text-center">{{ $pemesanan->jumlah }} kg</td>
                                            <td class="text-end">Rp {{ number_format($pemesanan->harga_satuan ?? 0, 0, ',', '.') }}</td>
                                            <td class="text-end"><strong>Rp {{ number_format($pemesanan->total_harga ?? 0, 0, ',', '.') }}</strong></td>
                                        </tr>
                                    </tbody>
                                    <tfoot class="table-light">
                                        <tr>
                                            <td colspan="3" class="text-end fw-bold">TOTAL PEMBAYARAN:</td>
                                            <td class="text-end">
                                                <h5 class="mb-0 text-success">Rp {{ number_format($pemesanan->total_harga ?? 0, 0, ',', '.') }}</h5>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        @if($pemesanan->catatan)
                        <div class="mb-4">
                            <h6 class="fw-bold mb-2"><i class="fas fa-sticky-note text-warning me-2"></i>Catatan</h6>
                            <p class="text-muted mb-0">{{ $pemesanan->catatan }}</p>
                        </div>
                        @endif

                        <!-- Order Timeline -->
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3"><i class="fas fa-clock text-info me-2"></i>Tanggal Pemesanan</h6>
                            <p class="mb-0">{{ $pemesanan->tanggal_pemesanan ? $pemesanan->tanggal_pemesanan->format('d F Y, H:i') : '-' }} WIB</p>
                        </div>

                        <!-- Action Buttons -->
                        <div class="text-center mt-4 pt-3 border-top">
                            <a href="https://wa.me/6281234567890?text=Halo, saya ingin konfirmasi pesanan {{ $pemesanan->nomor_pesanan }}" 
                               class="btn btn-success btn-lg me-2" target="_blank">
                                <i class="fab fa-whatsapp me-2"></i>Hubungi via WhatsApp
                            </a>
                            <a href="{{ route('home') }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-home me-2"></i>Kembali ke Beranda
                            </a>
                        </div>
                    </div>

                    <!-- Info Alert -->
                    <div class="alert alert-info mt-4">
                        <h6 class="fw-bold mb-2"><i class="fas fa-info-circle me-2"></i>Informasi Penting</h6>
                        <ul class="mb-0 small">
                            <li>Simpan <strong>Nomor Pesanan</strong> untuk tracking pesanan Anda</li>
                            <li>Tim kami akan menghubungi Anda dalam 1x24 jam untuk konfirmasi pembayaran</li>
                            <li>Pembayaran dapat dilakukan via Transfer Bank atau COD (area Sumenep)</li>
                            <li>Pesanan akan diproses setelah pembayaran dikonfirmasi</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
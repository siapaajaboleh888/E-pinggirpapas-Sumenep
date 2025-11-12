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
            background: #f8f9fa;
            padding: 2rem 0;
        }
        
        .order-container {
            max-width: 900px;
            margin: 0 auto;
        }
        
        .order-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            padding: 2rem;
            margin-bottom: 1.5rem;
        }
        
        .order-header {
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .status-badge {
            display: inline-block;
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .status-pending { background: #fff3cd; color: #856404; }
        .status-confirmed { background: #cfe2ff; color: #084298; }
        .status-processing { background: #d1e7dd; color: #0f5132; }
        .status-shipped { background: #e7f3ff; color: #055160; }
        .status-delivered { background: #d1e7dd; color: #0a3622; }
        .status-cancelled { background: #f8d7da; color: #842029; }
        
        .timeline {
            position: relative;
            padding-left: 2rem;
        }
        
        .timeline-item {
            position: relative;
            padding-bottom: 2rem;
        }
        
        .timeline-item:last-child {
            padding-bottom: 0;
        }
        
        .timeline-item::before {
            content: '';
            position: absolute;
            left: -2rem;
            top: 0;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: var(--primary-color);
            border: 3px solid white;
            box-shadow: 0 0 0 2px var(--primary-color);
        }
        
        .timeline-item::after {
            content: '';
            position: absolute;
            left: calc(-2rem + 5px);
            top: 12px;
            width: 2px;
            height: calc(100% - 12px);
            background: #e0e0e0;
        }
        
        .timeline-item:last-child::after {
            display: none;
        }
        
        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 0.75rem 0;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .info-row:last-child {
            border-bottom: none;
        }
        
        .info-label {
            font-weight: 600;
            color: #666;
        }
        
        .info-value {
            text-align: right;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="order-container">
        {{-- Order Header --}}
        <div class="order-card">
            <div class="order-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="fw-bold mb-2">
                            <i class="fas fa-receipt me-2 text-primary"></i>
                            Detail Pesanan
                        </h3>
                        <p class="text-muted mb-0">
                            <i class="fas fa-hashtag me-1"></i>
                            {{ $pemesanan->nomor_pesanan }}
                        </p>
                    </div>
                    <div class="text-end">
                        <span class="status-badge status-{{ strtolower($pemesanan->status ?? 'pending') }}">
                            {{ ucfirst($pemesanan->status ?? 'Pending') }}
                        </span>
                        <p class="text-muted small mb-0 mt-2">
                            <i class="fas fa-calendar me-1"></i>
                            {{ $pemesanan->created_at ? $pemesanan->created_at->format('d M Y, H:i') : '-' }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Customer Information --}}
            <div class="mb-4">
                <h5 class="fw-semibold mb-3">
                    <i class="fas fa-user me-2"></i>Informasi Pemesan
                </h5>
                <div class="info-row">
                    <span class="info-label">Nama:</span>
                    <span class="info-value">{{ $pemesanan->nama_pemesan }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Email:</span>
                    <span class="info-value">{{ $pemesanan->email }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Telepon:</span>
                    <span class="info-value">{{ $pemesanan->telepon ?? '-' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Alamat:</span>
                    <span class="info-value">{{ $pemesanan->alamat }}</span>
                </div>
            </div>

            {{-- Order Details --}}
            <div class="mb-4">
                <h5 class="fw-semibold mb-3">
                    <i class="fas fa-box me-2"></i>Detail Pesanan
                </h5>
                <div class="info-row">
                    <span class="info-label">Produk:</span>
                    <span class="info-value">{{ $pemesanan->produk_nama ?? '-' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Jumlah:</span>
                    <span class="info-value">{{ $pemesanan->jumlah ?? 1 }} {{ $pemesanan->satuan ?? 'pcs' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Catatan:</span>
                    <span class="info-value">{{ $pemesanan->catatan ?? '-' }}</span>
                </div>
            </div>

            {{-- Total --}}
            @if(isset($pemesanan->total_harga))
            <div class="bg-light p-3 rounded">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">Total Pembayaran:</h5>
                    <h4 class="fw-bold mb-0 text-primary">
                        Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}
                    </h4>
                </div>
            </div>
            @endif
        </div>

        {{-- Order Timeline --}}
        <div class="order-card">
            <h5 class="fw-semibold mb-4">
                <i class="fas fa-history me-2"></i>Riwayat Pesanan
            </h5>
            <div class="timeline">
                <div class="timeline-item">
                    <p class="fw-semibold mb-1">Pesanan Dibuat</p>
                    <p class="text-muted small mb-0">
                        {{ $pemesanan->created_at ? $pemesanan->created_at->format('d M Y, H:i') : '-' }}
                    </p>
                </div>

                @if($pemesanan->confirmed_at)
                <div class="timeline-item">
                    <p class="fw-semibold mb-1">Pesanan Dikonfirmasi</p>
                    <p class="text-muted small mb-0">
                        {{ $pemesanan->confirmed_at->format('d M Y, H:i') }}
                    </p>
                </div>
                @endif

                @if($pemesanan->shipped_at)
                <div class="timeline-item">
                    <p class="fw-semibold mb-1">Pesanan Dikirim</p>
                    <p class="text-muted small mb-0">
                        {{ $pemesanan->shipped_at->format('d M Y, H:i') }}
                    </p>
                </div>
                @endif

                @if($pemesanan->delivered_at)
                <div class="timeline-item">
                    <p class="fw-semibold mb-1">Pesanan Diterima</p>
                    <p class="text-muted small mb-0">
                        {{ $pemesanan->delivered_at->format('d M Y, H:i') }}
                    </p>
                </div>
                @endif
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="d-flex gap-3">
            <a href="{{ route('pemesanan.track.form') }}" class="btn btn-outline-primary">
                <i class="fas fa-search me-2"></i>Lacak Pesanan Lain
            </a>
            <a href="{{ route('home') }}" class="btn btn-primary">
                <i class="fas fa-home me-2"></i>Kembali ke Beranda
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

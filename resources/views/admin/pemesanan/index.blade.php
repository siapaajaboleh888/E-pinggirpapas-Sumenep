<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pesanan | Admin E-Pinggirpapas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f8f9fa; }
        .navbar { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .page-header { background: white; border-radius: 15px; padding: 2rem; margin-bottom: 2rem; box-shadow: 0 5px 15px rgba(0,0,0,0.08); }
        .order-card { background: white; border-radius: 15px; padding: 1.5rem; margin-bottom: 1rem; box-shadow: 0 5px 15px rgba(0,0,0,0.08); transition: all 0.3s ease; }
        .order-card:hover { box-shadow: 0 8px 25px rgba(0,0,0,0.12); }
        .action-btn { padding: 0.4rem 1rem; font-size: 0.85rem; border-radius: 8px; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-shield-alt me-2"></i>Admin Panel
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt me-1"></i>Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}"><i class="fas fa-home me-1"></i>Beranda</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i>{{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('admin.produk.index') }}"><i class="fas fa-box me-2"></i>Kelola Produk</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid py-4">
        <div class="container">
            <div class="page-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="fw-bold mb-2"><i class="fas fa-shopping-cart me-2 text-primary"></i>Kelola Pesanan</h2>
                        <p class="text-muted mb-0">Manajemen semua pesanan dari customer</p>
                    </div>
                    <a href="{{ route('admin.pemesanan.export', 'excel') }}" class="btn btn-success">
                        <i class="fas fa-file-excel me-2"></i>Export Excel
                    </a>
                </div>
            </div>

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

            @if($pemesanans && $pemesanans->count() > 0)
                @foreach($pemesanans as $order)
                <div class="order-card">
                    <div class="row align-items-center">
                        <!-- Order Info -->
                        <div class="col-md-2">
                            <h6 class="fw-bold mb-1">
                                <span class="badge bg-secondary">{{ $order->nomor_pesanan }}</span>
                            </h6>
                            <p class="mb-1"><i class="fas fa-user me-1 text-muted"></i>{{ $order->nama_pemesan }}</p>
                            <p class="text-muted small mb-0"><i class="fas fa-calendar me-1"></i>{{ $order->created_at ? $order->created_at->format('d M Y, H:i') : '-' }}</p>
                        </div>

                        <!-- Status Badge -->
                        <div class="col-md-2">
                            <div class="mb-2">
                                @if($order->status == 'pending')
                                    <span class="badge bg-warning text-dark px-2 py-1">⏰ Pending</span>
                                @elseif($order->status == 'confirmed')
                                    <span class="badge bg-info px-2 py-1">✓ Confirmed</span>
                                @elseif($order->status == 'processing')
                                    <span class="badge bg-primary px-2 py-1">🔄 Processing</span>
                                @elseif($order->status == 'shipped')
                                    <span class="badge bg-info px-2 py-1">🚚 Shipped</span>
                                @elseif($order->status == 'delivered')
                                    <span class="badge bg-success px-2 py-1">✅ Delivered</span>
                                @else
                                    <span class="badge bg-danger px-2 py-1">❌ Cancelled</span>
                                @endif
                            </div>
                            <div>
                                @if($order->payment_status == 'paid')
                                    <span class="badge bg-success px-2 py-1">💰 Lunas</span>
                                @elseif($order->payment_status == 'pending')
                                    <span class="badge bg-warning text-dark px-2 py-1">⏳ Cek Bayar</span>
                                @else
                                    <span class="badge bg-danger px-2 py-1">❌ Belum Bayar</span>
                                @endif
                            </div>
                        </div>

                        <!-- Payment Info -->
                        <div class="col-md-2">
                            <small class="text-muted d-block">Pembayaran:</small>
                            @if($order->payment_channel == 'bca')
                                <span class="badge" style="background: #003d99; color: white;">
                                    <i class="fas fa-university me-1"></i>BCA
                                </span>
                            @elseif($order->payment_channel == 'bni')
                                <span class="badge" style="background: #f57c00; color: white;">
                                    <i class="fas fa-university me-1"></i>BNI
                                </span>
                            @elseif($order->payment_channel == 'mandiri')
                                <span class="badge" style="background: #003d79; color: white;">
                                    <i class="fas fa-university me-1"></i>Mandiri
                                </span>
                            @elseif($order->payment_channel == 'bri')
                                <span class="badge" style="background: #0066b2; color: white;">
                                    <i class="fas fa-university me-1"></i>BRI
                                </span>
                            @elseif($order->payment_channel == 'cimb')
                                <span class="badge" style="background: #c8102e; color: white;">
                                    <i class="fas fa-university me-1"></i>CIMB
                                </span>
                            @elseif($order->payment_channel == 'dana')
                                <span class="badge" style="background: #118EEA; color: white;">
                                    <i class="fas fa-wallet me-1"></i>DANA
                                </span>
                            @elseif($order->payment_channel == 'gopay')
                                <span class="badge" style="background: #00AA13; color: white;">
                                    <i class="fas fa-wallet me-1"></i>GoPay
                                </span>
                            @elseif($order->payment_channel == 'ovo')
                                <span class="badge" style="background: #4C28BC; color: white;">
                                    <i class="fas fa-wallet me-1"></i>OVO
                                </span>
                            @elseif($order->payment_channel == 'cod')
                                <span class="badge" style="background: #28a745; color: white;">
                                    <i class="fas fa-money-bill-wave me-1"></i>COD
                                </span>
                            @else
                                <span class="badge bg-secondary">-</span>
                            @endif
                        </div>

                        <!-- Total -->
                        <div class="col-md-1">
                            <h6 class="fw-bold text-primary mb-0">Rp {{ number_format($order->total_harga ?? 0, 0, ',', '.') }}</h6>
                        </div>

                        <!-- Actions -->
                        <div class="col-md-5">
                            <div class="d-flex gap-1 flex-wrap">
                                <!-- Payment Actions (if not paid) -->
                                @if($order->payment_status !== 'paid' && $order->payment_channel !== 'cod')
                                <form action="{{ route('admin.pemesanan.mark.paid', $order->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success action-btn" title="Tandai Sudah Bayar">
                                        <i class="fas fa-money-check-alt"></i> Lunas
                                    </button>
                                </form>
                                @endif

                                <!-- COD Payment (mark paid when delivered) -->
                                @if($order->payment_channel == 'cod' && $order->payment_status !== 'paid' && $order->status == 'delivered')
                                <form action="{{ route('admin.pemesanan.mark.paid', $order->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success action-btn" title="Tandai COD Sudah Dibayar">
                                        <i class="fas fa-money-bill-wave"></i> COD Lunas
                                    </button>
                                </form>
                                @endif

                                <!-- Konfirmasi (if pending) -->
                                @if($order->status == 'pending')
                                <form action="{{ route('admin.pemesanan.confirm', $order->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-info action-btn" title="Konfirmasi Pesanan">
                                        <i class="fas fa-check"></i> Konfirmasi
                                    </button>
                                </form>
                                @endif

                                <!-- Proses (if confirmed) -->
                                @if($order->status == 'confirmed')
                                <form action="{{ route('admin.pemesanan.process', $order->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-primary action-btn" title="Proses Pesanan">
                                        <i class="fas fa-cog"></i> Proses
                                    </button>
                                </form>
                                @endif

                                <!-- Kirim (if processing) -->
                                @if($order->status == 'processing')
                                <form action="{{ route('admin.pemesanan.ship', $order->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-info action-btn" title="Kirim Pesanan">
                                        <i class="fas fa-truck"></i> Kirim
                                    </button>
                                </form>
                                @endif

                                <!-- Selesai (if shipped) -->
                                @if($order->status == 'shipped')
                                <form action="{{ route('admin.pemesanan.deliver', $order->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success action-btn" title="Tandai Selesai">
                                        <i class="fas fa-check-circle"></i> Selesai
                                    </button>
                                </form>
                                @endif

                                <!-- Batalkan (if not cancelled/delivered) -->
                                @if($order->status != 'cancelled' && $order->status != 'delivered')
                                <form action="{{ route('admin.pemesanan.cancel', $order->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-warning action-btn" title="Batalkan Pesanan" onclick="return confirm('Yakin batalkan pesanan ini?')">
                                        <i class="fas fa-ban"></i> Batal
                                    </button>
                                </form>
                                @endif

                                <!-- Edit -->
                                <a href="{{ route('admin.pemesanan.edit', $order->id) }}" class="btn btn-secondary action-btn" title="Edit Pesanan">
                                    <i class="fas fa-edit"></i> Edit
                                </a>

                                <!-- Hapus -->
                                <form action="{{ route('admin.pemesanan.destroy', $order->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger action-btn" title="Hapus Pesanan" onclick="return confirm('Yakin hapus pesanan ini? Tindakan ini tidak dapat dibatalkan!')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Order Details (Collapsible) -->
                    <div class="mt-3 pt-3 border-top">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="small mb-1"><strong>Email:</strong> {{ $order->email }}</p>
                                <p class="small mb-1"><strong>Telepon:</strong> {{ $order->telepon ?? '-' }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="small mb-1"><strong>Alamat:</strong> {{ Str::limit($order->alamat ?? '-', 50) }}</p>
                                <p class="small mb-1"><strong>Catatan:</strong> {{ Str::limit($order->catatan ?? '-', 50) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $pemesanans->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-shopping-cart fa-5x text-muted mb-3"></i>
                    <h4 class="text-muted">Belum ada pesanan</h4>
                    <p class="text-muted">Pesanan dari customer akan muncul di sini</p>
                </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

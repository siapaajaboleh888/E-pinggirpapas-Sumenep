<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | E-Pinggirpapas-Sumenep</title>
    <link rel="icon" href="{{ asset('assets/images/logo.png') }}" type="image/png">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f8f9fa;
        }
        
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .stat-card {
            border-radius: 15px;
            padding: 1.5rem;
            color: white;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
        
        .stat-card .stat-value {
            font-size: 2.5rem;
            font-weight: 700;
            margin-top: 0.5rem;
        }
        
        .stat-card .stat-label {
            font-size: 0.9rem;
            opacity: 0.9;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .bg-gradient-blue {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .bg-gradient-green {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }
        
        .bg-gradient-purple {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }
        
        .bg-gradient-orange {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        }
        
        .welcome-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            margin-bottom: 2rem;
        }
        
        .info-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
        
        .feature-item {
            padding: 0.75rem 0;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .feature-item:last-child {
            border-bottom: none;
        }
        
        .feature-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-right: 1rem;
        }
        
        .quick-action {
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
            border: 2px solid #e0e0e0;
            text-decoration: none;
            display: block;
            color: #333;
        }
        
        .quick-action:hover {
            border-color: #667eea;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.2);
            color: #667eea;
        }
        
        .quick-action i {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
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
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="fas fa-home me-1"></i>Beranda
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i>{{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.pemesanan.index') }}">
                                <i class="fas fa-shopping-cart me-2"></i>Kelola Pesanan
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.users.index') }}">
                                <i class="fas fa-users-cog me-2"></i>Kelola User
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @include('layouts.flash')

    <!-- Main Content -->
    <div class="container-fluid py-4">
        <div class="container">
            <!-- Welcome Card -->
            <div class="welcome-card">
                <h2 class="fw-bold mb-3">
                    <i class="fas fa-hand-wave text-warning me-2"></i>
                    Selamat Datang, {{ Auth::user()->name }}!
                </h2>
                <p class="text-muted mb-2">
                    Anda login sebagai <span class="badge bg-primary">Administrator</span>
                </p>
                <p class="text-muted small mb-0">
                    <i class="fas fa-envelope me-1"></i>{{ Auth::user()->email }}
                </p>
            </div>

            <!-- Stats Cards -->
            <div class="row g-4 mb-4">
                <!-- Total Pemesanan -->
                <div class="col-md-3">
                    <div class="stat-card bg-gradient-blue">
                        <div class="stat-label">
                            <i class="fas fa-shopping-cart me-2"></i>Total Pemesanan
                        </div>
                        <div class="stat-value">
                            {{ $stats['total_pemesanan'] ?? 0 }}
                        </div>
                    </div>
                </div>

                <!-- Pemesanan Pending -->
                <div class="col-md-3">
                    <div class="stat-card bg-gradient-orange">
                        <div class="stat-label">
                            <i class="fas fa-clock me-2"></i>Pending
                        </div>
                        <div class="stat-value">
                            {{ $stats['pemesanan_pending'] ?? 0 }}
                        </div>
                    </div>
                </div>

                <!-- Pemesanan Proses -->
                <div class="col-md-3">
                    <div class="stat-card bg-gradient-purple">
                        <div class="stat-label">
                            <i class="fas fa-spinner me-2"></i>Proses
                        </div>
                        <div class="stat-value">
                            {{ $stats['pemesanan_proses'] ?? 0 }}
                        </div>
                    </div>
                </div>

                <!-- Pemesanan Selesai -->
                <div class="col-md-3">
                    <div class="stat-card bg-gradient-green">
                        <div class="stat-label">
                            <i class="fas fa-check-circle me-2"></i>Selesai
                        </div>
                        <div class="stat-value">
                            {{ $stats['pemesanan_selesai'] ?? 0 }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="row g-4 mb-4">
                <div class="col-12">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-bolt me-2"></i>Quick Actions
                    </h5>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('admin.pemesanan.index') }}" class="quick-action">
                        <i class="fas fa-shopping-cart text-primary"></i>
                        <h6 class="fw-semibold mt-2 mb-0">Kelola Pesanan</h6>
                        <small class="text-muted">Lihat & kelola semua pesanan</small>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('admin.produk.index') }}" class="quick-action">
                        <i class="fas fa-box text-success"></i>
                        <h6 class="fw-semibold mt-2 mb-0">Kelola Produk</h6>
                        <small class="text-muted">Tambah & edit produk garam</small>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('admin.pemesanan.export', 'excel') }}" class="quick-action">
                        <i class="fas fa-file-excel text-warning"></i>
                        <h6 class="fw-semibold mt-2 mb-0">Export Data</h6>
                        <small class="text-muted">Download laporan pesanan</small>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('admin.virtual.index') }}" class="quick-action">
                        <i class="fas fa-vr-cardboard text-danger"></i>
                        <h6 class="fw-semibold mt-2 mb-0">Kelola Virtual Tour</h6>
                        <small class="text-muted">Tambah & atur video virtual tour</small>
                    </a>
                </div>
            </div>

            <!-- Info Card -->
            <div class="info-card">
                <h5 class="fw-bold mb-4">
                    <i class="fas fa-info-circle me-2"></i>Informasi Admin Panel
                </h5>
                
                <div class="feature-item d-flex align-items-center">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div>
                        <h6 class="mb-1 fw-semibold">Akses Penuh</h6>
                        <small class="text-muted">Akses ke semua fitur administrasi sistem</small>
                    </div>
                </div>

                <div class="feature-item d-flex align-items-center">
                    <div class="feature-icon">
                        <i class="fas fa-users-cog"></i>
                    </div>
                    <div>
                        <h6 class="mb-1 fw-semibold">Kelola Semua Data</h6>
                        <small class="text-muted">Kelola user, produk, dan pemesanan dari semua customer</small>
                    </div>
                </div>

                <div class="feature-item d-flex align-items-center">
                    <div class="feature-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div>
                        <h6 class="mb-1 fw-semibold">Protected Routes</h6>
                        <small class="text-muted">Halaman dilindungi dengan role-based middleware</small>
                    </div>
                </div>

                <div class="feature-item d-flex align-items-center">
                    <div class="feature-icon">
                        <i class="fas fa-download"></i>
                    </div>
                    <div>
                        <h6 class="mb-1 fw-semibold">Export Data</h6>
                        <small class="text-muted">Download laporan dalam format Excel, PDF, atau CSV</small>
                    </div>
                </div>

                <div class="alert alert-warning mt-4 mb-0">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Perhatian:</strong> Halaman ini hanya bisa diakses oleh user dengan role 'admin'. 
                    User biasa akan mendapat error 403 Forbidden.
                </div>
            </div>

            <!-- Recent Orders -->
            @if(isset($recentOrders) && $recentOrders->count() > 0)
            <div class="info-card mt-4">
                <h5 class="fw-bold mb-4">
                    <i class="fas fa-history me-2"></i>Pesanan Terbaru
                </h5>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nomor Pesanan</th>
                                <th>Pemesan</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentOrders->take(5) as $order)
                            <tr>
                                <td><span class="badge bg-secondary">{{ $order->nomor_pesanan }}</span></td>
                                <td>{{ $order->nama_pemesan }}</td>
                                <td>
                                    @if($order->status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif($order->status == 'confirmed')
                                        <span class="badge bg-info">Confirmed</span>
                                    @elseif($order->status == 'processing')
                                        <span class="badge bg-primary">Processing</span>
                                    @elseif($order->status == 'shipped')
                                        <span class="badge bg-info">Shipped</span>
                                    @elseif($order->status == 'delivered')
                                        <span class="badge bg-success">Delivered</span>
                                    @else
                                        <span class="badge bg-danger">Cancelled</span>
                                    @endif
                                </td>
                                <td>Rp {{ number_format($order->total_harga ?? 0, 0, ',', '.') }}</td>
                                <td>{{ $order->created_at ? $order->created_at->format('d M Y') : '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Produk | Admin E-Pinggirpapas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f8f9fa; }
        .navbar { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .page-header { background: white; border-radius: 15px; padding: 2rem; margin-bottom: 2rem; box-shadow: 0 5px 15px rgba(0,0,0,0.08); }
        .product-card { background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.08); transition: transform 0.3s ease; }
        .product-card:hover { transform: translateY(-5px); }
        .product-image { width: 100%; height: 200px; object-fit: cover; }
        .no-image { width: 100%; height: 200px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 3rem; }
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
                            <i class="fas fa-user-circle me-1"></i>{{ auth()->user()->name ?? 'Admin' }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('admin.pemesanan.index') }}"><i class="fas fa-shopping-cart me-2"></i>Kelola Pesanan</a></li>
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
                        <h2 class="fw-bold mb-2"><i class="fas fa-box me-2 text-primary"></i>Kelola Produk Garam</h2>
                        <p class="text-muted mb-0">Manajemen produk garam E-Pinggirpapas-Sumenep</p>
                    </div>
                    <a href="{{ route('admin.produk.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Tambah Produk
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

            @if($produks && $produks->count() > 0)
            <div class="row g-4">
                @foreach($produks as $produk)
                <div class="col-md-4">
                    <div class="product-card">
                        <img src="{{ $produk->image_url }}" alt="{{ $produk->nama }}" class="product-image">
                        
                        <div class="p-3">
                            <h5 class="fw-bold mb-2">{{ $produk->nama }}</h5>
                            <p class="text-muted small mb-2">{{ \Illuminate\Support\Str::limit($produk->deskripsi ?? '-', 80) }}</p>
                            <h4 class="text-primary fw-bold mb-3">Rp {{ number_format($produk->harga ?? 0, 0, ',', '.') }}</h4>
                            
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.produk.edit', $produk) }}" class="btn btn-warning btn-sm flex-fill">
                                    <i class="fas fa-edit me-1"></i>Edit
                                </a>
                                <form action="{{ route('admin.produk.destroy', $produk) }}" method="POST" style="flex: 1;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm w-100" onclick="return confirm('Yakin hapus produk ini?')">
                                        <i class="fas fa-trash me-1"></i>Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $produks->links() }}
            </div>
            @else
            <div class="text-center py-5">
                <i class="fas fa-box-open fa-5x text-muted mb-3"></i>
                <h4 class="text-muted">Belum ada produk</h4>
                <p class="text-muted">Mulai tambahkan produk garam untuk dijual</p>
                <a href="{{ route('admin.produk.create') }}" class="btn btn-primary mt-3">
                    <i class="fas fa-plus me-2"></i>Tambah Produk Pertama
                </a>
            </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

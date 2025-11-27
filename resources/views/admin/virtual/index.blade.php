<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Virtual Tour | Admin E-Pinggirpapas-Sumenep</title>
    <link rel="icon" href="{{ asset('assets/images/logo.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f8f9fa; }
        .navbar { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
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
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="fas fa-home me-1"></i>Beranda
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @include('layouts.flash')

    <div class="container-fluid py-4">
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kelola Virtual Tour</h1>
        <a href="{{ route('admin.virtual.create') }}" class="btn btn-primary">
            <i class="fas fa-plus mr-1"></i> Tambah Virtual Tour
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Judul</th>
                            <th>Link</th>
                            <th>Aktif</th>
                            <th>Urutan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($virtualTours as $tour)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $tour->title }}</td>
                                <td>{{ $tour->link }}</td>
                                <td>
                                    @if($tour->is_active)
                                        <span class="badge badge-success">Aktif</span>
                                    @else
                                        <span class="badge badge-secondary">Nonaktif</span>
                                    @endif
                                </td>
                                <td>{{ $tour->order }}</td>
                                <td>
                                    <a href="{{ route('admin.virtual.edit', $tour->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('admin.virtual.destroy', $tour->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus virtual tour ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada data virtual tour.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $virtualTours->links() }}
        </div>
    </div>
</div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

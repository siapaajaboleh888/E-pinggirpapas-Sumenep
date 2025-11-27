<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Virtual Tour | Admin E-Pinggirpapas-Sumenep</title>
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
        <div class="container">
    <h1 class="h3 mb-3 text-gray-800">Edit Virtual Tour</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.virtual.update', $virtualTour->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $virtualTour->title) }}" required>
                    @error('title')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description', $virtualTour->description) }}</textarea>
                    @error('description')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="form-group">
                    <label>Link YouTube / Iframe (opsional)</label>
                    <input type="text" name="link" class="form-control" value="{{ old('link', $virtualTour->link) }}">
                    @error('link')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="form-group">
                    <label>URL Thumbnail (opsional)</label>
                    <input type="text" name="thumbnail" class="form-control" value="{{ old('thumbnail', $virtualTour->thumbnail) }}">
                    @error('thumbnail')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="form-group">
                    <label>Upload File Video Baru (opsional)</label>
                    <input type="file" name="video" class="form-control" accept="video/mp4,video/webm,video/ogg">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengganti video. Saat ini link: {{ $virtualTour->link }}</small>
                    @error('video')<small class="text-danger d-block">{{ $message }}</small>@enderror
                </div>

                <div class="form-group form-check">
                    <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1" {{ old('is_active', $virtualTour->is_active) ? 'checked' : '' }}>
                    <label for="is_active" class="form-check-label">Aktif</label>
                </div>

                <div class="form-group">
                    <label>Urutan Tampil</label>
                    <input type="number" name="order" class="form-control" value="{{ old('order', $virtualTour->order) }}" min="0">
                    @error('order')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('admin.virtual.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

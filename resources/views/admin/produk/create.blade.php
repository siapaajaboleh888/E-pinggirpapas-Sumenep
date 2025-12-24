<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk | Admin E-Pinggirpapas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f8f9fa; }
        .navbar { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .card { border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); border: none; }
        .card-header { border-radius: 16px 16px 0 0; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
        .form-label { font-weight: 600; color: #4c4f69; }
        .btn-soft-primary { background: rgba(102,126,234,0.1); color: #617fec; border: none; }
        .btn-soft-primary:hover { background: rgba(102,126,234,0.2); color: #4f69d4; }
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
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.produk.index') }}"><i class="fas fa-box me-1"></i>Kelola Produk</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}"><i class="fas fa-home me-1"></i>Beranda</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h4 class="mb-0 fw-semibold">Tambah Produk Garam</h4>
                                <small class="text-white-50">Isi detail produk untuk ditampilkan ke pengunjung</small>
                            </div>
                            <a href="{{ route('admin.produk.index') }}" class="btn btn-light btn-sm">
                                <i class="fas fa-arrow-left me-1"></i>Kembali
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Produk <span class="text-danger">*</span></label>
                                <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi Produk</label>
                                <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control @error('deskripsi') is-invalid @enderror" placeholder="Ceritakan keunggulan produk">{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="harga" class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                                    <input type="number" min="0" step="100" name="harga" id="harga" class="form-control @error('harga') is-invalid @enderror" value="{{ old('harga') }}" required>
                                    @error('harga')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="satuan_select" class="form-label">Satuan <span class="text-danger">*</span></label>
                                    <div id="satuan_container">
                                        <select id="satuan_select" class="form-select @error('satuan') is-invalid @enderror" onchange="handleSatuanChange(this.value)">
                                            @php 
                                                $val = old('satuan', 'kg'); 
                                                $presets = ['kg', '500 gram', '250 gram', 'unit'];
                                                $isCustom = !in_array($val, $presets) && !empty($val);
                                            @endphp
                                            <option value="kg" {{ $val === 'kg' ? 'selected' : '' }}>kg</option>
                                            <option value="500 gram" {{ $val === '500 gram' ? 'selected' : '' }}>500 gram</option>
                                            <option value="250 gram" {{ $val === '250 gram' ? 'selected' : '' }}>250 gram</option>
                                            <option value="unit" {{ $val === 'unit' ? 'selected' : '' }}>unit</option>
                                            <option value="custom" {{ $isCustom ? 'selected' : '' }}>— Input Manual —</option>
                                        </select>
                                        <input type="text" name="satuan" id="satuan_custom" 
                                               class="form-control mt-2 {{ $isCustom ? '' : 'd-none' }}" 
                                               placeholder="Contoh: 100 gram" 
                                               value="{{ $val }}" 
                                               {{ $isCustom ? '' : 'disabled' }}>
                                    </div>
                                    <script>
                                        function handleSatuanChange(value) {
                                            const customInput = document.getElementById('satuan_custom');
                                            if (value === 'custom') {
                                                customInput.classList.remove('d-none');
                                                customInput.disabled = false;
                                                customInput.value = '';
                                                customInput.focus();
                                            } else {
                                                customInput.classList.add('d-none');
                                                customInput.disabled = false; // Enable so it can be sent
                                                customInput.value = value;
                                            }
                                        }
                                        
                                        // Initialize on load just in case
                                        document.addEventListener('DOMContentLoaded', function() {
                                            const select = document.getElementById('satuan_select');
                                            if (select.value !== 'custom') {
                                                document.getElementById('satuan_custom').value = select.value;
                                            }
                                        });
                                    </script>
                                    @error('satuan')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="kategori" class="form-label">Kategori</label>
                                    <input type="text" name="kategori" id="kategori" class="form-control @error('kategori') is-invalid @enderror" value="{{ old('kategori') }}" placeholder="contoh: konsumsi, fortifikasi">
                                    @error('kategori')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="stok" class="form-label">Stok <span class="text-danger">*</span></label>
                                    <input type="number" min="0" name="stok" id="stok" class="form-control @error('stok') is-invalid @enderror" value="{{ old('stok', 0) }}" required>
                                    @error('stok')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                                    <option value="tersedia" {{ old('status', 'tersedia') === 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                                    <option value="kosong" {{ old('status') === 'kosong' ? 'selected' : '' }}>Kosong</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="gambar" class="form-label">Foto Produk</label>
                                <input class="form-control @error('gambar') is-invalid @enderror" type="file" id="gambar" name="gambar" accept="image/*">
                                <small class="text-muted d-block mt-1">Format: JPG, PNG, atau WEBP. Maksimal 2MB.</small>
                                @error('gambar')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.produk.index') }}" class="btn btn-soft-primary">
                                    <i class="fas fa-undo me-1"></i>Batal
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i>Simpan Produk
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


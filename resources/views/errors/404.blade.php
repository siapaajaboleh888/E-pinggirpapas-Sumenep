<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Tidak Ditemukan - 404</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body{background:#0b1220;color:#dbe4ff}
    .card{background:#10182b;border:1px solid #1f2b46}
  </style>
</head>
<body>
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-lg-6">
        <div class="card shadow-lg p-4 text-center">
          <h1 class="display-5 fw-bold text-warning">404</h1>
          <p class="lead mb-3">Halaman yang Anda cari tidak ditemukan.</p>
          <p class="text-secondary">Periksa kembali URL atau kembali ke beranda.</p>
          <div class="d-flex justify-content-center gap-2">
            <a href="{{ route('home') }}" class="btn btn-primary">Kembali ke Beranda</a>
            <a href="{{ url()->previous() }}" class="btn btn-outline-light">Kembali</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>

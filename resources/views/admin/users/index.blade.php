<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kelola User | Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
      <a class="navbar-brand fw-bold" href="{{ route('admin.dashboard') }}">Admin Panel</a>
      <div class="d-flex">
        <a href="{{ route('home') }}" class="btn btn-light btn-sm">Beranda</a>
      </div>
    </div>
  </nav>

  @include('layouts.flash')

  <div class="container py-4">
    <div class="d-flex align-items-center justify-content-between mb-3">
      <h3 class="mb-0">Kelola User</h3>
      <form class="d-flex" method="get">
        <input type="text" name="q" value="{{ $search ?? '' }}" class="form-control form-control-sm me-2" placeholder="Cari nama/email...">
        <button class="btn btn-primary btn-sm">Cari</button>
      </form>
    </div>
    <div class="mb-3">
      <a href="{{ route('admin.users.index') }}" class="btn btn-sm {{ ($filter ?? null) !== 'trashed' ? 'btn-secondary' : 'btn-outline-secondary' }}">Semua</a>
      <a href="{{ route('admin.users.index', ['filter' => 'trashed']) }}" class="btn btn-sm {{ ($filter ?? null) === 'trashed' ? 'btn-secondary' : 'btn-outline-secondary' }}">Sampah</a>
    </div>

    <div class="card shadow-sm">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="table-light">
            <tr>
              <th>#</th>
              <th>Nama</th>
              <th>Email</th>
              <th>Role</th>
              <th>Verifikasi</th>
              <th>Dibuat</th>
              <th class="text-end">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($users as $user)
              <tr>
                <td>{{ $loop->iteration + ($users->currentPage()-1)*$users->perPage() }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                  <span class="badge {{ $user->role==='admin' ? 'bg-danger' : 'bg-secondary' }}">{{ ucfirst($user->role ?? 'user') }}</span>
                </td>
                <td>
                  @if($user->email_verified_at)
                    <span class="badge bg-success">Terverifikasi</span>
                  @else
                    <span class="badge bg-warning text-dark">Belum</span>
                  @endif
                </td>
                <td>{{ optional($user->created_at)->format('d M Y') }}</td>
                <td class="text-end">
                  @if(($filter ?? null) === 'trashed')
                    <form action="{{ route('admin.users.restore', $user->id) }}" method="post" class="d-inline">
                      @csrf
                      <button class="btn btn-success btn-sm">Pulihkan</button>
                    </form>
                    <form action="{{ route('admin.users.forceDelete', $user->id) }}" method="post" onsubmit="return confirm('Hapus permanen user ini?');" class="d-inline">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger btn-sm">Hapus Permanen</button>
                    </form>
                  @else
                    @if($user->role !== 'admin' && auth()->id() !== $user->id)
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="post" onsubmit="return confirm('Nonaktifkan (hapus) user ini?');" class="d-inline">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-outline-danger btn-sm">Hapus</button>
                    </form>
                    @endif
                  @endif
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="7" class="text-center text-muted py-4">Belum ada data user.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <div class="card-footer bg-white">
        {{ $users->links() }}
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

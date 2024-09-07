<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
		<div class="container">
			<a class="navbar-brand" href="/">
    <img src="{{ asset('assets/images/logo.png')}}" alt="Logo" style="height: 40px;"> <!-- Contoh path yang sudah disesuaikan -->
    <span>E-Pesisir Tour</span>
    </a>
	@if (session('success'))
		   <div style="background-color: #ff5900; color: #ffffff; border: 1px solid #ff5900; padding: 10px; margin-bottom: 10px;">
			   {{ session('success') }}
		   </div>
	   @endif
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="oi oi-menu"></span> Menu
			</button>
			<div class="collapse navbar-collapse" id="ftco-nav">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item"><a href="/" class="nav-link">Home</a></li>
					<li class="nav-item"><a href="/about" class="nav-link">About</a></li>
					<li class="nav-item"><a href="/kuliner" class="nav-link">Kuliner</a></li>
					<li class="nav-item"><a href="/blog" class="nav-link">Blog</a></li>
					<li class="nav-item"><a href="/contacts" class="nav-link">Contact</a></li>
		<li class="nav-item dropdown">
    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Sekolah Alam
    </a>
    <div class="dropdown-menu dropdown-menu-right shadow-lg rounded-lg p-3" aria-labelledby="navbarDropdown">
        <a class="dropdown-item font-weight-bold text-primary mb-2" href="/sekolah">
            <i class="fas fa-school"></i> Profile Sekolah Alam
        </a>
        <a class="dropdown-item text-dark mb-2" href="/buku">
            <i class="fas fa-book"></i> File Pembelajaran
        </a>
        {{-- <div class="dropdown-divider"></div>
        <a class="dropdown-item text-muted" href="#">
            <i class="fas fa-ellipsis-h"></i> Submenu lainnya
        </a> --}}
    </div>
</li>

					<li class="nav-item active"><a href="/admin" class="nav-link">Login</a></li>
				</ul>
			</div>
		</div>
	</nav>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Produk Garam KUGAR - E-Pinggirpapas</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Arizonia&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.timepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>
    
    <!-- Include Menu -->
    @include('layouts.menu')
    
    <!-- Hero Section -->
    <div class="hero-wrap js-fullheight" style="background-image: url('{{ asset('assets/images/bg_1.jpg') }}');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center" data-scrollax-parent="true">
                <div class="col-md-9 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
                    <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">
                        <span class="mr-2"><a href="/">Home</a></span> <span>Produk Garam</span>
                    </p>
                    <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Produk Garam Kami</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Section -->
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 heading-section text-center ftco-animate">
                    <span class="subheading">Produk Kami</span>
                    <h2 class="mb-4">Garam Berkualitas dari Pinggirpapas</h2>
                    <p>Produk garam hasil karya petambak lokal KUGAR dengan kualitas terbaik, termasuk Garam Fortifikasi Kelor (GFK)</p>
                </div>
            </div>

            <div class="row">
                @forelse($produk as $item)
                <div class="col-md-4 ftco-animate">
                    <div class="project-wrap">
                        <a href="{{ route('produk.show', $item->id) }}" class="img" style="background-image: url('{{ asset('storage/' . $item->gambar) }}');">
                            <span class="price">Rp {{ number_format($item->harga, 0, ',', '.') }}/kg</span>
                        </a>
                        <div class="text p-4">
                            <span class="days">{{ $item->kategori ?? 'Garam' }}</span>
                            <h3><a href="{{ route('produk.show', $item->id) }}">{{ $item->nama }}</a></h3>
                            <p class="location"><span class="fa fa-map-marker"></span> Pinggirpapas, Sumenep</p>
                            <p>{{ Str::limit($item->deskripsi, 100) }}</p>
                            <ul>
                                <li><span class="flaticon-shower"></span> Stok: {{ $item->stok ?? 'Tersedia' }}</li>
                            </ul>
                            <a href="{{ route('produk.show', $item->id) }}" class="btn btn-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-md-12 text-center ftco-animate">
                    <div class="alert alert-info">
                        <h4>Belum Ada Produk</h4>
                        <p>Produk garam akan segera tersedia. Silakan hubungi kami untuk informasi lebih lanjut.</p>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="row mt-5">
                <div class="col text-center">
                    <div class="block-27">
                        {{ $produk->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Include Script -->
    @include('layouts.script')

    <!-- JavaScript Files -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('assets/js/scrollax.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>
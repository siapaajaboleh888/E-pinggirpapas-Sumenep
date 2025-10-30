<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ $produk->nama }} - E-Pinggirpapas Garam</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Arizonia&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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

@include('layouts.menu')

<div class="hero-wrap js-fullheight" style="background-image: url('{{ asset('storage/' . $produk->gambar) }}');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate pb-5 text-center">
                <h1 class="mb-3 bread">{{ $produk->nama }}</h1>
                <p class="breadcrumbs">
                    <span class="mr-2"><a href="/">Home <i class="ion-ios-arrow-forward"></i></a></span>
                    <span class="mr-2"><a href="{{ route('produk.index') }}">Produk <i class="ion-ios-arrow-forward"></i></a></span>
                    <span>{{ $produk->nama }}</span>
                </p>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section ftco-degree-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-md-12 ftco-animate">
                        <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama }}" class="img-fluid rounded mb-4">
                    </div>

                    <div class="col-md-12 produk-single ftco-animate mb-5 mt-4">
                        <h2>{{ $produk->nama }}</h2>
                        
                        <div class="d-flex align-items-center mb-4">
                            <span class="badge badge-success mr-3" style="font-size: 1.2rem;">
                                Rp {{ number_format($produk->harga, 0, ',', '.') }}/kg
                            </span>
                            <span class="badge badge-info">Stok: {{ $produk->stok ?? 'Tersedia' }}</span>
                        </div>

                        <h3 class="mb-3">Deskripsi Produk</h3>
                        <p>{!! nl2br(e($produk->deskripsi)) !!}</p>

                        <div class="tag-widget post-tag-container mb-5 mt-5">
                            <div class="tagcloud">
                                <a href="#" class="tag-cloud-link">Garam</a>
                                <a href="#" class="tag-cloud-link">Pinggirpapas</a>
                                <a href="#" class="tag-cloud-link">KUGAR</a>
                                @if(str_contains(strtolower($produk->nama), 'kelor'))
                                <a href="#" class="tag-cloud-link">Fortifikasi Kelor</a>
                                @endif
                            </div>
                        </div>

                        <div class="text-center mt-5">
                            <a href="{{ route('pemesanan.create') }}?produk_id={{ $produk->id }}" class="btn btn-primary btn-lg px-5 py-3">
                                <i class="fa fa-shopping-cart"></i> Pesan Sekarang
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Produk Lainnya -->
                @if($produkLainnya->count() > 0)
                <div class="pt-5 mt-5">
                    <h3 class="mb-5">Produk Lainnya</h3>
                    <div class="row">
                        @foreach($produkLainnya as $item)
                        <div class="col-md-4 ftco-animate">
                            <div class="project-wrap">
                                <a href="{{ route('produk.show', $item->id) }}" class="img" style="background-image: url('{{ asset('storage/' . $item->gambar) }}');">
                                    <span class="price">Rp {{ number_format($item->harga, 0, ',', '.') }}</span>
                                </a>
                                <div class="text p-4">
                                    <h3><a href="{{ route('produk.show', $item->id) }}">{{ $item->nama }}</a></h3>
                                    <p>{{ Str::limit($item->deskripsi, 80) }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4 sidebar ftco-animate">
                <div class="sidebar-box">
                    <h3>Informasi Produk</h3>
                    <ul class="list-unstyled">
                        <li><strong>Kategori:</strong> {{ $produk->kategori ?? 'Garam' }}</li>
                        <li><strong>Produsen:</strong> KUGAR Pinggirpapas</li>
                        <li><strong>Lokasi:</strong> Desa Pinggirpapas, Sumenep</li>
                        <li><strong>Berat:</strong> Per Kilogram (kg)</li>
                    </ul>
                </div>

                <div class="sidebar-box">
                    <h3>Hubungi Kami</h3>
                    <p>Untuk pemesanan dalam jumlah besar atau pertanyaan lebih lanjut, silakan hubungi kami.</p>
                    <p><a href="{{ route('contacts.index') }}" class="btn btn-primary btn-block">Hubungi Sekarang</a></p>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layouts.script')

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
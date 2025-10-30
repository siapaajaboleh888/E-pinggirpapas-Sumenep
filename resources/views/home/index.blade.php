@extends('layouts.home')
@section('content')

{{-- Hero Section --}}
<div class="hero-wrap js-fullheight" style="background-image: url('{{ asset('assets/images/bg.jpg')}}');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center" data-scrollax-parent="true">
            <div class="col-md-7 ftco-animate">
                <span class="subheading">Selamat Datang di Platform KUGAR</span>
                <h1 class="mb-4">Pemberdayaan Ekonomi Petambak Garam Desa Pinggirpapas</h1>
                <p class="caps">Garam Fortifikasi Kelor untuk Blue Economy dan Ketahanan Pangan</p>
            </div>
            
            {{-- Virtual Tour Modal --}}
            @foreach ($virtual as $vir) 
                <a href="#" class="icon-video d-flex align-items-center justify-content-center mb-4" data-toggle="modal" data-target="#virtualTourModal-{{ $loop->index }}">
                    <span class="fa fa-play"></span>
                </a>

                <div class="modal fade" id="virtualTourModal-{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="virtualTourModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="virtualTourModalLabel">Virtual Tour Tambak Garam</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <iframe src="{{ $vir->link }}" frameborder="0" allowfullscreen style="width: 100%; height: 450px;"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

{{-- ✅ GANTI: reservations.create → pemesanan.create --}}
{{-- Form Pemesanan Produk Garam --}}
@if(View::exists('pemesanan.create'))
    @include('pemesanan.create')
@else
    {{-- Jika view belum dibuat, tampilkan link button --}}
    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <h2 class="mb-4">Pesan Garam Fortifikasi Kelor Sekarang!</h2>
                    <p class="mb-4">Dapatkan garam berkualitas langsung dari petambak lokal</p>
                    <a href="{{ route('pemesanan.create') }}" class="btn btn-primary btn-lg">
                        <i class="fa fa-shopping-cart"></i> Buat Pemesanan
                    </a>
                </div>
            </div>
        </div>
    </section>
@endif

{{-- Welcome Section (jika ada) --}}
@if(View::exists('welcome'))
    @include('welcome')
@endif

{{-- ✅ DISESUAIKAN: Paket Wisata → Paket Produk Garam --}}
<section class="ftco-section" style="background-color: #e9ecef; padding: 4rem 0;">
    <div class="container">
        <div class="row justify-content-center pb-4">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading">Produk Kami</span>
                <h2 class="mb-4">Paket Produk Garam KUGAR</h2>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
            @forelse ($paketWisata as $paket)
            <div class="col mb-4">
                <div class="card custom-card">
                    <img src="{{ Storage::url($paket->gambar) }}" class="card-img-top" alt="{{ $paket->nama_paket }}">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $paket->nama_paket }}</h5>
                        <a href="https://wa.me/{{ '62' . ltrim($paket->wa_link, '0') }}?text={{ urlencode('Halo, saya tertarik dengan produk garam ini') }}" class="btn btn-success">
                            <i class="fa fa-whatsapp"></i> Hubungi via WhatsApp
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p>Belum ada paket produk tersedia</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- ✅ DISESUAIKAN: Kuliner → Produk Garam --}}
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center pb-4">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading">Produk Unggulan</span>
                <h2 class="mb-4">Garam Fortifikasi Kelor dan Produk Lokal</h2>
            </div>
        </div>
        <div class="row">
            @forelse($kuliners as $item)
            <div class="col-md-4 ftco-animate">
                <div class="project-wrap">
                    <a href="{{ route('produk.show', ['id' => $item->id]) }}" class="img" style="background-image: url({{ Storage::url($item->image) }}); position: relative; display: block;">
                        <span class="price">Rp {{ number_format($item->price, 0, ',', '.') }}/{{ $item->unit ?? 'kg' }}</span>
                    </a>
                    <div class="text p-4">
                        <span class="text">{{ $item->published_at }}</span>
                        <h3><a href="{{ route('produk.show', ['id' => $item->id]) }}">{{ $item->title }}</a></h3>
                        <p class="location"><span class="fa fa-map-marker"></span> {{ $item->alamat }}</p>
                        <ul>
                            <li><span class="flaticon-mountains"></span>Publisher {{ $item->user->name }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p>Belum ada produk tersedia</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- Video Section --}}
<section class="ftco-section ftco-about img" style="background-image: url({{ asset('assets/images/bg.jpg')}});">
    <div class="overlay"></div>
    <div class="container py-md-5">
        <div class="row py-md-5">
            <div class="col-md d-flex align-items-center justify-content-center">
                <a href="https://www.youtube.com/watch?v=62kmsDcvNHI" class="icon-video popup-vimeo d-flex align-items-center justify-content-center mb-4">
                    <span class="fa fa-play"></span>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- About Section --}}
<section class="ftco-section ftco-about ftco-no-pt img">
    <div class="container">
        <div class="row d-flex">
            <div class="col-md-12 about-intro">
                <div class="row">
                    <div class="col-md-6 d-flex align-items-stretch">
                        <div class="img d-flex w-100 align-items-center justify-content-center" style="background-image:url({{ asset('assets/images/bgg.jpg')}});">
                        </div>
                    </div>
                    <div class="col-md-6 pl-md-5 py-5">
                        <div class="row justify-content-start pb-3">
                            <div class="col-md-12 heading-section ftco-animate">
                                <span class="subheading">Tentang Kami</span>
                                @forelse ($about as $bot)
                                <h2 class="mb-4">{{ $bot->title }}</h2>
                                <p>{!! strip_tags($bot->text) !!}</p>
                                @empty
                                <h2 class="mb-4">Program Kosabangsa KUGAR</h2>
                                <p>Pemberdayaan Ekonomi Petambak Garam melalui optimalisasi e-Business dan intensifikasi garam fortifikasi kelor untuk penguatan blue economy dan ketahanan pangan kawasan pesisir.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ✅ DISESUAIKAN: Pengurus Wisata → Petambak Mitra --}}
<section class="ftco-section testimony-section bg-bottom" style="background-image: url({{ asset('assets/images/bg.jpg')}});">
    <div class="overlay"></div>
    <div class="container">
        <div class="row justify-content-center pb-4">
            <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
                <span class="subheading">Tim Kami</span>
                <h2 class="mb-4">Petambak Mitra & Pengurus KUGAR</h2>
            </div>
        </div>
        <div class="row ftco-animate">
            <div class="col-md-12">
                <div class="carousel-testimony owl-carousel">
                    @forelse($penguruses as $ite)
                    <div class="item">
                        <div class="testimony-wrap py-4">
                            <div class="text">
                                <div class="d-flex align-items-center">
                                    <div class="user-img" style="background-image: url({{ Storage::url($ite->image) }})"></div>
                                    <div class="pl-3">
                                        <p class="name">{{ $ite->name }}</p>
                                        <span class="position">{{ $ite->jabatan }}</span>
                                        <p class="alamat">{{ $ite->alamat }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="item">
                        <div class="testimony-wrap py-4">
                            <div class="text text-center">
                                <p>Belum ada data pengurus</p>
                            </div>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Blog Section --}}
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center pb-4">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading">Artikel & Berita</span>
                <h2 class="mb-4">Update Terbaru</h2>
            </div>
        </div>
        <div class="row d-flex">
            @forelse ($blogs as $blo)
            <div class="col-md-4 d-flex ftco-animate">
                <div class="blog-entry justify-content-end">
                    <a href="{{ route('blog.show', ['id' => $blo->id]) }}" class="block-20" style="background-image: url('{{ Storage::url($blo->image) }}');">
                    </a>
                    <div class="text">
                        <div class="d-flex align-items-center mb-4 topp">
                            <div class="two">
                                <span class="yr">{{ date('d F Y', strtotime($blo->published_at)) }}</span>
                            </div>
                        </div>
                        <h3 class="heading"><a href="{{ route('blog.show', ['id' => $blo->id]) }}">{{ $blo->title }}</a></h3>
                        <p><a href="{{ route('blog.show', ['id' => $blo->id]) }}" class="btn btn-primary">Baca Selengkapnya</a></p>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p>Belum ada artikel tersedia</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- Gallery Section --}}
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center pb-4">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading">Galeri Foto</span>
                <h2 class="mb-4">Dokumentasi Kegiatan</h2>
            </div>
        </div>
        <div class="row d-flex">
            @forelse ($images as $image)
                <div class="col-md-3 d-flex ftco-animate">
                    <div class="image-entry text-center">
                        <div class="img-hover-zoom">
                            <img
                                src="{{ Storage::url($image->image) }}"
                                alt="Galeri KUGAR"
                                class="img-fluid rounded" 
                                style="width: 100%; height: auto; border-radius: 10px; cursor: pointer;"
                                data-toggle="modal"
                                data-target="#imageModal"
                                data-img="{{ Storage::url($image->image) }}"  
                            />
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>Belum ada foto dalam galeri</p>
                </div>
            @endforelse
        </div>
        
        {{-- Pagination --}}
        @if(isset($images) && $images->hasPages())
        <div class="row mt-5">
            <div class="col text-center">
                <div class="block-27">
                    <ul>
                        @if ($images->onFirstPage())
                            <li class="disabled"><span>&lt;</span></li>
                        @else
                            <li><a href="{{ $images->previousPageUrl() }}">&lt;</a></li>
                        @endif

                        @foreach (range(1, $images->lastPage()) as $page)
                            @if ($page == $images->currentPage())
                                <li class="active"><span>{{ $page }}</span></li>
                            @else
                                <li><a href="{{ $images->url($page) }}">{{ $page }}</a></li>
                            @endif
                        @endforeach

                        @if ($images->hasMorePages())
                            <li><a href="{{ $images->nextPageUrl() }}">&gt;</a></li>
                        @else
                            <li class="disabled"><span>&gt;</span></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>

{{-- CSS untuk hover effect --}}
<style>
    .image-entry {
        position: relative;
        overflow: hidden;
    }
    .img-hover-zoom {
        transition: transform 0.5s;
    }
    .image-entry:hover .img-hover-zoom {
        transform: scale(1.1);
    }
    .custom-card {
        transition: transform 0.3s;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .custom-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 12px rgba(0,0,0,0.2);
    }
</style>

{{-- Start section (jika ada) --}}
@if(View::exists('start'))
    @include('start')
@endif

@endsection
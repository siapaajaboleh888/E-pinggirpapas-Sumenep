@extends('layouts.home')
@section('content')
   <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('assets/images/bg.jpg')}}');">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
      <div class="col-md-9 ftco-animate pb-5 text-center">
       <p class="breadcrumbs"><span class="mr-2"><a href="home">Home <i class="fa fa-chevron-right"></i></a></span> <span>Documents <i class="fa fa-chevron-right"></i></span></p>
       <h1 class="mb-0 bread">Our Documents</h1>
     </div>
   </div>
 </div>
</section>

<!-- Halaman Dokumen -->
<section class="ftco-section">
    <div class="container">
        <div class="row">
            @foreach($documents as $document)
            <div class="col-md-3 col-sm-6 mb-4">
                <!-- Menampilkan gambar yang telah diupload -->
                <img src="{{ Storage::url($document->image_path) }}" class="img-fluid rounded" alt="Gambar Dokumen">
            </div>
            <div class="col-md-8">
                <!-- Menampilkan judul dan deskripsi dokumen -->
                <h2>{{ $document->title }}</h2>
                <p>{{ Str::limit( $document->description,400) }}</p>
                <!-- Tombol untuk membaca PDF -->
                <a href="{{ asset('storage/' . $document->pdf_path) }}" class="btn btn-primary mb-3" target="_blank">Baca Sekarang</a>
            </div>
            @endforeach
        </div>
    </div>
     <div class="row mt-5">
            <div class="col text-center">
                <div class="block-27">
                    <ul>
                        <!-- Tampilkan tombol 'Previous' -->
                        @if ($documents->onFirstPage())
                            <li class="disabled"><span>&lt;</span></li>
                        @else
                            <li><a href="{{ $documents->previousPageUrl() }}">&lt;</a></li>
                        @endif

                        <!-- Tampilkan halaman-halaman -->
                        @foreach(range(1, $documents->lastPage()) as $page)
                            @if ($page == $documents->currentPage())
                                <li class="active"><span>{{ $page }}</span></li>
                            @else
                                <li><a href="{{ $documents->url($page) }}">{{ $page }}</a></li>
                            @endif
                        @endforeach

                        <!-- Tampilkan tombol 'Next' -->
                        @if ($documents->hasMorePages())
                            <li><a href="{{ $documents->nextPageUrl() }}">&gt;</a></li>
                        @else
                            <li class="disabled"><span>&gt;</span></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
</section>
@endsection

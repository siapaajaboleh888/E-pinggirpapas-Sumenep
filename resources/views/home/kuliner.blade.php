@extends('layouts.home')
 @section('content')
   <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('assets/images/bg_1.jpg')}}');">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
      <div class="col-md-9 ftco-animate pb-5 text-center">
       <p class="breadcrumbs"><span class="mr-2"><a href="/">Home <i class="fa fa-chevron-right"></i></a></span> <span>Kuliner<i class="fa fa-chevron-right"></i></span></p>
       <h1 class="mb-0 bread">Kuliner Desa</h1>
     </div>
   </div>
 </div>
</section>

	<section class="ftco-section">
			<div class="container">
				<div class="row justify-content-center pb-4">
					<div class="col-md-12 heading-section text-center ftco-animate">
						<span class="subheading">Kuliner Wisata</span>
						<h2 class="mb-4">Kuliner UMKM Desa</h2>
					</div>
				</div>
				<div class="row">
					  @foreach($kuliner as $item)
					<div class="col-md-4 ftco-animate">
						<div class="project-wrap">
							<a href="https://wa.me/{{ $item->nomor_hp }}?text={{ urlencode('Halo, saya tertarik dengan kuliner ini') }}" target="_blank" class="img" style="background-image: url({{ Storage::url($item->image) }}); position: relative; display: block;">
								<span class="price">Rp.{{ number_format($item->price, 0, ',', '.') }}/person</span>
							</a>
							<div class="text p-4">
								<span class="text">{{ $item->published_at}}</span>
								<h3><a href="#">{{ $item->title }}</a></h3>
								<p class="location"><span class="fa fa-map-marker"></span> {{ $item->alamat }}</p>
								<ul>
									<li><span class="flaticon-mountains"></span>Publisher {{ $item->user->name }}</li>
								</ul>
							</div>
						</div>
					</div>
					@endforeach
			</div>
     <div class="row mt-5">
            <div class="col text-center">
                <div class="block-27">
                    <ul>
                        <!-- Tampilkan tombol 'Previous' -->
                        @if ($kuliner->onFirstPage())
                            <li class="disabled"><span>&lt;</span></li>
                        @else
                            <li><a href="{{ $kuliner->previousPageUrl() }}">&lt;</a></li>
                        @endif

                        <!-- Tampilkan halaman-halaman -->
                        @foreach(range(1, $kuliner->lastPage()) as $page)
                            @if ($page == $kuliner->currentPage())
                                <li class="active"><span>{{ $page }}</span></li>
                            @else
                                <li><a href="{{ $kuliner->url($page) }}">{{ $page }}</a></li>
                            @endif
                        @endforeach

                        <!-- Tampilkan tombol 'Next' -->
                        @if ($kuliner->hasMorePages())
                            <li><a href="{{ $kuliner->nextPageUrl() }}">&gt;</a></li>
                        @else
                            <li class="disabled"><span>&gt;</span></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
	</section>
</div>
</div>
</section>
 @endsection
@extends('layouts.home')
 @section('content')
<div class="hero-wrap js-fullheight" style="background-image: url('{{ asset('assets/images/bg_5.jpg')}}');">
		<div class="overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text js-fullheight align-items-center" data-scrollax-parent="true">
				<div class="col-md-7 ftco-animate">
					<span class="subheading">Welcome to Wisata Lembung</span>
					<h1 class="mb-4">Discover Your Favorite Place with Us</h1>
					<p class="caps">Travel to the any corner of the world, without going around in circles</p>
				</div>
				@foreach ($virtual as $vir) 
				<a href="{{ $vir->link }}" class="icon-video popup-vimeo d-flex align-items-center justify-content-center mb-4">
					<span class="fa fa-play"></span>
				</a>
			@endforeach
			</div>
		</div>
	</div>

	@include('reservations.create')
				
	@include('welcome')
						

<section class="ftco-section">
			<div class="container">
				<div class="row justify-content-center pb-4">
					<div class="col-md-12 heading-section text-center ftco-animate">
						<span class="subheading">Kuliner Wisata</span>
						<h2 class="mb-4">Kuliner UMKM Desa</h2>
					</div>
				</div>
				<div class="row">
					  @foreach($kuliners as $item)
					<div class="col-md-4 ftco-animate">
						<div class="project-wrap">
							<a href="https://wa.me/{{ $item->nomor_hp }}?text={{ urlencode('Halo, saya tertarik dengan kuliner ini') }}" target="_blank" class="img" style="background-image: url({{ Storage::url($item->image) }}); position: relative; display: block;">
								<span class="price">Rp.{{ number_format($item->price, 0, ',', '.') }}/person</span>
							</a>
							<div class="text p-4">
								<span class="text">{{ $item->published_at}}</span>
								<h3><a href="{{ route('kuliner.show', ['id' => $item->id]) }}">{{ $item->title }}</a></h3>
								<p class="location"><span class="fa fa-map-marker"></span> {{ $item->alamat }}</p>
								<ul>
									<li><span class="flaticon-mountains"></span>Publisher {{ $item->user->name }}</li>
								</ul>
							</div>
						</div>
					</div>
					@endforeach
			</div>
	</section>
		
		<section class="ftco-section ftco-about img"style="background-image: url({{ asset('assets/images/bg_4.jpg')}});">
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

		<section class="ftco-section ftco-about ftco-no-pt img">
			<div class="container">
				<div class="row d-flex">
					<div class="col-md-12 about-intro">
						<div class="row">
							<div class="col-md-6 d-flex align-items-stretch">
								<div class="img d-flex w-100 align-items-center justify-content-center" style="background-image:url({{ asset('assets/images/about-1.jpg')}});">
								</div>
							</div>
							<div class="col-md-6 pl-md-5 py-5">
								<div class="row justify-content-start pb-3">
									<div class="col-md-12 heading-section ftco-animate">
										<span class="subheading">About Us</span>
										@foreach ($about as $bot)
										<h2 class="mb-4">{{ $bot->title }}</h2>
										<p> {!! strip_tags($bot->text) !!}</p>
										   @endforeach
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="ftco-section testimony-section bg-bottom" style="background-image: url({{ asset('assets/images/bg_1.jpg')}});">
			<div class="overlay"></div>
			<div class="container">
				<div class="row justify-content-center pb-4">
					<div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
						<span class="subheading">Pengurus</span>
						<h2 class="mb-4">Wisata Pohon Mangrove</h2>
					</div>
				</div>
				<div class="row ftco-animate">
					<div class="col-md-12">
						<div class="carousel-testimony owl-carousel">
							@foreach($penguruses as $ite)
							<div class="item">
								<div class="testimony-wrap py-4">
									<div class="text">
										{{-- <p class="mb-4">Pengurus wisata mangrove lembung pamekasan alamat pengurus {{ $ite->alamat }}</p> --}}
										<div class="d-flex align-items-center">
											<div class="user-img" style="background-image: url({{ Storage::url($ite->image) }})"></div>
											<div class="pl-3">
												<p class="name">{{ $ite->name }}</p>
												<span class="position">Sebagai {{ $ite->jabatan }} </span>
												<p class="alamat">{{ $ite->alamat }}</p>
											</div>
										</div>
									</div>
								</div>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</section>


		<section class="ftco-section">
			<div class="container">
				<div class="row justify-content-center pb-4">
					<div class="col-md-12 heading-section text-center ftco-animate">
						<span class="subheading">Our Blog</span>
						<h2 class="mb-4">Recent Post</h2>
					</div>
				</div>
				<div class="row d-flex">
					@foreach ($blogs as $blo)
					<div class="col-md-4 d-flex ftco-animate">
						<div class="blog-entry justify-content-end">
							<a href="{{ route('blogs.show', ['id' => $blo->id]) }}" class="block-20" style="background-image: url('{{ Storage::url($blo->image) }}');">
							</a>
							<div class="text">
								<div class="d-flex align-items-center mb-4 topp">
									<div class="two">
              <span class="yr">{{ date('d F Y', strtotime($blo->published_at)) }}</span>
            </div>
								</div>
								<h3 class="heading"><a href="{{ route('blogs.show', ['id' => $blo->id]) }}">{{ $blo->title }}</a></h3>
								<!-- <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p> -->
								<p><a href="{{ route('blogs.show', ['id' => $blo->id]) }}" class="btn btn-primary">Read more</a></p>
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</section>
		
		@include('start')
    @endsection
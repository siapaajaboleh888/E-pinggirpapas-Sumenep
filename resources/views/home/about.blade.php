@extends('layouts.home')
 @section('content')
   <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('assets/images/bg.jpg')}}');">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
      <div class="col-md-9 ftco-animate pb-5 text-center">
       <p class="breadcrumbs"><span class="mr-2"><a href="home">Home <i class="fa fa-chevron-right"></i></a></span> <span>About us <i class="fa fa-chevron-right"></i></span></p>
       <h1 class="mb-0 bread">About Us</h1>
     </div>
   </div>
 </div>
</section>

		@include('welcome')


<section class="ftco-section ftco-about img"style="background-image: url({{ asset('assets/images/lm.jpg')}});">
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
								<div class="img d-flex w-100 align-items-center justify-content-center" style="background-image:url({{ asset('assets/images/bgg.jpg')}});">
								</div>
							</div>
							<div class="col-md-6 pl-md-5 py-5">
								<div class="row justify-content-start pb-3">
									<div class="col-md-12 heading-section ftco-animate">
										@foreach($about as $item)
										<span class="subheading">About Us</span>
										<h2 class="mb-4">{{ $item->title }}</h2>
										<p> {!! strip_tags($item->text) !!}</p>
										 @endforeach
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="ftco-section testimony-section bg-bottom" style="background-image: url({{ asset('assets/images/lm.jpg')}});">
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

		
  @endsection
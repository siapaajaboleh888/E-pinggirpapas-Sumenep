 @extends('layouts.home')
 @section('content')
 <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ Storage::url($kuli->image) }}');">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
      <div class="col-md-9 ftco-animate pb-5 text-center">
       <p class="breadcrumbs"><span class="mr-2"><a href="/">Home <i class="fa fa-chevron-right"></i></a></span> <span class="mr-2"><a href="/kuliner">Kuliner <i class="fa fa-chevron-right"></i></a></span> <span>Kuliner Details <i class="fa fa-chevron-right"></i></span></p>
       <h1 class="mb-0 bread">Kuliner Details</h1>
     </div>
   </div>
 </div>
</section>

<section class="ftco-section ftco-no-pt ftco-no-pb">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 ftco-animate py-md-5 mt-md-5">
        <h2 class="mb-3">{{ $kuli->title }} Rp.{{ number_format($kuli->price, 0, ',', '.') }}</h2>
        <p>{!! strip_tags($kuli->text) !!} </p>   
      </div> <!-- .col-md-8 -->
      <div class="col-lg-4 sidebar ftco-animate bg-light py-md-5">
        <div class="sidebar-box ftco-animate">
             <div class="categories">
        <h3>Contact Person</h3>
        <ul>
          <div class="text-center mt-3">
                <a href="https://wa.me/{{ $kuli->nomor_hp }}?text={{ urlencode('Halo, saya tertarik dengan kuliner ini') }}" class="btn btn-primary float-left">
                    <i class="fa fa-whatsapp"></i> WhatsApp
                </a>
            </div>
        </ul>
    </div>

        </div>

        <div class="sidebar-box ftco-animate">
          <h3>Recent Kuliner</h3>
          @foreach ($show as $sho)
          <div class="block-21 mb-4 d-flex">
            <a class="blog-img mr-4" style="background-image: url({{ Storage::url($sho->image) }});"></a>
            <div class="text">
              <h3 class="heading"><a href="{{ route('kuliner.show', ['id' => $sho->id]) }}">{{ $sho->title }}</a></h3>
              <div class="meta">
                <div><a href="#"><span class="fa fa-calendar"></span> {{ date('d F Y', strtotime($sho->published_at)) }}</a></div>
                <div><a href="#"><span class="fa fa-user"></span> {{ $sho->user->name }}</a></div>
              </div>
            </div>
        </div>
        @endforeach
        </div>
      </div>
    </div>
  </div>
</section> <!-- .section -->	

 @include('start')
 @endsection
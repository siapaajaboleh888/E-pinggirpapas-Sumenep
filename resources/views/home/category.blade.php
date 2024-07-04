 @extends('layouts.home')
 @section('content')
 
 <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('assets/images/bg_1.jpg')}}');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate pb-5 text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="fa fa-chevron-right"></i></a></span> <span>Blog <i class="fa fa-chevron-right"></i></span></p>
                <h1 class="mb-0 bread">Category</h1>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section">
<div class="container">
  <div class="row d-flex">
    @foreach ($blogs as $blog)
    <div class="col-md-4 d-flex ftco-animate">
      <div class="blog-entry justify-content-end">
        <a href="blog-single.html" class="block-20" style="background-image: url('{{ Storage::url($blog->image) }}');">
        </a>
        <div class="text">
          <div class="d-flex align-items-center mb-4 topp">
            <div class="two">
              <span class="yr">{{ date('d F Y', strtotime($blog->published_at)) }}</span>
            </div>
          </div>
          <h3 class="heading"><a href="#">{{ $blog->title }}</a></h3>
          <p>{{ $blog->thumbnail }}</p>
          <p><a href="{{ route('blogs.show', ['id' => $blog->id]) }}" class="btn btn-primary">Read more</a></p>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
<div class="text-center mt-3">
    <a href="{{ route('home') }}" class="btn btn-primary">
        Ke Halaman Utama
    </a>
</div>

</div>
 {{-- <div class="row mt-5">
            <div class="col text-center">
                <div class="block-27">
                    <ul>
                        <!-- Tampilkan tombol 'Previous' -->
                        @if ( $posts->onFirstPage())
                            <li class="disabled"><span>&lt;</span></li>
                        @else
                            <li><a href="{{  $posts->previousPageUrl() }}">&lt;</a></li>
                        @endif

                        <!-- Tampilkan halaman-halaman -->
                        @foreach(range(1,  $posts->lastPage()) as $page)
                            @if ($page ==  $posts->currentPage())
                                <li class="active"><span>{{ $page }}</span></li>
                            @else
                                <li><a href="{{  $posts->url($page) }}">{{ $page }}</a></li>
                            @endif
                        @endforeach

                        <!-- Tampilkan tombol 'Next' -->
                        @if ( $posts->hasMorePages())
                            <li><a href="{{  $posts->nextPageUrl() }}">&gt;</a></li>
                        @else
                            <li class="disabled"><span>&gt;</span></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
</div> --}}
</section>	
  @endsection
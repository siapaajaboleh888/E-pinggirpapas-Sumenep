 @extends('layouts.home')
 @section('content')
 <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ Storage::url($posts->image) }}');">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
      <div class="col-md-9 ftco-animate pb-5 text-center">
       <p class="breadcrumbs"><span class="mr-2"><a href="/">Home <i class="fa fa-chevron-right"></i></a></span> <span class="mr-2"><a href="/blog">Blog <i class="fa fa-chevron-right"></i></a></span> <span>Blog Single <i class="fa fa-chevron-right"></i></span></p>
       <h1 class="mb-0 bread">Blog Details</h1>
     </div>
   </div>
 </div>
</section>

<section class="ftco-section ftco-no-pt ftco-no-pb">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 ftco-animate py-md-5 mt-md-5">
        <h2 class="mb-3">{{ $posts->title }}</h2> 
        <p>{!! ($posts->body) !!}</p>
      </div> <!-- .col-md-8 -->
      <div class="col-lg-4 sidebar ftco-animate bg-light py-md-5">
        <div class="sidebar-box ftco-animate">
             <div class="categories">
        <h3>Categories</h3>
        <ul>
             @foreach ($categories as $category)
                <li><a href="{{ route('category.blogs', $category->id) }}">{{ $category->title }}</a></li>
                <!-- Ganti 'blogs_count' dengan properti yang sesuai yang menunjukkan jumlah blog di kategori tersebut -->
            @endforeach
        </ul>
    </div>

        </div>

        <div class="sidebar-box ftco-animate">
          <h3>Recent Blog</h3>
          @foreach ($blogs as $blo)
          <div class="block-21 mb-4 d-flex">
            <a class="blog-img mr-4" style="background-image: url({{ Storage::url($blo->image) }});"></a>
            <div class="text">
              <h3 class="heading"><a href="{{ route('blogs.show', ['id' => $blo->id]) }}">{{ $blo->title }}</a></h3>
              <div class="meta">
                <div><a href="#"><span class="fa fa-calendar"></span> {{ date('d F Y', strtotime($blo->published_at)) }}</a></div>
                <div><a href="#"><span class="fa fa-user"></span> {{ $blo->user->name }}</a></div>
              </div>
            </div>
        </div>
        @endforeach
        </div>
      </div>
    </div>
  </div>
</section> <!-- .section -->	

 {{-- @include('start') --}}
 @endsection
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
@if(isset($sections['Sejarah Sekolah Alam']))
<section class="ftco-section">
        <div class="container">
            {{-- @foreach($sections as $section) --}}
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="{{ Storage::url($sections['Sejarah Sekolah Alam']->image) }}" class="img-fluid" alt="Sejarah Sekolah">
                </div>
                <div class="col-md-6">
                    <h2>{{ $sections['Sejarah Sekolah Alam']->section }}</h2>
                    <p>{!! $sections['Sejarah Sekolah Alam']->content !!}</p>
                </div>
            </div>
        </div>
    </section>
     @endif

    <!-- Visi dan Misi -->
    @if(isset($sections['Visi & Misi']))
        <section class="ftco-section bg-light">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 order-md-2">
                        <img src="{{ Storage::url($sections['Visi & Misi']->image) }}" class="img-fluid" alt="Visi dan Misi">
                    </div>
                    <div class="col-md-6 order-md-1">
                        {{-- <h3>{{ $sections['Visi & Misi']->section }}</h3> --}}
                        <p>{!! $sections['Visi & Misi']->content !!}</p>
                        {{-- <h3>Misi</h3>
                        <ul>
                            <li>Menyelenggarakan pendidikan yang memadukan kurikulum nasional dengan pendekatan alam.</li>
                            <li>Mengembangkan program-program yang mendukung kesadaran lingkungan.</li>
                            <li>Mengajarkan nilai-nilai kehidupan melalui interaksi langsung dengan alam.</li>
                        </ul> --}}
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Kurikulum -->
    @if(isset($sections['Kurikulum Pendidikan']))
    <section class="ftco-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="{{ Storage::url($sections['Kurikulum Pendidikan']->image) }}" class="img-fluid" alt="Kurikulum Sekolah">
                </div>
                <div class="col-md-6">
                    <h2>{{ $sections['Kurikulum Pendidikan']->section }}</h2>
                    <p>{!! $sections['Kurikulum Pendidikan']->content !!}</p>
                    {{-- <p>Program kurikulum kami meliputi:</p>
                    <ul>
                        <li>Pendidikan Lingkungan Hidup</li>
                        <li>Praktik Berkebun dan Pertanian</li>
                        <li>Pendidikan Karakter melalui Kegiatan Alam</li>
                        <li>Kelas Kreativitas dan Kesenian</li>
                    </ul> --}}
                </div>
            </div>
             {{-- @endforeach --}}
        </div>
    </section>
      @endif
  @endsection
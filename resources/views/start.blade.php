<section class="ftco-intro ftco-section ftco-no-pt">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <div class="img" style="background-image: url({{ asset('assets/images/bg_2.jpg') }});">
                    <div class="overlay"></div>
                    <h2>Wisata Pohon Mangrove</h2>
                    <p>Start your virtual tour</p>
                    <p class="mb-0">
                        @if(isset($virtual) && $virtual->count() > 0)
                            <a href="{{ $virtual->first()->link }}" target="_blank" class="btn btn-primary px-4 py-3">Start Now</a>
                        @else
                            <a href="#" class="btn btn-primary px-4 py-3">Start Now</a>
                        @endif
                    </p>
                </div>					
            </div>
        </div>
    </div>
</section>
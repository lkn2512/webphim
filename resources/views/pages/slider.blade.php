<section id="tranding" class="container">
    <div class="row slider-container">
        <div class="swiper tranding-slider">
            <div class="swiper-wrapper">
                @foreach ($slider as $value)
                    <div class="swiper-slide tranding-slide">
                        <div class="tranding-slide-img">
                            <a href="{{ URL::to('phim/' . $value->movie->slug) }}" title="{{ $value->title }}">
                                <img src="{{ asset('uploads/slider/' . $value->image) }}"
                                    alt="{{ $value->movie->title }}">
                            </a>
                        </div>
                        <div class="tranding-slide-content">
                            <div class="tranding-slide-content-bottom">
                                <h2 class="slider-name">
                                    {{ $value->movie->title }}
                                </h2>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

@push('Slider-JS')
    <script>
        var TrandingSlider = new Swiper('.tranding-slider', {
            effect: 'coverflow',
            grabCursor: true,
            centeredSlides: true,
            loop: true,
            slidesPerView: 'auto',
            coverflowEffect: {
                rotate: 0,
                stretch: 0,
                depth: 100,
                modifier: 2.5,
            },
        });
    </script>
@endpush

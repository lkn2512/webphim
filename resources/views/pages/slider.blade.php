<section id="tranding" class="container">
    <div class="row slider-container">
        <div class="swiper tranding-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide tranding-slide">
                    <div class="tranding-slide-img">
                        <img src="{{ asset('FrontEnd/Image/s1.jpg') }}" alt="Image">
                    </div>
                    <div class="tranding-slide-content">
                        <div class="tranding-slide-content-bottom">
                            <h2 class="slider-name">
                                Thôn phệ tinh không
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide tranding-slide">
                    <div class="tranding-slide-img">
                        <img src="{{ asset('FrontEnd/Image/s2.jpg') }}" alt="Image">
                    </div>
                    <div class="tranding-slide-content">
                        <div class="tranding-slide-content-bottom">
                            <h2 class="slider-name">
                                Meat Ball
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide tranding-slide">
                    <div class="tranding-slide-img">
                        <img src="{{ asset('FrontEnd/Image/s3.jpg') }}" alt="Image">
                    </div>
                    <div class="tranding-slide-content">
                        <div class="tranding-slide-content-bottom">
                            <h2 class="slider-name">
                                Burger
                            </h2>

                        </div>
                    </div>
                </div>
                <div class="swiper-slide tranding-slide">
                    <div class="tranding-slide-img">
                        <img src="{{ asset('FrontEnd/Image/s4.jpg') }}" alt="Image">
                    </div>
                    <div class="tranding-slide-content">

                        <div class="tranding-slide-content-bottom">
                            <h2 class="slider-name">
                                Frish Curry
                            </h2>

                        </div>
                    </div>
                </div>
                <div class="swiper-slide tranding-slide">
                    <div class="tranding-slide-img">
                        <img src="{{ asset('FrontEnd/Image/s5.jpg') }}" alt="Image">
                    </div>
                    <div class="tranding-slide-content">
                        <div class="tranding-slide-content-bottom">
                            <h2 class="slider-name">
                                Pane Cake
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="tranding-slider-control">
                <div class="swiper-button-prev slider-arrow">
                    <ion-icon name="arrow-back-outline"></ion-icon>
                </div>
                <div class="swiper-button-next slider-arrow">
                    <ion-icon name="arrow-forward-outline"></ion-icon>
                </div>
            </div> --}}
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

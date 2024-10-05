<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $meta_title }}</title>
    <link rel="shortcut icon" href="{{ asset('Frontend/image/logo.png') }}">

    <meta name="revisit-after" content="1 days">
    <meta name="robots" content="index, follow">
    <meta name="description" content="{{ $meta_description }}">
    <meta name="author" content="Lê Kim Ngọc">
    <!-- Open Graph Meta Tags for social media sharing -->
    <meta property="og:title" content="{{ $meta_title }}">
    <meta property="og:description" content="{{ $meta_description }}">
    <meta property="og:image" content="{{ $meta_image }}">
    <meta property="og:url" content="{{ $meta_url }}">
    <meta property="og:type" content="Website">
    <!-- Twitter Card -->
    <meta name="twitter:card" content="card">
    <meta name="twitter:title" content="{{ $meta_title }}">
    <meta name="twitter:description" content="{{ $meta_description }}">
    <meta name="twitter:image" content="{{ $meta_image }}">

    <link rel="canonical" href="{{ Request::url() }}">

    {{-- bootstrap-5 CSS --}}
    <link rel="stylesheet" href="{{ asset('FrontEnd/bootstrap-5.3.3-dist/css/bootstrap.min.css') }}">
    {{-- Font-awesome CSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    {{-- Main CSS --}}
    <link rel="stylesheet" href="{{ asset('FrontEnd/assets/css/main.css') }}">
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <!-- Slider carosel CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('FrontEnd/assets/css/slider.css') }}">
    {{-- slick CSS --}}
    <link rel="stylesheet" href="{{ asset('FrontEnd/assets/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('FrontEnd/assets/slick/slick-theme.css') }}">
    {{-- tabs CSS --}}
    <link rel="stylesheet" href="{{ asset('FrontEnd/assets/css/tabs.css') }}">

<body>
    <div class="wrapper">
        @include('pages.header.menu')
        <main class="container main-container">
            @yield('content')
        </main>
        @include('pages.footer.footer')
    </div>
    <!--header JS-->
    <script src="{{ asset('FrontEnd/assets/js/header.js') }}"></script>
    {{-- bootstrap-5 JS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('FrontEnd/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Owl Carousel JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <!-- Slider carosel JS -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

    <script src="{{ asset('FrontEnd/assets/slick/slick.js') }}"></script>

    <!-- Owl Carousel control -->
    <script>
        $(document).ready(function() {
            var owl = $(".owl-carousel");

            owl.owlCarousel({
                loop: false,
                margin: 22,
                autoplay: true, // Kích hoạt chế độ tự động chạy
                autoplayTimeout: 3000, // Thời gian giữa các lần chuyển đổi (3 giây)
                autoplayHoverPause: true, // Tạm dừng khi di chuột lên
                responsive: {
                    0: {
                        items: 2
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 4
                    }
                }
            });

            // Xử lý sự kiện khi nhấn nút mũi tên
            $(".prev-arrow").click(function() {
                owl.trigger('prev.owl.carousel');
            });

            $(".next-arrow").click(function() {
                owl.trigger('next.owl.carousel');
            });
        });
    </script>
    {{-- slick control --}}
    <script>
        $(document).ready(function() {
            $('.multiple-items').slick({
                infinite: true,
                arrows: false,
                autoplay: true,
                autoplaySpeed: 3000,
                slidesToShow: 2,
                slidesToScroll: 2,
                responsive: [{
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        });
    </script>

    @stack('Slider-JS')
    @stack('search-JS')
    @stack('comment-JS')

</body>

</html>

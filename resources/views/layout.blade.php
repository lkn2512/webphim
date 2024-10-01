<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>

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
    @include('pages.header.menu')
    <main class="container main-container">
        @yield('content')
    </main>
    @include('pages.footer.footer')
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
    {{-- Select 2 --}}

    {{-- Select 2 --}}
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

    @stack('Slider-JS')

    {{-- slick control --}}
    <script>
        $(document).ready(function() {
            $('.multiple-items').slick({
                infinite: true,
                arrows: false,
                autoplay: true,
                autoplaySpeed: 3000,
                slidesToShow: 2,
                slidesToScroll: 2
            });
        });
    </script>
    @stack('search-JS')

</body>

</html>

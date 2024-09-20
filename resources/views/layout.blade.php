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

<body>
    @include('pages.header.menu')

    <main class="container main-container">
        @yield('content')
    </main>

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

    <script>
        $(document).ready(function() {
            $(".owl-carousel").owlCarousel({
                margin: 15,
                responsive: {
                    0: {
                        items: 3 // Hiển thị 1 card trên các thiết bị nhỏ (di động)
                    },
                    600: {
                        items: 3 // Hiển thị 2 card trên các thiết bị vừa
                    },
                    1000: {
                        items: 6 // Hiển thị tối đa 6 card trên máy tính
                    }
                }
            });
        });
    </script>

    @stack('Slider-JS')


</body>

</html>

<nav class="navbar navbar-expand-lg " style="background: #101014">
    <div class="container" style="padding-inline: 20px">
        <a class="navbar-brand fw-bold text-white" href="#">KNFilm.tv</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" aria-current="page"
                        href="{{ route('trang-chu') }}">Trang chủ</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ Request::is('the-loai/*') ? 'show active' : '' }}"
                        href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Thể loại
                    </a>
                    <ul class="dropdown-menu">
                        @foreach ($genre as $gen)
                            <li><a class="dropdown-item {{ Request::is('the-loai/' . $gen->slug) ? 'active' : '' }}"
                                    href="{{ URL::to('the-loai/' . $gen->slug) }}">{{ $gen->title }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Quốc gia
                    </a>
                    <ul class="dropdown-menu">
                        @foreach ($country as $con)
                            <li><a class="dropdown-item"
                                    href="{{ URL::to('quoc-gia/' . $con->slug) }}">{{ $con->title }}</a></li>
                        @endforeach
                    </ul>
                </li>
                @foreach ($category as $cate)
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('danh-muc/' . $cate->slug) ? 'active' : '' }}"
                            aria-current="page" href="{{ URL::to('danh-muc/' . $cate->slug) }}">{{ $cate->title }}</a>
                    </li>
                @endforeach
            </ul>
            <nav class="nav-header">
                <a href="#" class="nav__logo"></a>
                <div class="nav__actions">
                    <i class="fa-solid fa-magnifying-glass nav__search" id="search-btn"></i>
                    <i class="fa-regular fa-user nav__login" id="login-btn"></i>
                </div>
            </nav>
        </div>
    </div>
</nav>


<div class="search" id="search">
    <form action="{{ route('tim-kiem') }}" class="search__form" method="GET">
        <i class="ri-search-line search__icon"></i>
        <input type="text" placeholder="Tìm kiếm phim?" class="search__input " id="search_json" name="tu_khoa"
            required>
        <button type="submit" style="display: none"></button>
    </form>
    <i class="fa-regular fa-circle-xmark search__close" id="search-close"></i>
    <ul class="list-group" id="search_result" style="display: none"></ul>
</div>

@push('search-JS')
    <script>
        $(document).ready(function() {
            $('#search_json').keyup(function() {
                $('#search_result').html('');
                var search = $('#search_json').val();
                if (search != '') {
                    $('#search_result').css('display', 'inherit')
                    var expression = new RegExp(search, "i");
                    var jsonUrl = "{{ asset('Frontend/jsonFile/movies.json') }}";
                    var imageBasePath = "{{ asset('uploads/movies/') }}";

                    $.getJSON(jsonUrl, function(data) {
                        $.each(data, function(key, value) {
                            if (value.title.search(expression) != -1 || value.description
                                .search(expression) != -1) {
                                $('#search_result').append(
                                    '<div class="row rank-item">' +
                                    '<div class="col-3 col-lg-3 col-md-5">' +
                                    '<a class="text-white text-decoration-none" href="{{ URL::to('/phim/') }}/' +
                                    value.slug + '">' +
                                    '<img class="img-fluid" src="' + imageBasePath +
                                    '/' + value.image + '" alt="' + value.title +
                                    '" title="' + value.title + '">' + '</a>' +
                                    '</div>' + '<div class="col-9 col-lg-8 col-md-7">' +
                                    '<h5 class="title">' + value.title + '</h5>' +
                                    '<span class="sub-title">' + value.sub_title +
                                    '</span>' + '</div>' + '</div>'

                                );
                            }
                        });
                    });
                }
            });
        });

        const searchResult = document.getElementById('search_result');

        let isDown = false; // Biến cờ để kiểm tra xem chuột có đang được nhấn hay không
        let startY;
        let scrollTop;

        // Thêm sự kiện khi nhấn chuột xuống
        searchResult.addEventListener('mousedown', (e) => {
            isDown = true;
            searchResult.classList.add('active'); // Thêm class nếu cần hiệu ứng
            startY = e.pageY - searchResult.offsetTop; // Lấy vị trí của chuột so với phần tử
            scrollTop = searchResult.scrollTop; // Vị trí cuộn hiện tại
        });

        // Thêm sự kiện khi di chuột (khi đang giữ chuột)
        searchResult.addEventListener('mousemove', (e) => {
            if (!isDown) return; // Chỉ xử lý khi chuột đang được giữ
            e.preventDefault(); // Ngăn chặn các hành vi mặc định
            const y = e.pageY - searchResult.offsetTop; // Lấy vị trí hiện tại của chuột
            const walk = (y - startY) * 2; // Điều chỉnh tốc độ cuộn
            searchResult.scrollTop = scrollTop - walk; // Tính toán cuộn
        });

        // Thêm sự kiện khi nhả chuột
        searchResult.addEventListener('mouseup', () => {
            isDown = false;
            searchResult.classList.remove('active');
        });

        // Thêm sự kiện khi chuột ra khỏi vùng cuộn
        searchResult.addEventListener('mouseleave', () => {
            isDown = false;
        });
    </script>
@endpush


<!--==================== LOGIN ====================-->
<div class="login" id="login">
    <form action="" class="login__form">
        <h2 class="login__title">Log In</h2>
        <div class="login__group">
            <div>
                <label for="email" class="login__label">Email</label>
                <input type="email" placeholder="Write your email" id="email" class="login__input">
            </div>
            <div>
                <label for="password" class="login__label">Password</label>
                <input type="password" placeholder="Enter your password" id="password" class="login__input">
            </div>
        </div>
        <div>
            <p class="login__signup">
                You do not have an account? <a href="#">Sign up</a>
            </p>
            <a href="#" class="login__forgot">
                You forgot your password
            </a>
            <button type="submit" class="login__button">Log In</button>
        </div>
    </form>
    <i class="fa-regular fa-circle-xmark login__close" id="login-close"></i>
</div>

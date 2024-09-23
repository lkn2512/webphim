<nav class="navbar navbar-expand-lg nav-header" style="background: #101014">
    <div class="container" style="padding-inline: 20px">
        <a class="navbar-brand fw-bold text-white" href="#">KNFilm.tv</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('trang-chu') }}">Trang chủ</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Thể loại
                    </a>
                    <ul class="dropdown-menu">
                        @foreach ($genre as $gen)
                            <li><a class="dropdown-item"
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
                        <a class="nav-link" aria-current="page"
                            href="{{ URL::to('danh-muc/' . $cate->slug) }}">{{ $cate->title }}</a>
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


{{-- HEADER --}}
<div class="search" id="search">
    <form action="" class="search__form">
        <i class="ri-search-line search__icon"></i>
        <input type="search" placeholder="What are you looking for?" class="search__input">
    </form>
    <i class="fa-regular fa-circle-xmark search__close" id="search-close"></i>
</div>

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

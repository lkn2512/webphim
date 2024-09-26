@extends('layout')
@section('content')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb" class="breadcrumb-container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('trang-chu') }}">Trang chủ</a></li>
            <li class="breadcrumb-item"><a>Phim</a></li>
            <li class="breadcrumb-item" aria-current="page"> {{ $movie_detail->title }}</li>
        </ol>
    </nav>
    <div class="row mt-4">
        <div class="col-lg-8 col-md-12 col-sm-12 col-12 mb-3">
            <div class="row">
                <div class="col-lg-4 col-md-5 col-sm-6 col-12 text-center mb-3">
                    <div class="img-container">
                        <img class="img-fluid" src="{{ asset('uploads/movies/' . $movie_detail->image) }}"
                            alt="{{ $movie_detail->title }}" title="{{ $movie_detail->title }}">
                        @foreach ($movie_detail->categories as $category)
                            @if ($movie_detail->categories->where('slug', 'trailer')->isEmpty())
                                <a href="" class="view-movie"><i class="fa-solid fa-play"></i>&ensp;Xem phim</a>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-8 col-md-7 col-sm-6 col-12  mb-3">
                    <div class="detailMovie-container">
                        <h5 class="name">{{ $movie_detail->title }}</h5>
                        <span class="sub-name">{{ $movie_detail->sub_title }}</span>
                        <div class="row new-episode mt-2">
                            <span class="title-left col-lg-4 col-md-6 col-sm-6 col-6">Mới nhất:</span>
                            <span class="text col-lg-8 col-md-6 col-sm-6 col-6">Tập 16</span>
                        </div>
                        <hr>
                        <div class="row translation" style="display: flex; align-items: center">
                            @php
                                $translations = [
                                    0 => 'Không có',
                                    1 => 'Vietsub',
                                    2 => 'Thuyết minh',
                                    3 => 'Lồng tiếng',
                                ];
                            @endphp
                            <span class="col-lg-4 col-md-6 col-sm-6 col-6 title-left">Phiên dịch nội dung: </span>
                            <span
                                class="col-lg-8 col-md-6 col-sm-6 col-6 text">{{ $translations[$movie_detail->translation] ?? 'Không có' }}</span>
                        </div>
                        <hr>
                        <div class="row movie-category">
                            <span class="title-left col-lg-4 col-md-6 col-sm-6 col-6">Danh mục phim:</span>
                            <span class="text col-lg-8 col-md-6 col-sm-6 col-6">
                                @foreach ($movie_detail->categories as $category)
                                    {{ $category->title }}{{ !$loop->last ? ', ' : ' ' }}
                                @endforeach
                            </span>
                        </div>
                        <hr>
                        <div class="row movie-country">
                            <span class="title-left col-lg-4 col-md-6 col-sm-6 col-6">Thể loại phim:</span>
                            <span class="text col-lg-8 col-md-6 col-sm-6 col-6">
                                @foreach ($movie_detail->genres as $gen)
                                    {{ $gen->title }}{{ !$loop->last ? ', ' : '' }}
                                @endforeach
                            </span>
                        </div>
                        <hr>
                        <div class="row movie-genre">
                            <span class="title-left col-lg-4 col-md-6 col-sm-6 col-6">Quốc gia sản xuất:</span>
                            <span class="text col-lg-8 col-md-6 col-sm-6 col-6">
                                @foreach ($movie_detail->countries as $coun)
                                    {{ $coun->title }}{{ !$loop->last ? ', ' : '' }}
                                @endforeach
                            </span>
                        </div>
                        <hr>
                        <div class="row info-different">
                            <span class="title-left col-lg-4 col-md-6 col-sm-6 col-6">Thông tin khác:</span>
                            <span class="text col-lg-8 col-md-6 col-sm-6 col-6">
                                <i class="fa-regular fa-calendar"></i>{{ $movie_detail->release_year }}, 24 tập
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="pcss3t pcss3t-effect-scale pcss3t-theme-1">
                    <input type="radio" name="pcss3t" checked id="tab1"class="tab-content-first">
                    <label for="tab1">Nội dung phim</label>

                    <input type="radio" name="pcss3t" id="tab2" class="tab-content-2">
                    <label for="tab2">Tập phim</label>

                    {{-- <input type="radio" name="pcss3t" id="tab3" class="tab-content-3">
                    <label for="tab3"><i class="icon-cogs"></i>Phần</label> --}}

                    <input type="radio" name="pcss3t" id="tab5" class="tab-content-last">
                    <label for="tab5">Phần khác</label>

                    <ul>
                        <li class="tab-content tab-content-first typography">
                            {!! $movie_detail->description !!}
                        </li>

                        <li class="tab-content tab-content-2 typography">
                            <a href="">
                                Tập 1
                            </a>
                            <a href="">
                                Tập 2
                            </a>
                            <a href="">
                                Tập 3
                            </a>
                        </li>
                        <li class="tab-content tab-content-last typography">
                            <div class="typography row">
                                @if ($related_seasons->isNotEmpty())
                                    @foreach ($related_seasons as $sea)
                                        <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
                                            <a href="{{ URL::to('phim/' . $sea->slug) }}">
                                                <div class="card-film">
                                                    <span class="episode">Phần {{ $sea->season }}</span>
                                                    <img class="img" src="{{ asset('uploads/movies/' . $sea->image) }}"
                                                        alt="{{ $sea->title }}" title="{{ $sea->title }}">
                                                    <div class="card-film-body">
                                                        <h5 class="title">{{ $sea->title }}</h5>
                                                        <span class="decs">{{ $sea->sub_title }}</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                @else
                                    <p class="p-2" style="font-size: 1rem">Hiện tại không có phần nào khác liên quan
                                        đến phim này.</p>
                                @endif
                            </div>
                        </li>
                    </ul>
                </div>
                <!--/ tabs -->
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12 col-12 mb-3">
            @include('pages.rankings.top-view')
        </div>
    </div>

    <div class="carousel-wrapper">
        <div class="title-section">
            <div class="title-left col-lg-2 col-md-4 col-sm-5 col-6">
                <span class="title-text">Phim cùng danh mục</span>
            </div>
            <div class="title-right col-lg-10 col-md-8 col-sm-7 col-6">
                <span class="view-all"></span>
            </div>
        </div>
        <div class="custom-nav">
            <button class="prev-arrow"><i class="fa-solid fa-chevron-left"></i></button>
            <button class="next-arrow"><i class="fa-solid fa-chevron-right"></i></button>
        </div>
        <div class="owl-carousel owl-theme">
            @foreach ($cate_movies as $cate)
                <div class="item">
                    <div class="card-film">
                        <span class="episode">Tập 10</span>
                        <img class="img" src="{{ asset('uploads/movies/' . $cate->image) }}" alt="{{ $cate->title }}"
                            title="{{ $cate->title }}">
                        <div class="card-film-body">
                            <h5 class="title">{{ $cate->title }}</h5>
                            <span class="decs">{{ $cate->sub_title }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="carousel-wrapper mt-4">
        <div class="title-section">
            <div class="title-left col-lg-2 col-md-4 col-sm-5 col-6">
                <span class="title-text">Phim cùng thể loại</span>
            </div>
            <div class="title-right col-lg-10 col-md-8 col-sm-7 col-6">
                <span class="view-all"></span>
            </div>
        </div>
        <div class="custom-nav">
            <button class="prev-arrow"><i class="fa-solid fa-chevron-left"></i></button>
            <button class="next-arrow"><i class="fa-solid fa-chevron-right"></i></button>
        </div>
        <div class="owl-carousel owl-theme">
            @foreach ($gen_movies as $gen)
                <div class="item">
                    <div class="card-film">
                        <span class="episode">Tập 10</span>
                        <img class="img" src="{{ asset('uploads/movies/' . $gen->image) }}"
                            alt="{{ $gen->title }}" title="{{ $gen->title }}">
                        <div class="card-film-body">
                            <h5 class="title">{{ $gen->title }}</h5>
                            <span class="decs">{{ $gen->sub_title }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="carousel-wrapper mt-4">
        <div class="title-section">
            <div class="title-left col-lg-2 col-md-4 col-sm-5 col-6">
                <span class="title-text">Phim cùng quốc gia</span>
            </div>
            <div class="title-right col-lg-10 col-md-8 col-sm-7 col-6">
                <span class="view-all"></span>
            </div>
        </div>
        <div class="custom-nav">
            <button class="prev-arrow"><i class="fa-solid fa-chevron-left"></i></button>
            <button class="next-arrow"><i class="fa-solid fa-chevron-right"></i></button>
        </div>
        <div class="owl-carousel owl-theme">
            @foreach ($country_movies as $count)
                <div class="item">
                    <div class="card-film">
                        <span class="episode">Tập 10</span>
                        <img class="img" src="{{ asset('uploads/movies/' . $count->image) }}"
                            alt="{{ $count->title }}" title="{{ $count->title }}">
                        <div class="card-film-body">
                            <h5 class="title">{{ $count->title }}</h5>
                            <span class="decs">{{ $count->sub_title }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

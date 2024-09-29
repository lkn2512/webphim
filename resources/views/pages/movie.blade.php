@extends('layout')
@section('content')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb" class="breadcrumb-container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('trang-chu') }}">Trang chủ</a></li>
            @foreach ($movie_detail->categories as $category)
                <li class="breadcrumb-item">
                    <a href="{{ URL::to('danh-muc/' . $category->slug) }}">{{ $category->title }}</a>
                </li>
            @endforeach
            @foreach ($movie_detail->genres as $genre)
                <li class="breadcrumb-item">
                    <a href="{{ URL::to('the-loai/' . $genre->slug) }}">{{ $genre->title }}</a>
                </li>
            @endforeach
            <li class="breadcrumb-item active" aria-current="page"> {{ $movie_detail->title }}</li>
        </ol>
    </nav>
    <div class="row mt-4">
        <div class="col-lg-8 col-md-12 col-sm-12 col-12 mb-3">
            <div class="row">
                <div class="col-lg-4 col-md-5 col-sm-6 col-12 text-center mb-3">
                    @php
                        // Lấy tập mới nhất của phim
                        $latestEpisode = $movie_detail->episodes->sortByDesc('episode_number')->first();
                    @endphp
                    <div class="img-container">
                        <img class="img-fluid" src="{{ asset('uploads/movies/' . $movie_detail->image) }}"
                            alt="{{ $movie_detail->title }}" title="{{ $movie_detail->title }}">
                        @if ($movie_detail->categories->where('slug', 'trailer')->isEmpty())
                            @if ($latestEpisode)
                                <a href="{{ route('xem-phim', ['slug' => $movie_detail->slug, 'tap' => $latestEpisode->episode_number]) }}"
                                    class="view-movie">
                                    <i class="fa-solid fa-play"></i>&ensp;Xem phim
                                </a>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="col-lg-8 col-md-7 col-sm-6 col-12  mb-3">
                    <div class="detailMovie-container">
                        <h5 class="name">{{ $movie_detail->title }}</h5>
                        <span class="sub-name">{{ $movie_detail->sub_title }}</span>
                        <div class="row new-episode mt-2">
                            <span class="title-left col-lg-4 col-md-6 col-sm-6 col-6">Mới nhất:</span>
                            <span class="text col-lg-8 col-md-6 col-sm-6 col-6">
                                @if ($latestEpisode)
                                    Tập {{ $latestEpisode->episode_number }}
                                @else
                                    Không có
                                @endif
                            </span>
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
                                <i class="fa-regular fa-calendar"></i>{{ $movie_detail->release_year }},
                                {{ $movie_detail->episodes_count }} tập
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
                            <div class="row">
                                @if ($episode_movie->count() > 0)
                                    @foreach ($episode_movie as $epi)
                                        <div class="col-lg-1 col-md-2 col-sm-2 col-2 mb-3">
                                            <a
                                                href="{{ route('xem-phim', ['slug' => $movie_detail->slug, 'tap' => $epi->episode_number]) }}">
                                                <button class="btn-episode ">
                                                    Tập {{ $epi->episode_number }}
                                                </button>
                                            </a>
                                        </div>
                                    @endforeach
                                @else
                                    <span class="note-null">Hiện chưa phim này chưa có tập nào</span>
                                @endif
                            </div>
                        </li>
                        <li class="tab-content tab-content-last typography">
                            <div class="typography row">
                                @if ($series_movie->count() > 0)
                                    @foreach ($series_movie as $ser)
                                        <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
                                            <a href="{{ URL::to('phim/' . $ser->slug) }}">
                                                <div class="card-film">
                                                    {{-- <span class="episode">Phần {{ $ser->serson }}</span> --}}
                                                    <img class="img" src="{{ asset('uploads/movies/' . $ser->image) }}"
                                                        alt="{{ $ser->title }}" title="{{ $ser->title }}">
                                                    <div class="card-film-body">
                                                        <h5 class="title">{{ $ser->title }}</h5>
                                                        <span class="decs">{{ $ser->sub_title }}</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                @else
                                    <span class="note-null">Hiện phim này không có phần nào khác!</span>
                                @endif
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12 col-12 mb-3">
            @include('pages.rankings.top-view')
        </div>
    </div>
    @if ($cate_movies->count() > 0)
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
                            <a href="{{ URL::to('phim/' . $cate->slug) }}">
                                @if ($cate->categories->contains('slug', 'phim-le') && $cate->latestEpisode)
                                    <span class="episode">Full</span>
                                @elseif ($cate->latestEpisode)
                                    <span class="episode">Tập {{ $cate->latestEpisode->episode_number }}</span>
                                @else
                                    <span class="episode">Đang cập nhật</span>
                                @endif
                                <img class="img" src="{{ asset('uploads/movies/' . $cate->image) }}"
                                    alt="{{ $cate->title }}" title="{{ $cate->title }}">
                                <div class="card-film-body">
                                    <h5 class="title">{{ $cate->title }}</h5>
                                    <span class="decs">{{ $cate->sub_title }}</span>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    @if ($gen_movies->count() > 0)
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
                            <a href="{{ URL::to('phim/' . $gen->slug) }}">
                                @if ($gen->categories->contains('slug', 'phim-le') && $gen->latestEpisode)
                                    <span class="episode">Full</span>
                                @elseif ($gen->latestEpisode)
                                    <span class="episode">Tập {{ $gen->latestEpisode->episode_number }}</span>
                                @else
                                    <span class="episode">Đang cập nhật</span>
                                @endif
                                <img class="img" src="{{ asset('uploads/movies/' . $gen->image) }}"
                                    alt="{{ $gen->title }}" title="{{ $gen->title }}">
                                <div class="card-film-body">
                                    <h5 class="title">{{ $gen->title }}</h5>
                                    <span class="decs">{{ $gen->sub_title }}</span>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    @if ($country_movies->count() > 0)
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
    @endif
@endsection

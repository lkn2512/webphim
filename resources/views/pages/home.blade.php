@extends('layout')
@section('content')
    {{-- Slider --}}
    @include('pages.slider')
    {{-- Slider --}}
    <div class="row new-film mt-5">
        <div class="col-lg-8 col-md-8">
            <div class="title-section">
                <div class="title-left col-lg-3 col-md-6 col-sm-5 col-6">
                    <span class="title-text">Phim mới cập nhật</span>
                </div>
                <div class="title-right col-lg-9 col-md-6 col-sm-7 col-6">
                    <span class="view-all"><a class="text" href="{{ URL::to('loc-phim') }}">Xem thêm</a></span>
                </div>
            </div>
            <div class="row">
                @foreach ($new_movie as $new)
                    <div class="col-lg-3 col-md-4 col-sm-4 col-6 mb-3">
                        <a href="{{ URL::to('phim/' . $new->slug) }}">
                            <div class="card-film">
                                @if ($new->latestEpisode)
                                    @if ($new->isPhimle())
                                        <span class="episode">{{ $new->latestEpisode->episode_display }}</span>
                                    @elseif($new->isPhimbo())
                                        @if ($new->completion_status == 1)
                                            <span class="episode">{{ $new->latestEpisode->episode_display }},
                                                END</span>
                                        @elseif($new->completion_status == 2)
                                            <span class="episode">{{ $new->latestEpisode->episode_display }},
                                                Tạm dừng</span>
                                        @else
                                            <span class="episode">{{ $new->latestEpisode->episode_display }}</span>
                                        @endif
                                    @endif
                                @else
                                    <span class="episode">Đang cập nhật</span>
                                @endif
                                <img class="img" src="{{ asset('uploads/movies/' . $new->image) }}"
                                    alt="{{ $new->title }}" title="{{ $new->title }}">
                                <div class="card-film-body">
                                    <h5 class="title">{{ $new->title }}</h5>
                                    <span class="decs">{{ $new->sub_title }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="title-section mt-4">
                <div class="title-left col-lg-3 col-md-6 col-sm-5 col-6">
                    <span class="title-text">Phim bộ</span>
                </div>
                <div class="title-right col-lg-9 col-md-6 col-sm-7 col-6">
                    <span class="view-all"><a class="text" href="{{ URL::to('danh-muc/phim-bo') }}">Xem
                            thêm</a></span>
                </div>
            </div>
            <div class="row">
                @foreach ($series_movie as $ser)
                    <div class="col-lg-3 col-md-4 col-sm-4 col-6 mb-3">
                        <a href="{{ URL::to('phim/' . $ser->slug) }}">
                            <div class="card-film">
                                @if ($ser->latestEpisode)
                                    @if ($ser->completion_status == 1)
                                        <span class="episode">{{ $ser->latestEpisode->episode_display }},
                                            END</span>
                                    @elseif($ser->completion_status == 2)
                                        <span class="episode">{{ $ser->latestEpisode->episode_display }},
                                            Tạm dừng</span>
                                    @else
                                        <span class="episode">{{ $ser->latestEpisode->episode_display }}</span>
                                    @endif
                                @else
                                    <span class="episode">Đang cập nhật</span>
                                @endif
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
            </div>
            <div class="title-section mt-4">
                <div class="title-left col-lg-3 col-md-6 col-sm-5 col-6">
                    <span class="title-text">Phim lẻ</span>
                </div>
                <div class="title-right col-lg-9 col-md-6 col-sm-7 col-6">
                    <span class="view-all"><a class="text" href="{{ URL::to('danh-muc/phim-le') }}">Xem
                            thêm</a></span>
                </div>
            </div>
            <div class="row">
                @foreach ($single_movie as $sin)
                    <div class="col-lg-3 col-md-4 col-sm-4 col-6 mb-3">
                        <a href="{{ URL::to('phim/' . $sin->slug) }}">
                            <div class="card-film">
                                @if ($sin->latestEpisode)
                                    <span class="episode">{{ $sin->latestEpisode->episode_display }}</span>
                                @else
                                    <span class="episode">Đang cập nhật</span>
                                @endif
                                <img class="img" src="{{ asset('uploads/movies/' . $sin->image) }}"
                                    alt="{{ $sin->title }}" title="{{ $sin->title }}">
                                <div class="card-film-body">
                                    <h5 class="title">{{ $sin->title }}</h5>
                                    <span class="decs">{{ $sin->sub_title }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-lg-4 col-md-4">
            @include('pages.rankings.top-view')
            <div class="mt-4"></div>
            @include('pages.rankings.ranking-date')
        </div>
    </div>
    {{-- <div class="carousel-wrapper mt-4">
        <div class="title-section row">
            <div class="title-left col-lg-1 col-md-2 col-sm-3 col-3">
                <span class="title-text">Phim Hot</span>
            </div>
            <div class="title-right col-lg-11 col-md-10 col-sm-9 col-9">
                <span class="view-all"></span>
            </div>
        </div>
        <div class="custom-nav">
            <button class="prev-arrow"><i class="fa-solid fa-chevron-left"></i></button>
            <button class="next-arrow"><i class="fa-solid fa-chevron-right"></i></button>
        </div>
        <div class="owl-carousel owl-theme">
            @foreach ($view_movie as $view)
                <div class="item">
                    <div class="card-film">
                        <span class="episode">Tập 10</span>
                        <img class="img" src="{{ asset('uploads/movies/' . $view->image) }}" alt="{{ $view->title }}"
                            title="{{ $view->title }}">
                        <div class="card-film-body">
                            <h5 class="title">{{ $view->title }}</h5>
                            <span class="decs">{{ $view->sub_title }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div> --}}
@endsection

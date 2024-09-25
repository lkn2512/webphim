@extends('layout')
@section('content')
    {{-- Slider --}}
    @include('pages.slider')
    {{-- Slider --}}
    <div class="row new-film mt-5">
        <div class="col-lg-8 col-md-8">
            <div class="title-section row  ">
                <div class="title-left col-lg-3 col-md-6 col-sm-5 col-6">
                    <span class="title-text">Phim mới cập nhật</span>
                </div>
                <div class="title-right col-lg-9 col-md-6 col-sm-7 col-6">
                    <span class="view-all"></span>
                </div>
            </div>
            <div class="row">
                @foreach ($new_movie as $new)
                    <div class="col-6 col-lg-3 col-md-4 col-sm-4  mb-3">
                        <a href="{{ URL::to('phim/' . $new->slug) }}">
                            <div class="card-film">
                                <span class="episode">Tập 10</span>
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
        </div>
        <div class="col-lg-4 col-md-4">
            <div class="title-section row">
                <div class="title-left col-lg-5 col-md-9 col-sm-4 col-5">
                    <span class="title-text">Bảng xếp hạng</span>
                </div>
                <div class="title-right col-lg-7 col-md-3 col-sm-8 col-7">
                    <span class="view-all"></span>
                </div>
            </div>
            <div class="rank-container">
                <div class="row rank-item">
                    <div class="col-3 col-lg-3 col-md-5">
                        <img class="img-fluid" src="{{ asset('FrontEnd/Image/pttt.jpg') }}" alt="Image">
                    </div>
                    <div class="col-9 col-lg-8 col-md-7">
                        <h5 class="title">Đại chúa tể</h5>
                    </div>
                </div>
                <div class="row rank-item">
                    <div class="col-3 col-lg-3 col-md-5">
                        <img class="img-fluid" src="{{ asset('FrontEnd/Image/pttt.jpg') }}" alt="Image">
                    </div>
                    <div class="col-9 col-lg-8 col-md-7">
                        <h5 class="title">Đại chúa tể</h5>
                        <span class="desc"></span>
                    </div>
                </div>
                <div class="row rank-item">
                    <div class="col-3 col-lg-3 col-md-5">
                        <img class="img-fluid" src="{{ asset('FrontEnd/Image/pttt.jpg') }}" alt="Image">
                    </div>
                    <div class="col-9 col-lg-8 col-md-7 ">
                        <h5 class="title">Tam chiến thiên hạ, thiên chân vô song</h5>
                        <span class="desc"></span>
                    </div>
                </div>
                <div class="row rank-item">
                    <div class="col-3 col-lg-3 col-md-5">
                        <img class="img-fluid" src="{{ asset('FrontEnd/Image/pttt.jpg') }}" alt="Image">
                    </div>
                    <div class="col-9 col-lg-8 col-md-7">
                        <h5 class="title">Đại chúa tể</h5>
                        <span class="desc"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="carousel-wrapper mt-4">
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
    </div>

    <div class="row new-film mt-4">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="title-section row  ">
                <div class="title-left col-lg-1 col-md-2 col-sm-3 col-3">
                    <span class="title-text">Phim bộ</span>
                </div>
                <div class="title-right col-lg-11 col-md-10 col-sm-9 col-9">
                    <span class="view-all"></span>
                </div>
            </div>
            <div class="row">
                @foreach ($series_movie as $ser)
                    <div class="col-6 col-lg-2 col-md-4 col-sm-4 mb-3">
                        <div class="card-film">
                            <span class="episode">Tập 10</span>
                            <img class="img" src="{{ asset('uploads/movies/' . $ser->image) }}"
                                alt="{{ $ser->title }}" title="{{ $ser->title }}">
                            <div class="card-film-body">
                                <h5 class="title">{{ $ser->title }}</h5>
                                <span class="decs">{{ $ser->sub_title }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="row new-film mt-4">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="title-section row  ">
                <div class="title-left col-lg-1 col-md-2 col-sm-3 col-3">
                    <span class="title-text">Phim lẻ</span>
                </div>
                <div class="title-right col-lg-11 col-md-10 col-sm-9 col-9">
                    <span class="view-all"></span>
                </div>
            </div>
            <div class="row">
                @foreach ($single_movie as $sin)
                    <div class="col-6 col-lg-2 col-md-4 col-sm-4 mb-3">
                        <div class="card-film">
                            <span class="episode">Tập 10</span>
                            <img class="img" src="{{ asset('uploads/movies/' . $sin->image) }}"
                                alt="{{ $sin->title }}" title="{{ $sin->title }}">
                            <div class="card-film-body">
                                <h5 class="title">{{ $sin->title }}</h5>
                                <span class="decs">{{ $sin->sub_title }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@extends('layout')
@section('content')
    {{-- Slider --}}
    @include('pages.slider')
    {{-- Slider --}}
    <div class="row new-film mt-5">
        <div class="col-lg-8 col-md-8">
            <h1 class="title-section">
                Phim mới cập nhật
            </h1>
            <div class="row">
                @foreach ($new_movie as $new)
                    <div class="col-6 col-lg-3 col-md-4 col-sm-4  mb-3">
                        <div class="card-film">
                            <span class="episode">Tập 10</span>
                            <img class="img" src="{{ asset('uploads/movies/' . $new->image) }}" alt="{{ $new->title }}"
                                title="{{ $new->title }}">
                            <div class="card-film-body">
                                <h5 class="title">{{ $new->title }}</h5>
                                <span class="decs">{{ $new->sub_title }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-lg-4 col-md-4">
            <h1 class="title-section">
                Bảng xếp hạng
            </h1>
            <hr>
            <div class="rank-container">
                <div class="row rank-item">
                    <div class="col-3 col-lg-3 col-md-3">
                        <img class="img-fluid" src="{{ asset('FrontEnd/Image/pttt.jpg') }}" alt="Image">
                    </div>
                    <div class="col-9 col-lg-8 col-md-8">
                        <h5 class="title">Đại chúa tể</h5>
                    </div>
                </div>
                <div class="row rank-item">
                    <div class="col-3 col-lg-3 col-md-3">
                        <img class="img-fluid" src="{{ asset('FrontEnd/Image/pttt.jpg') }}" alt="Image">
                    </div>
                    <div class="col-9 col-lg-8 col-md-8">
                        <h5 class="title">Đại chúa tể</h5>
                        <span class="desc"></span>
                    </div>
                </div>
                <div class="row rank-item">
                    <div class="col-3 col-lg-3 col-md-3">
                        <img class="img-fluid" src="{{ asset('FrontEnd/Image/pttt.jpg') }}" alt="Image">
                    </div>
                    <div class="col-9 col-lg-8 col-md-8 ">
                        <h5 class="title">Tam chiến thiên hạ, thiên chân vô song</h5>
                        <span class="desc"></span>
                    </div>
                </div>
                <div class="row rank-item">
                    <div class="col-3 col-lg-3 col-md-3">
                        <img class="img-fluid" src="{{ asset('FrontEnd/Image/pttt.jpg') }}" alt="Image">
                    </div>
                    <div class="col-9 col-lg-8 col-md-8">
                        <h5 class="title">Đại chúa tể</h5>
                        <span class="desc"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach ($category_home as $cateHome)
        @if ($cateHome->movies->count() > 0)
            <div class="row new-film mt-4">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <h1 class="title-section">
                        {{ $cateHome->title }}
                    </h1>
                    <div class="row">
                        @foreach ($cateHome->movies as $movie)
                            <div class="col-6 col-lg-2 col-md-4 col-sm-4 mb-3">
                                <div class="card-film">
                                    <span class="episode">Tập 10</span>
                                    <img class="img" src="{{ asset('uploads/movies/' . $movie->image) }}"
                                        alt="{{ $movie->title }}" title="{{ $movie->title }}">
                                    <div class="card-film-body">
                                        <h5 class="title">{{ $movie->title }}</h5>
                                        <span class="decs">{{ $movie->sub_title }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endsection

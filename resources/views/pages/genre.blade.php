@extends('layout')
@section('content')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb" class="breadcrumb-container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('trang-chu') }}">Trang chủ</a></li>
            <li class="breadcrumb-item" aria-current="page"> {{ $slugGenre->title }}</li>
        </ol>
    </nav>
    <div class="row mt-4">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="title-section row">
                <div class="title-left col-lg-2 col-md-6 col-sm-5 col-6">
                    <span class="title-text">{{ $slugGenre->title }}</span>
                </div>
                <div class="title-right col-lg-10 col-md-6 col-sm-7 col-6">
                    <span class="view-all"></span>
                </div>
            </div>
            <div class="row">
                @if ($GenreAllMovie->count() > 0)
                    @foreach ($GenreAllMovie as $value)
                        <div class="col-6 col-lg-2 col-md-4 col-sm-6 mb-3">
                            <div class="card-film">
                                <span class="episode">Tập 10</span>
                                <img class="img" src="{{ asset('uploads/movies/' . $value->image) }}"
                                    alt="{{ $value->title }}" title="{{ $value->title }}">
                                <div class="card-film-body">
                                    <h5 class="title">{{ $value->title }}</h5>
                                    <span class="decs">{{ $value->sub_title }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{ $GenreAllMovie->withQueryString()->appends(Request::all())->links('pagination-custom') }}
                @else
                    <p>Không tìm thấy phim nào thuộc thể loại này. Vui lòng khám phá các thể loại khác để tìm phim yêu thích
                        của bạn!
                    </p>
                @endif
            </div>
        </div>

    </div>
@endsection

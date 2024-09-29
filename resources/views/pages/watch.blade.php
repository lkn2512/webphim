@extends('layout')
@section('content')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb" class="breadcrumb-container">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb" class="breadcrumb-container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('trang-chu') }}">Trang chủ</a></li>
                @foreach ($movie->categories as $category)
                    <li class="breadcrumb-item">
                        <a href="{{ URL::to('danh-muc/' . $category->slug) }}">{{ $category->title }}</a>
                    </li>
                @endforeach
                @foreach ($movie->genres as $genre)
                    <li class="breadcrumb-item">
                        <a href="{{ URL::to('the-loai/' . $genre->slug) }}">{{ $genre->title }}</a>
                    </li>
                @endforeach
                <li class="breadcrumb-item">
                    <a href="{{ URL::to('phim/' . $movie->slug) }}">{{ $movie->title }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Tập {{ $episode->episode_number }}</li>
            </ol>
        </nav>
    </nav>
    <div class="mt-4">
        <div class="row mb-5">
            {!! $episode->iframe !!}
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="list-container">
                    <h5 class="title-list">Danh sách các tập phim</h5>
                    <div class="row">
                        @if ($episode_movie->count() > 0)
                            @foreach ($episode_movie as $epi)
                                <div class="col-lg-1 col-md-2 col-sm-2 col-2 mb-3">
                                    <a
                                        href="{{ route('xem-phim', ['slug' => $movie->slug, 'tap' => $epi->episode_number]) }}">
                                        <button
                                            class="btn-episode {{ Request::is('xem-phim/' . $movie->slug . '/tap-' . $epi->episode_number) ? 'active' : '' }}">
                                            Tập {{ $epi->episode_number }}
                                        </button>
                                    </a>
                                </div>
                            @endforeach
                        @else
                            <span class="note-null">Hiện chưa phim này chưa có tập nào</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="list-container">
                    <h5 class="title-list">Danh sách các phần</h5>
                    @if ($series_movie->count() > 0)
                        <div class="row">
                            @foreach ($series_movie as $ser)
                                <div class="col-lg-6 col-md-4 col-sm-6 col-6 mb-3">
                                    <a href="{{ URL::to('phim/' . $ser->slug) }}">
                                        <div class="card-film">
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
                    @else
                        <span class="note-null">Hiện phim này không có phần nào khác!</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

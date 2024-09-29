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
    <div class="row mt-4">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
            <div class="row" style="height: 100%">
                {!! $episode->link !!}
            </div>
        </div>
    </div>
@endsection

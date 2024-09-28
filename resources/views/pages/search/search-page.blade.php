@extends('layout')
@section('content')
    <div class="row mt-4">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <h4 class="title-search">Có {{ $count_movie }} kết quả tìm kiếm cho từ khoá: "{{ $keyWord }}"</h4>
            <hr>
            <div class="row mt-4">
                @if ($count_movie > 0)
                    @foreach ($movie as $value)
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
                    {{ $movie->withQueryString()->appends(Request::all())->links('pagination-custom') }}
                @else
                    <p>Không tìm thấy kết quả nào phù hợp với từ khoá "{{ $keyWord }}"
                    </p>
                @endif
            </div>
        </div>
    </div>
@endsection

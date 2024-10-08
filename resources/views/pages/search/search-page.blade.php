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
                                <a href="{{ URL::to('phim/' . $value->slug) }}">
                                    @if ($value->latestEpisode)
                                        @if ($value->isPhimle())
                                            <span class="episode">{{ $value->latestEpisode->episode_display }}</span>
                                        @elseif($value->isPhimbo())
                                            @if ($value->completion_status == 1)
                                                <span class="episode">{{ $value->latestEpisode->episode_display }},
                                                    END</span>
                                            @elseif($value->completion_status == 2)
                                                <span class="episode">{{ $value->latestEpisode->episode_display }},
                                                    Tạm dừng</span>
                                            @else
                                                <span class="episode">{{ $value->latestEpisode->episode_display }}</span>
                                            @endif
                                        @endif
                                    @else
                                        <span class="episode">Đang cập nhật</span>
                                    @endif
                                    <img class="img" src="{{ asset('uploads/movies/' . $value->image) }}"
                                        alt="{{ $value->title }}" title="{{ $value->title }}">
                                    <div class="card-film-body">
                                        <h5 class="title">{{ $value->title }}</h5>
                                        <span class="decs">{{ $value->sub_title }}</span>
                                    </div>
                                </a>
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

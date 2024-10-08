@extends('layout')
@section('content')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb" class="breadcrumb-container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('trang-chu') }}">Trang chủ</a></li>
            <li class="breadcrumb-item" aria-current="page"> {{ $slugCategory->title }}</li>
        </ol>
    </nav>
    @if ($categoryAllMovie->count() > 0)
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-12">
                <div class="category-slider">
                    <div class="multiple-items">
                        @foreach ($slider as $sli)
                            <div class="item">
                                <a href="{{ URL::to('phim/' . $sli->movie->slug) }}">
                                    <img src="{{ asset('uploads/slider/' . $sli->image) }}" alt="{{ $sli->movie->title }}">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="title-section">
                        <div class="title-left col-lg-4 col-md-7 col-sm-6 col-7">
                            <span class="title-text">{{ $slugCategory->title }} mới cập nhật</span>
                        </div>
                        <div class="title-right col-lg-8 col-md-5 col-sm-6 col-5">
                            <span class="view-all"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($categoryAllMovie as $value)
                        <div class="col-6 col-lg-3 col-md-4 col-sm-6 mb-3">
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
                    {{ $categoryAllMovie->withQueryString()->appends(Request::all())->links('pagination-custom') }}
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="row">
                    <div class="title-section">
                        <div class="title-left col-lg-6 col-md-10 col-sm-5 col-6">
                            <span class="title-text">
                                BXH {{ $titleCategory }}
                            </span>
                        </div>
                        <div class="title-right col-lg-6 col-md-2 col-sm-7 col-6">
                            <span class="view-all"></span>
                        </div>
                    </div>
                </div>

                <div class="rank-container">
                    @foreach ($bxh_movie as $rand)
                        <a href="{{ URL::to('phim/' . $rand->slug) }}">
                            <div class="row rank-item">
                                <div class="col-3 col-lg-3 col-md-5 col-sm-3">
                                    <img class="img-fluid" src="{{ asset('uploads/movies/' . $rand->image) }}"
                                        alt="{{ $rand->title }}" title="{{ $rand->title }}">
                                </div>
                                <div class="col-9 col-lg-9 col-md-7 col-sm-9 px-0">
                                    <span class="title">{{ $rand->title }}</span>
                                    <span class="sub-title">{{ $rand->sub_title }}</span>
                                    <span class="view">
                                        <i class="fa-regular fa-eye"></i>
                                        {{ number_format($rand->views_sum_view_count) }} lượt xem
                                    </span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    @else
        <p>Không tìm thấy phim nào trong danh mục này. Vui lòng khám phá các danh mục khác để tìm phim yêu
            thích của bạn!
        </p>
    @endif
@endsection

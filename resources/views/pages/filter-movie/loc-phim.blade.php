@extends('layout')
@section('content')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb" class="breadcrumb-container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('trang-chu') }}">Trang chủ</a></li>
            <li class="breadcrumb-item" aria-current="page">Lọc phim</li>
        </ol>
    </nav>
    <div class="mt-4">
        <form action="{{ URL::to('loc-phim/ket-qua') }}" method="GET">
            <div class="row">
                <div class="col-lg-2 col-md-3 col-sm-4 col-4 mb-2">
                    <select class="form-select select-filter " name="sap-xep">
                        <option value="">--Sắp xếp--</option>
                        <option value="date" {{ request('sap-xep') == 'date' ? 'selected' : '' }}>Ngày đăng</option>
                        <option value="year_release" {{ request('sap-xep') == 'year_release' ? 'selected' : '' }}>Năm SX
                        </option>
                        <option value="name_a_z" {{ request('sap-xep') == 'name_a_z' ? 'selected' : '' }}>Tên phim
                        </option>
                        <option value="watch_views" {{ request('sap-xep') == 'watch_views' ? 'selected' : '' }}>Lượt xem
                        </option>
                    </select>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4 col-4 mb-2">
                    <select class="form-select select-filter " name="danh-muc">
                        <option value="">--Danh mục--</option>
                        @foreach ($category as $cate)
                            <option value="{{ $cate->id }}" {{ request('danh-muc') == $cate->id ? 'selected' : '' }}>
                                {{ $cate->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4 col-4 mb-2">
                    <select class="form-select select-filter" name="the-loai">
                        <option value="">--Thể loại--</option>
                        @foreach ($genre as $gen)
                            <option value="{{ $gen->id }}" {{ request('the-loai') == $gen->id ? 'selected' : '' }}>
                                {{ $gen->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4 col-4 mb-2">
                    <select class="form-select select-filter" name="quoc-gia">
                        <option value="">--Quốc gia--</option>
                        @foreach ($country as $count)
                            <option value="{{ $count->id }}" {{ request('quoc-gia') == $count->id ? 'selected' : '' }}>
                                {{ $count->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4 col-4 mb-2">
                    @php
                        $years = range(1900, date('Y'));
                    @endphp
                    <select class="form-select select-filter" name="namSX">
                        <option value="">--Năm SX--</option>
                        @foreach ($years as $year)
                            <option value="{{ $year }}" {{ request('namSX') == $year ? 'selected' : '' }}>
                                {{ $year }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-1 col-md-3 col-sm-6 col-6 mb-2">
                    <button type="submit" class="btn-filter">Lọc</button>
                </div>
                <div class="col-lg-1 col-md-3 col-sm-6 col-6 mb-2">
                    <a href="{{ URL::to('loc-phim') }}"><button type="button" class="btn-refesh">Tải lại</button></a>
                </div>
            </div>
        </form>
    </div>

    @if ($movies->count() > 0)
        <div class="row mt-3">
            @foreach ($movies as $value)
                <div class="col-6 col-lg-2 col-md-3 col-sm-4 col-2 col-md-4 col-sm-6 mb-3">
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
            {{ $movies->withQueryString()->appends(Request::all())->links('pagination-custom') }}
        </div>
    @else
        <p>Không tìm thấy phim nào phù hợp với điều kiện trên</p>
    @endif
@endsection

{{-- @extends('layout')
@section('content')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb" class="breadcrumb-container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('trang-chu') }}">Trang chủ</a></li>
            <li class="breadcrumb-item" aria-current="page">Lọc phim</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <form action="{{ URL::to('loc-phim/ket-qua') }}" method="GET">
                <div class="row mt-4">
                    <div class="col-lg-2">
                        <select class="form-select" name="sap-xep">
                            <option value="">Sắp xếp</option>
                            <option value="date">Ngày đăng</option>
                            <option value="year_release">Năm SX</option>
                            <option value="name_a_z">Tên phim</option>
                            <option value="watch_views">Lượt xem</option>
                        </select>
                    </div>
                    <div class="col-lg-2">
                        <select class="form-select" name="danh-muc">
                            <option value="">Danh mục</option>
                            @foreach ($category as $cate)
                                <option value="{{ $cate->id }}">{{ $cate->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-2">
                        <select class="form-select" name="the-loai">
                            <option value="">Thể loại</option>
                            @foreach ($genre as $gen)
                                <option value="{{ $gen->id }}">{{ $gen->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-2">
                        <select class="form-select" name="quoc-gia">
                            <option value="">Quốc gia</option>
                            @foreach ($country as $count)
                                <option value="{{ $count->id }}">{{ $count->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-2">
                        @php
                            $years = range(1900, date('Y'));
                        @endphp
                        <select class="form-select" name="nam">
                            <option value="">Năm</option>
                            @foreach ($years as $year)
                                <option value="{{ $year }}">
                                    {{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-2">
                        <button type="submit" class="">Lọc phim</button>
                    </div>
                </div>
            </form>

            <div class="row mt-4">
                <div class="title-section">
                    <div class="title-left col-lg-2 col-md-4 col-sm-4 col-5">
                        <span class="title-text">Kết quả lọc phim</span>
                    </div>
                    <div class="title-right col-lg-10 col-md-8 col-sm-8 col-7">
                        <span class="view-all"></span>
                    </div>
                </div>
            </div>
            @if ($movies->count() > 0)
                <div class="row">
                    @foreach ($movies as $value)
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
                    {{ $movies->withQueryString()->appends(Request::all())->links('pagination-custom') }}
                </div>
            @else
                <p>Không tìm thấy phim nào trong danh mục này. Vui lòng khám phá các danh mục khác để tìm phim yêu
                    thích của bạn!
                </p>
            @endif
        </div>


    </div>
@endsection --}}
@extends('layout')
@section('content')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb" class="breadcrumb-container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('trang-chu') }}">Trang chủ</a></li>
            <li class="breadcrumb-item" aria-current="page">Lọc phim</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <form action="{{ URL::to('loc-phim/ket-qua') }}" method="GET">
                <div class="row mt-4">
                    <div class="col-lg-2">
                        <select class="form-select" name="sap-xep">
                            <option value="">Sắp xếp</option>
                            <option value="date" {{ request('sap-xep') == 'date' ? 'selected' : '' }}>Ngày đăng</option>
                            <option value="year_release" {{ request('sap-xep') == 'year_release' ? 'selected' : '' }}>Năm SX
                            </option>
                            <option value="name_a_z" {{ request('sap-xep') == 'name_a_z' ? 'selected' : '' }}>Tên phim
                            </option>
                            <option value="watch_views" {{ request('sap-xep') == 'watch_views' ? 'selected' : '' }}>Lượt xem
                            </option>
                        </select>
                    </div>
                    <div class="col-lg-2">
                        <select class="form-select" name="danh-muc">
                            <option value="">Danh mục</option>
                            @foreach ($category as $cate)
                                <option value="{{ $cate->id }}"
                                    {{ request('danh-muc') == $cate->id ? 'selected' : '' }}>
                                    {{ $cate->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-2">
                        <select class="form-select" name="the-loai">
                            <option value="">Thể loại</option>
                            @foreach ($genre as $gen)
                                <option value="{{ $gen->id }}"
                                    {{ request('the-loai') == $gen->id ? 'selected' : '' }}>
                                    {{ $gen->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-2">
                        <select class="form-select" name="quoc-gia">
                            <option value="">Quốc gia</option>
                            @foreach ($country as $count)
                                <option value="{{ $count->id }}"
                                    {{ request('quoc-gia') == $count->id ? 'selected' : '' }}>
                                    {{ $count->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-2">
                        @php
                            $years = range(1900, date('Y'));
                        @endphp
                        <select class="form-select" name="nam">
                            <option value="">Năm</option>
                            @foreach ($years as $year)
                                <option value="{{ $year }}" {{ request('nam') == $year ? 'selected' : '' }}>
                                    {{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-1">
                        <button type="submit" class="">Lọc phim</button>
                    </div>
                    <div class="col-lg-1">
                        <a href="{{ URL::to('loc-phim') }}"><button type="button" class="">Tải lại</button></a>
                    </div>
                </div>
            </form>

            <div class="row mt-4">
                <div class="title-section">
                    <div class="title-left col-lg-2 col-md-4 col-sm-4 col-5">
                        <span class="title-text">Kết quả lọc phim</span>
                    </div>
                    <div class="title-right col-lg-10 col-md-8 col-sm-8 col-7">
                        <span class="view-all"></span>
                    </div>
                </div>
            </div>
            @if ($movies->count() > 0)
                <div class="row">
                    @foreach ($movies as $value)
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
                    {{ $movies->withQueryString()->appends(Request::all())->links('pagination-custom') }}
                </div>
            @else
                <p>Không tìm thấy phim nào phù hợp với điều kiện trên</p>
            @endif
        </div>
    </div>
@endsection

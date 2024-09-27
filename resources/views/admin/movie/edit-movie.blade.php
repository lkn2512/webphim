@extends('layouts.app')

@section('content')
    <form role="form" action="{{ route('movie.update', $editMovie->id) }}" method="POST" enctype="multipart/form-data"
        id="movieForm">
        @csrf
        {{-- <input type="hidden" name="_method" value="PUT"> --}}
        @method('PUT')
        <div class="header-title row">
            <div class="col-lg-8 col-md-6 col-12 mb-3 header-left">
                <h3 class="title-content">Cập nhật phim</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('movie.index') }}">Quản lý phim</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Cập nhật phim
                    </li>
                </ol>
            </div>
            <div class="col-lg-4 col-md-6 col-12 mb-3 header-right">
                <div class="row justify-content-end">
                    <div class="col-lg-3 col-md-4 col-4">
                        <a href="" onclick="location.reload();">
                            <button type="button" class="btn-refesh">
                                <i class="fa-solid fa-arrows-rotate"></i>Tải lại
                            </button>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-4 col-4">
                        <button type="submit" class="btn-add">
                            <i class="fa-solid fa-check"></i>Lưu
                        </button>
                    </div>
                    <div class="col-lg-3 col-md-4 col-4">
                        <a href="{{ route('movie.index') }}">
                            <button type="button" class="btn-back">
                                <i class="fa-solid fa-arrow-left"></i>Quay về
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-dnb">
                        <h3 class="card-title">Thuộc tính phim</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputName">Tên phim</label>
                            <input type="text" id="inputName" class="form-control" name="movieName"
                                data-slug-source="movie" required value="{{ $editMovie->title }}">
                        </div>
                        <div class="form-group">
                            <label for="inputName">Phụ đề tên phim</label>
                            <input type="text" id="inputSubTitle" class="form-control" name="movieSubTitle" required
                                value="{{ $editMovie->sub_title }}">
                        </div>
                        <div class="form-group">
                            <label>Slug<small class="note"> (tự động)</small></label>
                            <input type="text" name="movieSlug" class="form-control" required data-slug-target="movie"
                                value="{{ $editMovie->slug }}">
                        </div>
                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <input type="file" name="movieImage" class="form-control" accept="image/*">
                            <img class="editImage mt-3" src="{{ asset('/uploads/movies/' . $editMovie->image) }}">
                        </div>
                        <div class="form-group">
                            <label for="inputDescription">Mô tả</label>
                            <textarea id="movieDescription" class="form-control froala-editor" rows="4" name="movieDescription">
                                {{ $editMovie->description }}
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-dnb">
                        <h3 class="card-title">Phân loại</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="flex-center-between">
                                <label for="inputCategory">Danh mục</label>
                                <a class="addNew" href="{{ route('category.create') }}">Thêm mới</a>
                            </div>
                            <hr>
                            <div class="row">
                                @foreach ($category as $cate)
                                    <div class="col-lg-4 col-md-6 col-4 col-sm-4 text-start mb-1">
                                        <input type="checkbox" name="movieCategory[]" value="{{ $cate->id }}"
                                            {{ $editMovie->categories->contains($cate->id) ? 'checked' : '' }}>
                                        {{ $cate->title }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="flex-center-between">
                                <label for="inputGenre">Thể loại</label>
                                <a class="addNew" href="{{ route('genre.create') }}">Thêm mới</a>
                            </div>
                            <hr>
                            <div class="row">
                                @foreach ($genre as $gens)
                                    <div class="col-lg-3 col-md-6 col-4 col-sm-4 text-start mb-1">
                                        <input type="checkbox" name="movieGenre[]" value="{{ $gens->id }}"
                                            {{ $editMovie->genres->contains($gens->id) ? 'checked' : '' }}>
                                        {{ $gens->title }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="flex-center-between">
                                <label for="inputCountry">Quốc gia</label>
                                <a class="addNew" href="{{ route('country.create') }}">Thêm mới</a>
                            </div>
                            <hr>
                            <div class="row">
                                @foreach ($country as $count)
                                    <div class="col-lg-3 col-md-6 col-sm-4 col-4 text-start mb-1">
                                        <input type="checkbox" name="movieCountry[]" value="{{ $count->id }}"
                                            {{ $editMovie->countries->contains($count->id) ? 'checked' : '' }}>
                                        {{ $count->title }}
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-dnb">
                        <h3 class="card-title">Thông tin bổ sung</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="inputStatus">Phiên dịch nội dung</label>
                                    <select id="inputStatus" class="form-control custom-select" name="movieTranslation">
                                        <option value="0" {{ $editMovie->translation == 0 ? 'selected' : '' }}>Không
                                            có
                                        </option>
                                        <option value="1" {{ $editMovie->translation == 1 ? 'selected' : '' }}>
                                            Vietsub
                                        </option>
                                        <option value="2" {{ $editMovie->translation == 2 ? 'selected' : '' }}>Thuyết
                                            minh
                                        </option>
                                        <option value="3" {{ $editMovie->translation == 3 ? 'selected' : '' }}>Lồng
                                            tiếng
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="inputYear">Năm phát hành</label>
                                    <select id="inputYear" class="form-control custom-select select2" name="movieYear">
                                        @foreach ($years as $year)
                                            <option
                                                value="{{ $year }}"{{ $editMovie->release_year == $year ? 'selected' : '' }}>
                                                {{ $year }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="flex-center-between">
                                        <label for="inputSeries">Series phim</label>
                                        <a class="addNew" href="{{ route('series.create') }}">Thêm mới</a>
                                    </div>
                                    <select id="inputSeries" class="form-control custom-select select2"
                                        name="movieSeries">
                                        <option value="0">Không có</option>
                                        @foreach ($series as $ser)
                                            <option value="{{ $ser->id }}"
                                                {{ isset($editMovie->series) && $editMovie->series->id == $ser->id ? 'selected' : '' }}>
                                                {{ $ser->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="inputStatus">Trạng thái</label>
                                    <select id="inputStatus" class="form-control custom-select" name="movieStatus">
                                        <option value="1" {{ $editMovie->status == 1 ? 'selected' : '' }}>Hiển thị
                                        </option>
                                        <option value="0" {{ $editMovie->status == 0 ? 'selected' : '' }}>Ẩn</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

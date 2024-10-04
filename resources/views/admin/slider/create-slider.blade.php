@extends('layouts.app')

@section('content')
    <form role="form" action="{{ route('slider.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="header-title row">
            <div class="col-lg-8 col-md-6 col-12 mb-3 header-left">
                <h3 class="title-content">Thêm slider</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('slider.index') }}">Quản lý slider</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Thêm slider
                    </li>
                </ol>
            </div>
            <div class="col-lg-4 col-md-6 col-12 mb-3 header-right">
                <div class="row justify-content-end">
                    <div class="col-lg-3 col-md-4 col-4">
                        <a href="">
                            <button type="button" class="btn-refesh" onclick="location.reload();">
                                <i class="fa-solid fa-arrows-rotate"></i>Tải lại
                            </button>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-4 col-4">
                        <button type="submit" class="btn-add">
                            <i class="fa-solid fa-plus"></i>Thêm
                        </button>
                    </div>
                    <div class="col-lg-3 col-md-4 col-4">
                        <a href="{{ route('slider.index') }}">
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
                        <h3 class="card-title">Tổng quan</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputName">Tiêu đề</label>
                            <input type="text" id="inputName" class="form-control auto-focus" name="sliderTitle"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <input type="file" name="sliderImage" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-dnb">
                        <h3 class="card-title">Tuỳ chọn</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputStatus">Phim liên kết</label>
                            <select id="inputStatus" class="form-control select2" name="movie_id" required>
                                <option selected disabled value="0">--Chọn phim liên kết--</option>
                                @foreach ($movie as $value)
                                    <option value="{{ $value->id }}">{{ $value->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputDescription">Mô tả</label>
                            <textarea id="inputDescription" class="form-control" rows="4" name="sliderDescription"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="inputStatus">Trạng thái</label>
                            <select id="inputStatus" class="form-control custom-select" name="sliderStatus">
                                <option selected value="1">Hiển thị</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

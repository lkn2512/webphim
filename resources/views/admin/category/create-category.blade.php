@extends('layouts.app')

@section('content')
    <form role="form" action="{{ route('category.store') }}" method="post">
        @csrf
        <div class="header-title row">
            <div class="col-lg-8 col-md-6 col-12 mb-3 header-left">
                <h3 class="title-content">Thêm danh mục phim</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('category.index') }}">Quản lý Danh mục phim</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Thêm danh mục phim
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
                        <a href="{{ route('category.index') }}">
                            <button type="button" class="btn-back">
                                <i class="fa-solid fa-arrow-left"></i>Quay về
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card ">
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
                            <label for="inputName">Tên danh mục</label>
                            <input type="text" id="inputName" class="form-control auto-focus" name="categoryName"
                                data-slug-source="category" required>
                        </div>
                        <div class="form-group">
                            <label>Slug<small class="note"><span class="required">*</span><span> (tự
                                        động)</span></small></label>
                            <input type="text" name="categorySlug" class="form-control" required
                                data-slug-target="category">
                        </div>
                        <div class="form-group">
                            <label for="inputDescription">Mô tả danh mục</label>
                            <textarea id="inputDescription" class="form-control" rows="4" name="categoryDescription"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="inputStatus">Trạng thái</label>
                            <select id="inputStatus" class="form-control custom-select" name="categoryStatus">
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

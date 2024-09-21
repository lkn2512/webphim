@extends('layouts.app')

@section('content')
    <form role="form" action="{{ route('category.index') }}" method="post">
        @csrf
        <div class="header-title row">
            <div class="col-lg-8 col-md-6 col-12 mb-3 header-left">
                <h3 class="title-content">Thêm danh mục phim</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ URL::to('Admin/dashboard') }}">Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ URL::to('Admin/all-category-product') }}">Danh mục phim</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Thêm danh mục phim
                    </li>
                </ol>
            </div>
            <div class="col-lg-4 col-md-6 col-12 mb-3 header-right">
                <div class="row justify-content-end">
                    <div class="col-lg-3 col-md-4 col-4">
                        <a href="{{ route('category.create') }}">
                            <button type="button" class="btn-refesh">
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
                <div class="card card-primary">
                    {{-- <div class="card-header">
                        <h3 class="card-title">Tổng quan</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div> --}}
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputName">Tên danh mục</label>
                            <input type="text" id="inputName" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="inputDescription">Mô tả danh mục</label>
                            <textarea id="inputDescription" class="form-control" rows="4"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="inputStatus">Trạng thái</label>
                            <select id="inputStatus" class="form-control custom-select">
                                <option selected>Hiển thị</option>
                                <option>Ẩn</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

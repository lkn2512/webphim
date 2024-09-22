@extends('layouts.app')

@section('content')
    <form role="form" action="{{ route('country.store') }}" method="post">
        @csrf
        <div class="header-title row">
            <div class="col-lg-8 col-md-6 col-12 mb-3 header-left">
                <h3 class="title-content">Thêm quốc gia</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('country.index') }}">Quản lý quốc gia</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Thêm quốc gia
                    </li>
                </ol>
            </div>
            <div class="col-lg-4 col-md-6 col-12 mb-3 header-right">
                <div class="row justify-content-end">
                    <div class="col-lg-3 col-md-4 col-4">
                        <a href="{{ route('country.create') }}">
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
                        <a href="{{ route('country.index') }}">
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
                            <label for="inputName">Tên quốc gia</label>
                            <input type="text" id="inputName" class="form-control auto-focus" name="countryName" required
                                data-slug-source="country">
                        </div>
                        <div class="form-group">
                            <label>Slug<small class="note"><span class="required">*</span><span> (tự
                                        động)</span></small></label>
                            <input type="text" name="countrySlug" class="form-control" required
                                data-slug-target="country">
                        </div>
                        <div class="form-group">
                            <label for="inputDescription">Mô tả quốc gia</label>
                            <textarea id="inputDescription" class="form-control" rows="4" name="countryDescription"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="inputStatus">Trạng thái</label>
                            <select id="inputStatus" class="form-control custom-select" name="countryStatus">
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

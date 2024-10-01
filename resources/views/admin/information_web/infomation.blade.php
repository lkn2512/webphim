@extends('layouts.app')

@section('content')
    <form role="form" action="{{ route('information.update', $information->id) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="header-title row">
            <div class="col-lg-8 col-md-6 col-sm-6 col-12 mb-3 header-left">
                <h3 class="title-content">Quản lý thông tin website</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Quản lý thông tin website
                    </li>
                </ol>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-3 header-right">
                <div class="row justify-content-end">
                    <div class="col-lg-3 col-md-3 col-sm-5 col-6">
                        <a href="">
                            <button type="button" class="btn-refesh" onclick="location.reload();">
                                <i class="fa-solid fa-arrows-rotate"></i>Tải lại
                            </button>
                        </a>
                    </div>
                    <div class="col-lg-5 col-md-6 col-sm-7 col-6">
                        <a href="">
                            <button type="submit" class="btn-add">
                                <i class="fa-solid fa-check"></i>Lưu thay đổi
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tổng quan</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputName">Tiêu đề website</label>
                            <input type="text" id="inputTitle" class="form-control" name="infoTitle" required
                                value="{{ $information->title }}">
                        </div>
                        <div class="form-group">
                            <label for="inputDescription">Mô tả website</label>
                            <textarea id="inputDescription" class="form-control" rows="4" name="infoDescription"> {{ $information->description }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Logo</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Logo website</label>
                            <input type="file" name="informationImage" class="form-control" accept="image/*">
                            <div class="bg-dark mt-3">
                                <img class="img-fluid "
                                    src="{{ asset('/uploads/informations_web/' . $information->logo) }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <span class="" style="opacity: 0.8;">
        Cập nhật lần cuối: {{ $information->updated_at->format('h:i, d-m-Y') }}
    </span>
@endsection

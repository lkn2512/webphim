@extends('layouts.app')

@section('content')
    <form role="form" action="{{ route('series.store') }}" method="post">
        @csrf
        <div class="header-title row">
            <div class="col-lg-8 col-md-6 col-12 mb-3 header-left">
                <h3 class="title-content">Tạo series</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('series.index') }}">Quản lý series phim</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Tạo series
                    </li>
                </ol>
            </div>
            <div class="col-lg-4 col-md-6 col-12 mb-3 header-right">
                <div class="row justify-content-end">
                    <div class="col-lg-3 col-md-4 col-4">
                        <a href="{{ route('series.create') }}">
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
                        <a href="{{ route('series.index') }}">
                            <button type="button" class="btn-back">
                                <i class="fa-solid fa-arrow-left"></i>Quay về
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12 col-12">
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
                            <label for="inputName">Tên series</label>
                            <input type="text" id="inputName" class="form-control auto-focus" name="seriesName" required>
                        </div>
                        <div class="form-group">
                            <label for="inputDescription">Mô tả series</label>
                            <textarea id="inputDescription" class="form-control" rows="4" name="seriesDescription"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header bg-dnb">
                        <h3 class="card-title">Danh sách các series</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="list-view">
                            @foreach ($series as $ser)
                                <span class="list-item"> {{ $ser->title }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="other-options">
                    <span class="title">Bạn muốn thêm mới một phim?</span>
                    <a href="{{ route('movie.create') }}" class="link">Thêm phim</a>
                </div>
            </div>
        </div>
    </form>
@endsection

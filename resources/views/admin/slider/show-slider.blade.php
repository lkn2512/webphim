@extends('layouts.app')

@section('content')
    <div class="header-title row">
        <div class="col-lg-8 col-md-6 col-sm-6 col-12 mb-3 header-left">
            <h3 class="title-content">Quản lý slider</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Trang chủ</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Quản lý slider
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
                    <a href="{{ route('slider.create') }}">
                        <button type="button" class="btn-add">
                            <i class="fa-solid fa-plus"></i>Thêm slider
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-hover align-middle table-bordered" id="example1">
        @php $i = 1; @endphp
        <thead>
            <tr>
                <th>STT</th>
                <th>Slider</th>
                <th>Tiêu đề</th>
                <th>Mô tả</th>
                <th>Phim liên kết</th>
                <th>Trạng thái</th>
                <th>Tác vụ</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allSlider as $value)
                <tr id="slider-row-{{ $value->id }}">
                    <td>{{ $i++ }}</td>
                    <td> <img class="img-slider" src="{{ asset('uploads/slider/' . $value->image) }}"
                            alt="{{ $value->title }}"></td>
                    <td>{{ $value->title }}</td>
                    <td>{{ $value->description }}</td>
                    <td> <a href="{{ route('movie.edit', $value->movie->id) }}" title="Cập nhật phim"><i
                                class="fa-solid fa-film"></i>
                            {{ $value->movie->title }}</a></td>
                    <td>
                        <button type="button" class="toggle-status btn {{ $value->status == 1 ? 'active' : '' }}"
                            data-id="{{ $value->id }}" data-active-url="{{ URL::to('slider/active/' . $value->id) }}"
                            data-inactive-url="{{ URL::to('slider/unactive/' . $value->id) }}" data-toggle="tooltip"
                            data-placement="top" title="{{ $value->status == 1 ? 'Hiển thị' : 'Ẩn' }}">
                        </button>
                    </td>
                    <td>
                        <a href="{{ route('slider.edit', $value->id) }}" class="btn-edit" title="Chỉnh sửa">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                        <a href="javascript:void(0);" class="btn-remove" data-id="{{ $value->id }}" data-type="slider"
                            data-confirm-message="Bạn có chắc là muốn xoá slider này?"onclick="deleteItem(this)"
                            title="Xoá">
                            <i class="fa-solid fa-xmark"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

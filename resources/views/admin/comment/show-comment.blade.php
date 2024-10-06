@extends('layouts.app')

@section('content')
    <div class="header-title row">
        <div class="col-lg-8 col-md-6 col-sm-6 col-12 mb-3 header-left">
            <h3 class="title-content">Quản lý bình luận</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Trang chủ</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Quản lý bình luận
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
            </div>
        </div>
    </div>

    <table class="table table-hover align-middle table-bordered" id="example1">
        @php $i = 1; @endphp
        <thead>
            <tr>
                <th>STT</th>
                <th>Địa chỉ IP</th>
                <th>Tên</th>
                <th>Nội dung</th>
                <th>Vào lúc</th>
                <th>Phim</th>
                <th>Trạng thái</th>
                <th>Tác vụ</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($comments as $value)
                <tr id="comment-row-{{ $value->id }}">
                    <td>{{ $i++ }}</td>
                    <td>{{ $value->ip_address }}</td>
                    <td>{{ $value->author }}</td>
                    <td>{{ $value->content }}</td>
                    <td>{{ $value->created_at->diffForHumans() }}</td>
                    <td><a href="{{ URL::to('phim/' . $value->movie->slug) }}"
                            target="d_blank">{{ $value->movie->title }}</span> phim</a>
                    <td>
                        <button type="button" class="toggle-status btn {{ $value->status == 1 ? 'active' : '' }}"
                            data-id="{{ $value->id }}" data-active-url="{{ URL::to('comment/active/' . $value->id) }}"
                            data-inactive-url="{{ URL::to('comment/unactive/' . $value->id) }}" data-toggle="tooltip"
                            data-placement="top" title="{{ $value->status == 1 ? 'Hiển thị' : 'Ẩn' }}">
                        </button>
                    </td>
                    <td>
                        <a href="javascript:void(0);" class="btn-remove" data-id="{{ $value->id }}" data-type="comment"
                            data-confirm-message="Bạn có chắc là muốn xoá bình luận này?"onclick="deleteItem(this)"
                            title="Xoá">
                            <i class="fa-solid fa-xmark"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

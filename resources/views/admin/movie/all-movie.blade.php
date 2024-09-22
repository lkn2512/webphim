@extends('layouts.app')

@section('content')
    <div class="header-title row">
        <div class="col-lg-8 col-md-6 col-sm-6 col-12 mb-3 header-left">
            <h3 class="title-content">Quản lý phim</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Trang chủ</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Quản lý phim
                </li>
            </ol>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-3 header-right">
            <div class="row justify-content-end">
                <div class="col-lg-3 col-md-3 col-sm-5 col-6">
                    <a href="{{ route('movie.index') }}">
                        <button type="button" class="btn-refesh">
                            <i class="fa-solid fa-arrows-rotate"></i>Tải lại
                        </button>
                    </a>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-7 col-6">
                    <a href="{{ route('movie.create') }}">
                        <button type="button" class="btn-add">
                            <i class="fa-solid fa-plus"></i>Thêm phim
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
                <th>Hỉnh ảnh</th>
                <th>Tên phim</th>
                <th>Slug</th>
                <th>Mô tả chi tiết</th>
                <th>Danh mục</th>
                <th>Thể loại</th>
                <th>Quốc gia</th>
                <th>Trạng thái</th>
                <th>Tác vụ</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listMovie as $value)
                <tr id="movie-row-{{ $value->id }}">
                    <td>{{ $i++ }}</td>
                    <td>
                        <img class="img-movie zoom-in" src="{{ asset('uploads/movies/' . $value->image) }}" alt=""
                            data-bs-toggle="modal" data-bs-target="#imageModal" onclick="setModalImage(this)">
                    </td>

                    <td>{{ $value->title }}</td>
                    <td>{{ $value->slug }}</td>
                    <td class="text-auto"></td>
                    <td>
                        @foreach ($value->categories as $cate_movie)
                            {{ $cate_movie->title }}<br>
                            {{-- {{ !$loop->last ? ', ' : '' }} --}}
                        @endforeach
                    </td>
                    <td>
                        @foreach ($value->genres as $gen_movie)
                            {{ $gen_movie->title }}<br>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($value->countries as $count_movie)
                            {{ $count_movie->title }}<br>
                        @endforeach
                    </td>
                    <td>
                        <button type="button" class="toggle-status btn {{ $value->status == 1 ? 'active' : '' }}"
                            data-id="{{ $value->id }}" data-active-url="{{ URL::to('movie/active/' . $value->id) }}"
                            data-inactive-url="{{ URL::to('movie/unactive/' . $value->id) }}" data-toggle="tooltip"
                            data-placement="top" title="{{ $value->status == 1 ? 'Hiển thị' : 'Ẩn' }}">
                        </button>
                    </td>
                    <td>
                        <a href="javascript:void(0);" class="btn-edit" data-bs-toggle="modal" data-bs-target="#exampleModal"
                            data-id="{{ $value->id }}" data-title="{{ $value->title }}"
                            data-slug="{{ $value->slug }}" data-description="{{ $value->description }}"
                            data-status="{{ $value->status }}" title="Chỉnh sửa">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                        <a href="javascript:void(0);" class="btn-remove" data-id="{{ $value->id }}" data-type="movie"
                            data-confirm-message="Sau khi xoá danh mục này, tất cả phim liên quan cũng sẽ bị xoá. Bạn có chắc là muốn xoá?"onclick="deleteItem(this)"
                            title="Xoá">
                            <i class="fa-solid fa-xmark"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <!-- Modal phóng to hình ảnh -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content "style=" margin:85px">
                <div class="modal-body">
                    <img id="modalImage" alt="Hình ảnh phóng to">
                </div>
            </div>
        </div>
    </div>
    <script>
        function setModalImage(img) {
            var modalImg = document.getElementById("modalImage");
            modalImg.src = img.src;
        }
    </script>
@endsection

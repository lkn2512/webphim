@extends('layouts.app')

@section('content')
    <div class="header-title row">
        <div class="col-lg-8 col-md-6 col-sm-6 col-12 mb-3 header-left">
            <h3 class="title-content">Quản lý series phim</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Trang chủ</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Quản lý series phim
                </li>
            </ol>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-3 header-right">
            <div class="row justify-content-end">
                <div class="col-lg-3 col-md-3 col-sm-5 col-6">
                    <a href="{{ route('series.index') }}">
                        <button type="button" class="btn-refesh">
                            <i class="fa-solid fa-arrows-rotate"></i>Tải lại
                        </button>
                    </a>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-7 col-6">
                    <a href="{{ route('series.create') }}">
                        <button type="button" class="btn-add">
                            <i class="fa-solid fa-plus"></i>Tạo series
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
                <th>Tên series</th>
                <th>Mô tả chi tiết</th>
                <th>Số phần</th>
                <th>Phim</th>
                <th>Tác vụ</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allseries as $value)
                <tr id="series-row-{{ $value->id }}">
                    <td>{{ $i++ }}</td>
                    <td>{{ $value->title }}</td>
                    <td>{!! $value->description !!}</td>
                    <td>{{ $value->movies_count }} phần</td>
                    <td>
                        @foreach ($value->movies as $movie)
                            {{ $movie->title }} <br>
                        @endforeach
                        {{-- <span class="text-danger">{{ $value->movies_count }} phần</span> --}}
                    </td>
                    <td>
                        <a href="javascript:void(0);" class="btn-edit" data-bs-toggle="modal" data-bs-target="#exampleModal"
                            data-id="{{ $value->id }}"
                            data-title="{{ $value->title }}"data-description="{{ $value->description }}" title="Chỉnh sửa">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                        <a href="javascript:void(0);" class="btn-remove" data-id="{{ $value->id }}" data-type="series"
                            data-confirm-message="Sau khi xoá series này, tất cả phim liên quan cũng sẽ bị xoá. Bạn có chắc là muốn xoá?"onclick="deleteItem(this)"
                            title="Xoá">
                            <i class="fa-solid fa-xmark"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Chỉnh sửa series phim</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="seriesForm">
                        <input type="hidden" id="seriesId" name="seriesId">
                        @csrf
                        <div class="form-group">
                            <label for="inputName">Tên series</label>
                            <input type="text" id="inputName" class="form-control" name="seriesName" required
                                data-slug-source="series">
                        </div>
                        <div class="form-group">
                            <label for="inputDescription">Mô tả series</label>
                            <textarea id="inputDescription" class="form-control" rows="4" name="seriesDescription"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
                            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('edit-series-JS')
        <script>
            $(document).ready(function() {
                $('.btn-edit').on('click', function() {
                    // Lấy dữ liệu từ thuộc tính data
                    const seriesTitle = $(this).data('title');
                    const seriesDescription = $(this).data('description');

                    // Điền dữ liệu vào các trường trong modal
                    $('#inputName').val(seriesTitle);
                    $('#inputDescription').val(seriesDescription);
                });
            });
        </script>

        {{-- Thực hiện cập nhật --}}
        <script>
            $(document).ready(function() {
                $('.btn-edit').on('click', function() {
                    const seriesId = $(this).data('id');

                    $.ajax({
                        url: `/series/${seriesId}/edit`,
                        method: 'GET',
                        success: function(data) {
                            $('#seriesId').val(data.id);
                            $('#inputName').val(data.title);
                            $('#inputDescription').val(data.description);
                        },
                        error: function() {
                            alert('Không thể lấy thông tin series.');
                        }
                    });
                });

                $('#seriesForm').on('submit', function(e) {
                    e.preventDefault();
                    const seriesId = $('#seriesId').val();

                    $.ajax({
                        url: `/series/${seriesId}`,
                        method: 'PUT',
                        data: $(this).serialize(),
                        success: function(response) {
                            // Lưu thông điệp vào localStorage
                            localStorage.setItem('toastMessage', response.message);
                            location.reload();
                        },
                        error: function() {
                            alert('Có lỗi xảy ra trong quá trình cập nhật.');
                        }
                    });
                });
                // Kiểm tra localStorage sau khi trang tải xong
                window.onload = function() {
                    const message = localStorage.getItem('toastMessage');
                    if (message) {
                        iziToast.success({
                            message: message,
                        });
                        localStorage.removeItem('toastMessage');
                    }
                };
            });
        </script>
    @endpush
@endsection

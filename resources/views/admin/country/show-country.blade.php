@extends('layouts.app')

@section('content')
    <div class="header-title row">
        <div class="col-lg-8 col-md-6 col-sm-6 col-12 mb-3 header-left">
            <h3 class="title-content">Quản lý quốc gia</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Trang chủ</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Quản lý quốc gia
                </li>
            </ol>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-3 header-right">
            <div class="row justify-content-end">
                <div class="col-lg-3 col-md-3 col-sm-5 col-6">
                    <a href="{{ route('country.index') }}">
                        <button type="button" class="btn-refesh">
                            <i class="fa-solid fa-arrows-rotate"></i>Tải lại
                        </button>
                    </a>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-7 col-6">
                    <a href="{{ route('country.create') }}">
                        <button type="button" class="btn-add">
                            <i class="fa-solid fa-plus"></i>Thêm quốc gia
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
                <th>Tên quốc gia</th>
                <th>slug</th>
                <th>Mô tả chi tiết</th>
                <th>Phim</th>
                <th>Trạng thái</th>
                <th>Tác vụ</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allcountry as $value)
                <tr id="country-row-{{ $value->id }}">
                    <td>{{ $i++ }}</td>
                    <td>{{ $value->title }}</td>
                    <td>{{ $value->slug }}</td>
                    <td class="text-auto">{{ $value->description }}</td>
                    <td><span class="text-danger">{{ $value->movies_count }}</span> phim</td>
                    <td>
                        <button type="button" class="toggle-status btn {{ $value->status == 1 ? 'active' : '' }}"
                            data-id="{{ $value->id }}" data-active-url="{{ URL::to('country/active/' . $value->id) }}"
                            data-inactive-url="{{ URL::to('country/unactive/' . $value->id) }}" data-toggle="tooltip"
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
                        <a href="javascript:void(0);" class="btn-remove" data-id="{{ $value->id }}" data-type="country"
                            data-confirm-message="Sau khi xoá quốc gia này, tất cả phim liên quan cũng sẽ bị xoá. Bạn có chắc là muốn xoá?"onclick="deleteItem(this)"
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Chỉnh sửa quốc gia</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="countryForm">
                        <input type="hidden" id="countryId" name="countryId">
                        @csrf
                        <div class="form-group">
                            <label for="inputName">Tên quốc gia</label>
                            <input type="text" id="inputName" class="form-control" name="countryName"required
                                data-slug-source="country">
                        </div>
                        <div class="form-group">
                            <label>Slug<small class="note">(tự động)</small></label>
                            <input type="text" name="countrySlug" id="inputSlug" class="form-control" required
                                data-slug-target="country">
                        </div>
                        <div class="form-group">
                            <label for="inputDescription">Mô tả quốc gia</label>
                            <textarea id="inputDescription" class="form-control" rows="4" name="countryDescription"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="inputStatus">Trạng thái</label>
                            <select id="inputStatus" class="form-control custom-select" name="countryStatus">
                                <option value="1">Hiển thị</option>
                                <option value="0">Ẩn</option>
                            </select>
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

    @push('edit-country-JS')
        <script>
            $(document).ready(function() {
                $('.btn-edit').on('click', function() {
                    // Lấy dữ liệu từ thuộc tính data
                    const countryTitle = $(this).data('title');
                    const countrySlug = $(this).data('slug');
                    const countryDescription = $(this).data('description');
                    const countryStatus = $(this).data('status');

                    // Điền dữ liệu vào các trường trong modal
                    $('#inputName').val(countryTitle);
                    $('#inputSlug').val(countrySlug);
                    $('#inputDescription').val(countryDescription);
                    $('#inputStatus').val(countryStatus);
                });
            });
        </script>

        {{-- Thực hiện cập nhật --}}
        <script>
            $(document).ready(function() {
                $('.btn-edit').on('click', function() {
                    const countryId = $(this).data('id');

                    $.ajax({
                        url: `/country/${countryId}/edit`,
                        method: 'GET',
                        success: function(data) {
                            $('#countryId').val(data.id);
                            $('#inputName').val(data.title);
                            $('#inputSlug').val(data.slug);
                            $('#inputDescription').val(data.description);
                            $('#inputStatus').val(data.status);
                        },
                        error: function() {
                            alert('Không thể lấy thông tin quốc gia.');
                        }
                    });
                });

                $('#countryForm').on('submit', function(e) {
                    e.preventDefault();
                    const countryId = $('#countryId').val();

                    $.ajax({
                        url: `/country/${countryId}`,
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
                        // Xóa thông điệp để tránh hiển thị lại khi tải lại trang
                        localStorage.removeItem('toastMessage');
                    }
                };
            });
        </script>
    @endpush
@endsection

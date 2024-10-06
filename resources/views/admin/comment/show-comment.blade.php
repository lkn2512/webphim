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
    <button id="delete-selected" class="btn btn-danger mb-3"><i class="fa-regular fa-trash-can"></i> Xoá nhiều bình
        luận</button>
    <table class="table table-hover align-middle table-bordered" id="example1">
        <thead>
            <tr>
                <th>
                    <input type="checkbox" id="select-all" />
                </th>
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
                    <td>
                        <input type="checkbox" class="comment-checkbox" data-id="{{ $value->id }}" />
                    </td>
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
                            data-confirm-message="Bạn có chắc là muốn xoá bình luận này?" onclick="deleteItem(this)"
                            title="Xoá">
                            <i class="fa-solid fa-xmark"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @push('delete-select-comment-JS')
        <script>
            $(document).ready(function() {
                // Xoá nhiều bình luận
                $('#delete-selected').on('click', function() {
                    let ids = [];
                    $('.comment-checkbox:checked').each(function() {
                        ids.push($(this).data('id'));
                    });

                    if (ids.length === 0) {
                        alert('Vui lòng chọn ít nhất một bình luận')
                        return;
                    }

                    var token = $('meta[name="csrf-token"]').attr('content');
                    var confirmMessage = 'Bạn có chắc chắn muốn xoá ' + ids.length + ' bình luận này?';

                    if (confirm(confirmMessage)) {
                        $.ajax({
                            url: '/comment/delete-multiple',
                            type: 'POST',
                            data: {
                                _token: token,
                                ids: ids,
                            },
                            success: function(response) {
                                if (response.status === 'success') {
                                    ids.forEach(function(id) {
                                        $('#comment-row-' + id).remove();
                                        iziToast.success({
                                            message: 'Một bình luận đã bị xoá.',
                                        });
                                    });
                                    ids.forEach(function(id) {
                                        $('#comment-row-' + id).remove();
                                    });
                                } else {
                                    iziToast.error({
                                        message: response.message,
                                    });
                                }
                            },
                            error: function(xhr) {
                                iziToast.error({
                                    message: 'Đã xảy ra lỗi khi xoá',
                                });
                            }
                        });
                    }
                });

                // Chọn tất cả checkbox
                $('#select-all').on('change', function() {
                    $('.comment-checkbox').prop('checked', this.checked);
                });
            });
        </script>
    @endpush
@endsection

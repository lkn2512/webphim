@extends('layouts.app')

@section('content')
    <div class="header-title row">
        <div class="col-lg-8 col-md-6 col-sm-6 col-12 mb-3 header-left">
            <h3 class="title-content">Quản lý tập phim</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Trang chủ</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('movie.index') }}">Phim</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('episode.index') }}">Quản lý tập phim</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Danh sách các tập phim
                </li>
            </ol>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-3 header-right">
            <div class="row justify-content-end">
                <div class="col-lg-4 col-md-4 col-sm-5 col-6">
                    <a href="{{ route('episode.index') }}">
                        <button type="button" class="btn-refesh">
                            <i class="fa-solid fa-arrow-rotate-left"></i>Xoá lựa chọn
                        </button>
                    </a>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-5 col-6">
                    <a href="{{ route('episode.create') }}">
                        <button type="button" class="btn-add">
                            <i class="fa-solid fa-plus"></i>Thêm tập
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <form method="POST" action="{{ route('episode.showEpisodes') }}">
        @csrf
        <div class="card">
            <div class="card-header bg-dnb">
                <h3 class="card-title">Danh sách phim</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-10 col-md-10 col-sm-8 col-8">
                        <div class="form-group">
                            <select id="inputMovie" class="form-control  select2" name="selectedMovie" required>
                                <option selected disabled>-- Chọn phim --</option>
                                @foreach ($listMovie as $listM)
                                    <option value="{{ $listM->id }}"
                                        {{ old('selectedMovie', $selectedMovie ?? '') == $listM->id ? 'selected' : '' }}>
                                        {{ $listM->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-4 col-4">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Chọn</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="card">
        <div class="card-body">
            <div class="flex-center-between">
                <h5 class="fw-bold">Danh sách tập phim</h5>
                <span class="note">Có thể chỉnh sửa trực tiếp</span>
            </div>
            <div class="note-container">
                <h2 class="note-title">Ghi Chú</h2>
                <li>- Nếu là phim lẻ, ghi là "Full"</li>
                <li>- Nếu là phim bộ, ghi là "Tập + số". Ví dụ: Tập 2</li>
            </div>
            @if ($episodes->isEmpty())
                <span>Hiện không có tập phim nào.</span>
            @else
                <table class="table table-hover align-middle table-bordered">
                    <thead>
                        <tr>
                            <th>Tập</th>
                            <th>Link</th>
                            <th>Thời lượng</th>
                            <th>Mô tả</th>
                            <th>Trạng thái</th>
                            <th>Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($episodes as $value)
                            <tr id="episode-row-{{ $value->id }}">
                                <td class="editable" data-field="episode_number" data-id="{{ $value->id }}">
                                    {{ $value->episode_number }}
                                </td>
                                <td class="editable" data-field="link" data-id="{{ $value->id }}">
                                    {{ $value->link }}
                                </td>
                                <td class="editable" data-field="duration" data-id="{{ $value->id }}">
                                    {{ $value->duration }}
                                </td>
                                <td class="editable" data-field="description" data-id="{{ $value->id }}">
                                    {{ $value->description }}
                                </td>
                                <td>
                                    <button type="button"
                                        class="toggle-status btn {{ $value->status == 1 ? 'active' : '' }}"
                                        data-id="{{ $value->id }}"
                                        data-active-url="{{ URL::to('episode/active/' . $value->id) }}"
                                        data-inactive-url="{{ URL::to('episode/unactive/' . $value->id) }}"
                                        data-toggle="tooltip" data-placement="top"
                                        title="{{ $value->status == 1 ? 'Hiển thị' : 'Ẩn' }}">
                                    </button>
                                </td>
                                <td>
                                    <a href="javascript:void(0);" class="btn-remove" data-id="{{ $value->id }}"
                                        data-type="episode" data-confirm-message="Bạn có chắc là muốn xoá tập này?"
                                        onclick="deleteItem(this)" title="Xoá">
                                        <i class="fa-solid fa-xmark"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
    @push('movie-episode-JS')
        <script>
            $(document).ready(function() {
                $('.editable').on('click', function() {
                    const currentElement = $(this);
                    const currentValue = currentElement.text().trim();
                    const field = currentElement.data('field');
                    const id = currentElement.data('id');

                    // Tạo một input field để chỉnh sửa
                    const input = $('<input>', {
                        type: 'text',
                        value: currentValue,
                        class: 'form-control',
                        blur: function() {
                            const newValue = $(this).val();
                            $.ajax({
                                url: `/episode/${id}`,
                                type: 'PATCH',
                                data: {
                                    [field]: newValue,
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(response) {
                                    // Cập nhật giá trị trong <td>
                                    currentElement.text(newValue);
                                    iziToast.success({
                                        message: response.message
                                    });
                                },
                                error: function(xhr) {
                                    // Lấy thông báo lỗi từ phản hồi
                                    let errorMessage = 'Đã có lỗi xảy ra!';
                                    if (xhr.responseJSON && xhr.responseJSON.message) {
                                        errorMessage = xhr.responseJSON.message;
                                    }
                                    alert(errorMessage);
                                }
                            });
                        }
                    });

                    // Thay thế nội dung của <td> bằng input field
                    currentElement.empty().append(input);
                    input.focus(); // Tự động focus vào input
                });
            });
        </script>
    @endpush
@endsection

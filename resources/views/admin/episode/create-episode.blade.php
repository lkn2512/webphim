@extends('layouts.app')

@section('content')
    <form id="episodeForm" role="form" method="post">
        @csrf
        <div class="header-title row">
            <div class="col-lg-8 col-md-6 col-12 mb-3 header-left">
                <h3 class="title-content">Thêm tập phim</h3>
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
                        Thêm tập phim
                    </li>
                </ol>
            </div>
            <div class="col-lg-4 col-md-6 col-12 mb-3 header-right">
                <div class="row justify-content-end">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                        <a href="">
                            <button type="button" class="btn-refesh" onclick="location.reload();">
                                <i class="fa-solid fa-arrows-rotate"></i>Tải lại
                            </button>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                        <button type="submit" class="btn-add" id="submitBtn">
                            <i class="fa-solid fa-plus"></i>Thêm
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="note-container">
            <h2 class="note-title">Ghi Chú</h2>
            <li>- Nếu là phim lẻ, ghi là "Full"</li>
            <li>- Nếu là phim bộ, ghi là "Tập + số". Ví dụ: Tập 2</li>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
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
                            <label for="inputMoive">Phim</label>
                            <select id="inputMoive" class="form-control custom-select select2" name="episodeMoive" required>
                                <option selected value="0">--Chọn phim--</option>
                                @foreach ($listMovie as $listM)
                                    <option value="{{ $listM->id }}">{{ $listM->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputNumber">Tập</label>
                            <input type="text" id="inputNumber" class="form-control" name="episodeNumber" required
                                placeholder="Nhập vào số tập">
                        </div>
                        <div class="form-group">
                            <label for="inputLink">Link phim</label>
                            <input type="text" id="inputLink" class="form-control" name="episodeLink" required
                                placeholder="Nhập vào link phim">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="card">
                    <div class="card-header bg-dnb">
                        <h3 class="card-title">Thông tin khác</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputDuration">Thời lượng</label>
                            <input type="text" id="inputDuration" class="form-control" placeholder="Thời lượng một tập"
                                name="episodeDuration" required>
                        </div>
                        <div class="form-group">
                            <label for="inputDescription">Mô tả ngắn</label>
                            <textarea id="inputDescription" class="form-control" rows="2" name="episodeDescription"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="inputStatus">Trạng thái</label>
                            <select id="inputStatus" class="form-control custom-select" name="episodeStatus" required>
                                <option selected value="1">Hiển thị</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @push('create-episode-JS')
        <script>
            $(document).ready(function() {
                $('#episodeForm').on('submit', function(e) {
                    e.preventDefault(); // Ngăn không cho form reload trang

                    var formData = $(this).serialize(); // Lấy tất cả dữ liệu trong form
                    $.ajax({
                        url: "{{ route('episode.store') }}",
                        type: 'POST',
                        data: formData,
                        success: function(response) {
                            if (response.status === 'success') {
                                iziToast.success({
                                    message: response.message,
                                });
                                // Có thể clear các input sau khi thêm thành công nếu cần
                                // $('#episodeForm')[0].reset();
                            }
                        },
                        error: function(response) {
                            console.log(response.responseText); // Xem chi tiết lỗi trong console
                            if (response.status === 422) {
                                var errors = response.responseJSON.errors;
                                var errorMessage = '';
                                for (var key in errors) {
                                    if (errors.hasOwnProperty(key)) {
                                        errorMessage += errors[key] + '\n';
                                    }
                                }
                                alert(errorMessage);
                            } else if (response.status === 500) {
                                alert('Internal Server Error: ' + response.responseText);
                            } else if (response.status === 409) {
                                alert(response.responseJSON.message);
                            }
                        }
                    });
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                // Hàm kiểm tra giá trị select
                function toggleFormInputs() {
                    var selectedValue = $('#inputMoive').val();
                    if (selectedValue === "0") {
                        // Disable tất cả các input và nút submit, trừ #inputMoive
                        $('#episodeForm :input:not(#inputMoive)').prop('disabled', true);
                    } else {
                        // Enable tất cả các input và nút submit, trừ #inputMoive
                        $('#episodeForm :input:not(#inputMoive)').prop('disabled', false);
                    }
                }
                // Gọi hàm kiểm tra khi trang được load
                toggleFormInputs();

                // Gọi lại hàm kiểm tra mỗi khi chọn option mới
                $('#inputMoive').on('change', function() {
                    toggleFormInputs();
                });
            });
        </script>
    @endpush
@endsection

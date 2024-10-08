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
                    <a href="">
                        <button type="button" class="btn-refesh" onclick="location.reload();">
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
                <th>Tổng tập</th>
                <th>Thuộc series</th>
                <th>Danh mục</th>
                <th>Thể loại</th>
                <th>Quốc gia</th>
                <th>Năm phát hành</th>
                <th>Phiên dịch</th>
                <th>Tình trạng</th>
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
                    <td>{{ $value->title }}
                        {{-- <br>{{ $value->sub_title }} --}}
                    </td>
                    <td>
                        <form action="{{ route('episode.showEpisodes') }}" method="POST" style="display: inline;">
                            @csrf
                            <input type="hidden" name="selectedMovie" value="{{ $value->id }}">
                            <button type="submit" class="btn btn-link p-0">{{ $value->episodes_count }} tập</button>
                        </form>
                    </td>
                    </td>
                    <td>{{ $value->series ? $value->series->title : 'Không có' }}</td>
                    <td>
                        @foreach ($value->categories as $cate_movie)
                            {{ $cate_movie->title }}{{ !$loop->last ? ', ' : '' }}
                        @endforeach
                    </td>
                    <td>
                        @foreach ($value->genres as $gen_movie)
                            {{ $gen_movie->title }}{{ !$loop->last ? ', ' : '' }}
                        @endforeach
                    </td>
                    <td>
                        @foreach ($value->countries as $count_movie)
                            {{ $count_movie->title }}{{ !$loop->last ? ', ' : '' }}
                        @endforeach
                    </td>
                    <td>
                        @if ($value->release_year > 0)
                            {{ $value->release_year }}
                        @else
                            Chưa có
                        @endif
                    </td>
                    <td>
                        @php
                            $translations = [
                                0 => 'Không có',
                                1 => 'Vietsub',
                                2 => 'Thuyết minh',
                                3 => 'Lồng tiếng',
                            ];
                        @endphp
                        {{ $translations[$value->translation] ?? 'Không có' }}
                    </td>

                    <td>
                        @if ($value->completion_status == 0)
                            <span class="text-secondary">Đang cập nhật</span>
                        @elseif($value->completion_status == 1)
                            <span class="text-success">Hoàn thành</span>
                        @else
                            <span class="text-danger">Tạm dừng</span>
                        @endif
                    </td>
                    <td>
                        <button type="button" class="toggle-status btn {{ $value->status == 1 ? 'active' : '' }}"
                            data-id="{{ $value->id }}" data-active-url="{{ URL::to('movie/active/' . $value->id) }}"
                            data-inactive-url="{{ URL::to('movie/unactive/' . $value->id) }}" data-toggle="tooltip"
                            data-placement="top" title="{{ $value->status == 1 ? 'Hiển thị' : 'Ẩn' }}">
                        </button>
                    </td>
                    <td>
                        <a href="{{ route('movie.edit', $value->id) }}" class="btn-edit" title="Chỉnh sửa">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                        <a href="javascript:void(0);" class="btn-remove" data-id="{{ $value->id }}" data-type="movie"
                            data-confirm-message="Bạn có chắc là muốn xoá phim này?"onclick="deleteItem(this)"
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
                    <img id="modalImage" alt="Hình ảnh phóng to" class="img-modal-zoom">
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

    @push('view-movie-episode-JS')
        <script>
            function sendData(selectedMovie) {
                // Kiểm tra nếu người dùng có chắc chắn không (tùy chọn)
                if (confirm('Bạn có chắc chắn muốn xem tập phim này?')) {
                    fetch("{{ route('episode.showEpisodes') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                selectedMovie: selectedMovie
                            })
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Mạng lỗi');
                            }
                            return response.json();
                        })
                        .then(data => {
                            // Xử lý dữ liệu trả về (nếu cần)
                            console.log(data);
                            // Có thể chuyển hướng đến trang mới nếu cần
                            window.location.href = data.redirect; // nếu bạn trả về URL chuyển hướng trong JSON
                        })
                        .catch(error => {
                            console.error('Có lỗi:', error);
                        });
                }
            }
        </script>
    @endpush
@endsection

@extends('layouts.app')

@section('content')
    <div class="header-title row">
        <div class="col-lg-8 col-md-6 col-sm-6 col-12 mb-3 header-left">
            <h3 class="title-content">Danh sác các tập phim của: {{ $movie->title }}</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Trang chủ</a>
                </li>
                {{-- <li class="breadcrumb-item">
                    <a href="{{ route('movie.index') }}">Danh sách phim</a>
                </li> --}}
                <li class="breadcrumb-item active" aria-current="page">Danh sách tập phim</li>
            </ol>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-3 header-right">
            <div class="row justify-content-end">
                <div class="col-lg-3 col-md-4 col-4">
                    <a href="">
                        <button type="button" class="btn-refesh" onclick="location.reload();">
                            <i class="fa-solid fa-arrows-rotate"></i>Tải lại
                        </button>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4 col-4">
                    <a href="{{ route('episode.create', ['movie_id' => $movie->id]) }}">
                        <button type="button" class="btn-add">
                            <i class="fa-solid fa-plus"></i>Thêm tập
                        </button>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4 col-4">
                    <a href="{{ route('movie.index') }}">
                        <button type="button" class="btn-back">
                            <i class="fa-solid fa-arrow-left"></i>Quay về
                        </button>
                    </a>
                </div>
            </div>

        </div>
    </div>

    <table class="table table-hover align-middle table-bordered">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tập</th>
                <th>Link phim</th>
                <th>Mô tả</th>
                <th>Thời lượng</th>
                <th>Trạng thái</th>
                <th>Tác vụ</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach ($episodes as $key => $episode)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $episode->title }}</td>
                    <td>{{ $episode->slug }}</td>
                    <td>{{ $episode->description }}</td>
                    <td>
                        @if ($episode->status == 1)
                            <span class="badge bg-success">Hiển thị</span>
                        @else
                            <span class="badge bg-danger">Ẩn</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('episode.edit', $episode->id) }}" class="btn btn-warning btn-sm">
                            <i class="fa-solid fa-pen"></i> Chỉnh sửa
                        </a>
                        <form action="{{ route('episode.destroy', $episode->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Bạn có chắc chắn muốn xoá tập này?')">
                                <i class="fa-solid fa-trash"></i> Xoá
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach --}}
        </tbody>
    </table>
@endsection

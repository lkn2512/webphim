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
                <li class="breadcrumb-item active" aria-current="page">
                    Quản lý tập phim
                </li>
            </ol>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-3 header-right">
            <div class="row justify-content-end">
                <div class="col-lg-3 col-md-3 col-sm-5 col-6">
                    <a href="{{ route('episode.index') }}">
                        <button type="button" class="btn-refesh">
                            <i class="fa-solid fa-arrows-rotate"></i>Tải lại
                        </button>
                    </a>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-7 col-6">
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
                <h3 class="card-title">Phim</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-10 col-md-8 col-sm-8 col-8">
                        <div class="form-group">
                            <select id="inputMovie" class="form-control custom-select select2" name="selectedMovie"
                                required>
                                <option selected>-- Chọn phim --</option>
                                @foreach ($listMovie as $listM)
                                    <option value="{{ $listM->id }}"
                                        {{ old('selectedMovie', $selectedMovie ?? '') == $listM->id ? 'selected' : '' }}>
                                        {{ $listM->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-4 col-4">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Chọn</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

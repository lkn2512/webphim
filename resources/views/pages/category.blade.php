@extends('layout')
@section('content')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb" class="breadcrumb-container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('trang-chu') }}">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page"> {{ $nameCategory->title }}</li>
        </ol>
    </nav>
    <div class="row mt-4">
        <div class="col-lg-9 col-md-9 col-sm-9 col-12">
            <h1 class="title-section">
                {{ $nameCategory->title }}
            </h1>
            <div class="row">
                <div class="col-4 col-lg-3 col-md-4 col-sm-6 mb-3">
                    <div class="card-film">
                        <span class="episode">Tập 10</span>
                        <img class="img" src="{{ asset('FrontEnd/Image/phim.jpg') }}" alt="Image">
                        <div class="card-film-body">
                            <h5 class="title">Đại Chúa Tể</h5>
                            <span class="decs">Sword Art Online</span>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-lg-3 col-md-4 col-sm-6 mb-3">
                    <div class="card-film">
                        <span class="episode">Tập 10</span>
                        <img class="img" src="{{ asset('FrontEnd/Image/phim.jpg') }}" alt="Image">
                        <div class="card-film-body">
                            <h5 class="title">Phàm nhân tu tiên</h5>
                            <span class="decs">Sword Art Online</span>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-lg-3 col-md-4 col-sm-6  mb-3">
                    <div class="card-film">
                        <span class="episode">Tập 10</span>
                        <img class="img" src="{{ asset('FrontEnd/Image/phim.jpg') }}" alt="Image">
                        <div class="card-film-body">
                            <h5 class="title">Đại Chúa Tể Đại thời đại</h5>
                            <span class="decs">Sword Art Online</span>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-lg-3 col-md-4 col-sm-6 mb-3">
                    <div class="card-film">
                        <span class="episode">Tập 10</span>
                        <img class="img" src="{{ asset('FrontEnd/Image/phim.jpg') }}" alt="Image">
                        <div class="card-film-body">
                            <h5 class="title">Đại Chúa Tể</h5>
                            <span class="decs">Sword Art Online</span>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-lg-3 col-md-4 col-sm-6  mb-3">
                    <div class="card-film">
                        <span class="episode">Tập 10</span>
                        <img class="img" src="{{ asset('FrontEnd/Image/avatar.jpg') }}" alt="Image">
                        <div class="card-film-body">
                            <h5 class="title">avatar</h5>
                            <span class="decs">avatar</span>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-lg-3 col-md-4 col-sm-6  mb-3">
                    <div class="card-film">
                        <span class="episode">Tập 10</span>
                        <img class="img" src="{{ asset('FrontEnd/Image/phim.jpg') }}" alt="Image">
                        <div class="card-film-body">
                            <h5 class="title">Đại Chúa Tể</h5>
                            <span class="decs">Sword Art Online</span>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-lg-3 col-md-4 col-sm-6  mb-3">
                    <div class="card-film">
                        <span class="episode">Tập 10</span>
                        <img class="img" src="{{ asset('FrontEnd/Image/phim.jpg') }}" alt="Image">
                        <div class="card-film-body">
                            <h5 class="title">Đại Chúa Tể</h5>
                            <span class="decs">Sword Art Online</span>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-lg-3 col-md-4 col-sm-6  mb-3">
                    <div class="card-film">
                        <span class="episode">Tập 10</span>
                        <img class="img" src="{{ asset('FrontEnd/Image/phim.jpg') }}" alt="Image">
                        <div class="card-film-body">
                            <h5 class="title">Đại Chúa Tể</h5>
                            <span class="decs">Sword Art Online</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-12"></div>
    </div>
@endsection

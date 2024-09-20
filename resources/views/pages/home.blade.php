@extends('layout')
@section('content')
    {{-- Slider --}}
    @include('pages.slider')
    {{-- Slider --}}

    <div class="row new-film mt-4">
        <div class="col-lg-9">
            <h1 class="title-section">
                Phim mới cập nhật
            </h1>
            <div class="row">
                <div class="col-4 col-lg-3 col-md-4 col-sm-4 mb-3">
                    <div class="card-film">
                        <span class="episode">Tập 10</span>
                        <img class="img" src="{{ asset('FrontEnd/Image/phim.jpg') }}" alt="Image">
                        <div class="card-film-body">
                            <h5 class="title">Đại Chúa Tể</h5>
                            <span class="decs">Sword Art Online</span>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-lg-3 col-md-4 col-sm-4 mb-3">
                    <div class="card-film">
                        <span class="episode">Tập 10</span>
                        <img class="img" src="{{ asset('FrontEnd/Image/phim.jpg') }}" alt="Image">
                        <div class="card-film-body">
                            <h5 class="title">Phàm nhân tu tiên</h5>
                            <span class="decs">Sword Art Online</span>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-lg-3 col-md-4 col-sm-4  mb-3">
                    <div class="card-film">
                        <span class="episode">Tập 10</span>
                        <img class="img" src="{{ asset('FrontEnd/Image/phim.jpg') }}" alt="Image">
                        <div class="card-film-body">
                            <h5 class="title">Đại Chúa Tể</h5>
                            <span class="decs">Sword Art Online</span>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-lg-3 col-md-4 col-sm-4 mb-3">
                    <div class="card-film">
                        <span class="episode">Tập 10</span>
                        <img class="img" src="{{ asset('FrontEnd/Image/phim.jpg') }}" alt="Image">
                        <div class="card-film-body">
                            <h5 class="title">Đại Chúa Tể</h5>
                            <span class="decs">Sword Art Online</span>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-lg-3 col-md-4 col-sm-4  mb-3">
                    <div class="card-film">
                        <span class="episode">Tập 10</span>
                        <img class="img" src="{{ asset('FrontEnd/Image/phim.jpg') }}" alt="Image">
                        <div class="card-film-body">
                            <h5 class="title">Đại Chúa Tể</h5>
                            <span class="decs">Sword Art Online</span>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-lg-3 col-md-4 col-sm-4  mb-3">
                    <div class="card-film">
                        <span class="episode">Tập 10</span>
                        <img class="img" src="{{ asset('FrontEnd/Image/phim.jpg') }}" alt="Image">
                        <div class="card-film-body">
                            <h5 class="title">Đại Chúa Tể</h5>
                            <span class="decs">Sword Art Online</span>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-lg-3 col-md-4 col-sm-4  mb-3">
                    <div class="card-film">
                        <span class="episode">Tập 10</span>
                        <img class="img" src="{{ asset('FrontEnd/Image/phim.jpg') }}" alt="Image">
                        <div class="card-film-body">
                            <h5 class="title">Đại Chúa Tể</h5>
                            <span class="decs">Sword Art Online</span>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-lg-3 col-md-4 col-sm-4  mb-3">
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
        <div class="col-lg-3">
            <h1 class="title-section">
                Bảng xếp hạng
            </h1>
            <hr>
            <div class="rank-container">
                <div class="row rank-item">
                    <div class="col-4 col-lg-4">
                        <img class="img-fluid" src="{{ asset('FrontEnd/Image/pttt.jpg') }}" alt="Image">
                    </div>
                    <div class="col-4 col-lg-8 p-0">
                        <h5 class="title">Đại chúa tể</h5>
                    </div>
                </div>
                <div class="row rank-item">
                    <div class="col-4 col-lg-4">
                        <img class="img-fluid" src="{{ asset('FrontEnd/Image/pttt.jpg') }}" alt="Image">
                    </div>
                    <div class="col-4 col-lg-8  p-0">
                        <h5 class="title">Đại chúa tể</h5>
                        <span class="desc"></span>
                    </div>
                </div>
                <div class="row rank-item">
                    <div class="col-4 col-lg-4">
                        <img class="img-fluid" src="{{ asset('FrontEnd/Image/pttt.jpg') }}" alt="Image">
                    </div>
                    <div class="col-4 col-lg-8 p-0">
                        <h5 class="title">Tam chiến thiên hạ, thiên chân vô song, song thành chi khởi</h5>
                        <span class="desc"></span>
                    </div>
                </div>
                <div class="row rank-item">
                    <div class="col-4 col-lg-4">
                        <img class="img-fluid" src="{{ asset('FrontEnd/Image/pttt.jpg') }}" alt="Image">
                    </div>
                    <div class="col-4 col-lg-8  p-0">
                        <h5 class="title">Đại chúa tể</h5>
                        <span class="desc"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row film-hot mt-4">
        <h1 class="title-section">
            Phim hot
        </h1>
        <div class="owl-carousel owl-theme">
            <div class="item">
                <div class="card-film">
                    <span class="episode">Tập 10</span>
                    <img class="img" src="{{ asset('FrontEnd/Image/pttt.jpg') }}" alt="Image">
                    <div class="card-film-body">
                        <h5 class="title">Đại Chúa Tể</h5>
                        <span class="decs">Sword Art Online</span>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="card-film">
                    <span class="episode">Tập 10</span>
                    <img class="img" src="{{ asset('FrontEnd/Image/pttt.jpg') }}" alt="Image">
                    <div class="card-film-body">
                        <h5 class="title">Đại Chúa Tể</h5>
                        <span class="decs">Sword Art Online</span>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="card-film">
                    <span class="episode">Tập 10</span>
                    <img class="img" src="{{ asset('FrontEnd/Image/pttt.jpg') }}" alt="Image">
                    <div class="card-film-body">
                        <h5 class="title">Đại Chúa Tể</h5>
                        <span class="decs">Sword Art Online</span>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="card-film">
                    <span class="episode">Tập 10</span>
                    <img class="img" src="{{ asset('FrontEnd/Image/pttt.jpg') }}" alt="Image">
                    <div class="card-film-body">
                        <h5 class="title">Đại Chúa Tể</h5>
                        <span class="decs">Sword Art Online</span>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="card-film">
                    <span class="episode">Tập 10</span>
                    <img class="img" src="{{ asset('FrontEnd/Image/pttt.jpg') }}" alt="Image">
                    <div class="card-film-body">
                        <h5 class="title">Đại Chúa Tể</h5>
                        <span class="decs">Sword Art Online</span>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="card-film">
                    <span class="episode">Tập 10</span>
                    <img class="img" src="{{ asset('FrontEnd/Image/pttt.jpg') }}" alt="Image">
                    <div class="card-film-body">
                        <h5 class="title">Đại Chúa Tể</h5>
                        <span class="decs">Sword Art Online</span>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="card-film">
                    <span class="episode">Tập 10</span>
                    <img class="img" src="{{ asset('FrontEnd/Image/pttt.jpg') }}" alt="Image">
                    <div class="card-film-body">
                        <h5 class="title">Đại Chúa Tể</h5>
                        <span class="decs">Sword Art Online</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

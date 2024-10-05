@extends('layout')
@section('content')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb" class="breadcrumb-container">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb" class="breadcrumb-container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('trang-chu') }}">Trang chủ</a></li>
                @foreach ($movie->categories as $category)
                    <li class="breadcrumb-item">
                        <a href="{{ URL::to('danh-muc/' . $category->slug) }}">{{ $category->title }}</a>
                    </li>
                @endforeach
                @foreach ($movie->genres as $genre)
                    <li class="breadcrumb-item">
                        <a href="{{ URL::to('the-loai/' . $genre->slug) }}">{{ $genre->title }}</a>
                    </li>
                @endforeach
                <li class="breadcrumb-item">
                    <a href="{{ URL::to('phim/' . $movie->slug) }}">{{ $movie->title }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $episode->episode_display }}</li>
            </ol>
        </nav>
    </nav>
    <div class="mt-4">
        <div class="row mb-5">
            {!! $episode->iframe !!}
        </div>
        <div class="row ">
            <div class="col-lg-8 mb-3">
                <h5 class="title-list">Danh sách các tập phim</h5>
                <div class="list-container">
                    @if ($episode_movie->count() > 0)
                        @foreach ($episode_movie as $epi)
                            <div class="episode-container">
                                <a href="{{ URL::to('xem-phim/' . $movie->slug . '/' . $epi->episode_display) }}">
                                    <button
                                        class="btn-episode {{ Request::is('xem-phim/' . $movie->slug . '/' . $epi->episode_display) ? 'active' : '' }}">
                                        {{ $epi->episode_display }}
                                    </button>
                                </a>
                            </div>
                        @endforeach
                    @else
                        <span class="note-null">Hiện chưa phim này chưa có tập nào</span>
                    @endif
                </div>
            </div>
            <div class="col-lg-4 mb-3">
                <h5 class="title-list">Danh sách các phần</h5>
                <div class="list-container">
                    @if ($series_movie->count() > 0)
                        <div class="row">
                            @foreach ($series_movie as $ser)
                                <div class="col-lg-6 col-md-4 col-sm-6 col-6 mb-3">
                                    <a href="{{ URL::to('phim/' . $ser->slug) }}">
                                        <div class="card-film">
                                            <img class="img" src="{{ asset('uploads/movies/' . $ser->image) }}"
                                                alt="{{ $ser->title }}" title="{{ $ser->title }}">
                                            <div class="card-film-body">
                                                <h5 class="title">{{ $ser->title }}</h5>
                                                <span class="decs">{{ $ser->sub_title }}</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <span class="note-null">Hiện phim này không có phần nào khác!</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-12 position-relative mb-4">
            <hr class="comment-line">
            <h5 class="comment-title">Bình luận</h5>
        </div>
        <div class="col-lg-12 mb-4">
            <form>
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="avatar-selection">
                            <p>Chọn một avatar:</p>
                            <div class="avatars">
                                <img src="{{ asset('Frontend/image/avatar.png') }}" class="avatar-option" alt="Avatar 2">
                                <img src="{{ asset('Frontend/image/avatar1.png') }}" class="avatar-option" alt="Avatar 1">
                                <img src="{{ asset('Frontend/image/avatar2.png') }}" class="avatar-option" alt="Avatar 3">
                                <img src="{{ asset('Frontend/image/avatar4.png') }}" class="avatar-option" alt="Avatar 4">
                                <img src="{{ asset('Frontend/image/avatar5.jpg') }}" class="avatar-option" alt="Avatar 5">
                                <img src="{{ asset('Frontend/image/avatar6.jpg') }}" class="avatar-option" alt="Avatar 6">
                                <img src="{{ asset('Frontend/image/avatar7.jpg') }}" class="avatar-option" alt="Avatar 7">
                                <img src="{{ asset('Frontend/image/avatar8.jpg') }}" class="avatar-option" alt="Avatar 8">
                                <img src="{{ asset('Frontend/image/avatar9.jpg') }}" class="avatar-option" alt="Avatar 9">
                                <img src="{{ asset('Frontend/image/avatar10.png') }}" class="avatar-option"
                                    alt="Avatar 10">
                                <img src="{{ asset('Frontend/image/avatar11.png') }}" class="avatar-option"
                                    alt="Avatar 11">
                                <img src="{{ asset('Frontend/image/avatar12.png') }}" class="avatar-option"
                                    alt="Avatar 12">
                            </div>
                            <!-- Ẩn input để lưu giá trị avatar được chọn -->
                            <input type="hidden" class="selected-avatar" name="avatar"
                                value="{{ asset('Frontend/image/avatar1.png') }}">
                        </div>
                        <input type="text" class="input-name mb-1" placeholder="Họ và tên" required>
                        <span class="name-error-message"></span>
                        <textarea class="comment-text mt-2" cols="30" rows="5" placeholder="Nhập bình luận của bạn..." required></textarea>
                        <span class="comment-error-message"></span>
                    </div>
                </div>
                <button class="comment-submit send-comment mt-2" type="button">Đăng bình luận</button>
            </form>
        </div>
        <div class="col-lg-12">
            <div class="comment-section">
                <form>
                    @csrf
                    <input class="movie_id" type="hidden" name="movie_id" value="{{ $movie->id }}">
                    <div id="comment_show">
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('comment-JS')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const avatars = document.querySelectorAll('.avatar-option');
                const selectedAvatarInput = document.querySelector('.selected-avatar');
                selectedAvatarInput.value = null;
                avatars.forEach(avatar => {
                    avatar.addEventListener('click', function() {
                        avatars.forEach(avatar => avatar.classList.remove('selected'));
                        this.classList.add('selected');
                        const avatarFileName = this.src.split('/').pop();
                        selectedAvatarInput.value = avatarFileName;
                    });
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                load_comment();

                function load_comment(page = 1) {
                    var movie_id = $('.movie_id').val();
                    var _token = $('input[name="_token"]').val();

                    $.ajax({
                        url: "{{ url('/load-comment') }}",
                        method: 'POST',
                        data: {
                            movie_id: movie_id,
                            page: page,
                            _token: _token
                        },
                        success: function(data) {
                            $('#comment_show').html(data.output);
                        }
                    });
                }

                // Xử lý sự kiện khi nhấn vào các liên kết phân trang
                $(document).on('click', '.pagination a', function(event) {
                    event.preventDefault();
                    var page = $(this).attr('href').split('page=')[1];
                    load_comment(page);
                });

                $('.send-comment').click(function() {
                    var movie_id = $('.movie_id').val();
                    var avatar = $('.selected-avatar').val();
                    var author = $('.input-name').val();
                    var content = $('.comment-text').val();
                    var _token = $('input[name="_token"]').val();

                    // Kiểm tra độ dài Họ và Tên và Bình luận
                    var isValid = true;
                    $('.comment-error-message').hide();
                    if (author.length > 50) {
                        $('.name-error-message').text('Tên hơi bị dài rồi đó bạn ê!').show();
                        isValid = false;
                    } else {
                        $('.name-error-message').hide();
                    }

                    if (content.length > 1000) {
                        $('.comment-error-message').text('Bình luận dài vậy, chắc chuyên văn đúng hông!')
                            .show();
                        isValid = false;
                    } else {
                        $('.comment-error-message').hide();
                    }

                    // Nếu tất cả hợp lệ, tiến hành gọi AJAX
                    if (isValid) {
                        $.ajax({
                            url: "{{ url('/send-comment') }}",
                            method: 'POST',
                            data: {
                                movie_id: movie_id,
                                avatar: avatar,
                                author: author,
                                content: content,
                                _token: _token
                            },
                            success: function(data) {
                                if (data.error) {
                                    $('.comment-error-message').text(data.error).show();
                                } else {
                                    load_comment(); // Gọi hàm load lại danh sách bình luận
                                    $('.comment-text').val(
                                        ''); // Xóa nội dung bình luận sau khi gửi thành công
                                    $('.name-error-message, .comment-error-message').hide();
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                            }
                        });
                    }
                });


                $(document).on('click', '.recall-comment', function() {
                    var comment_id = $(this).data('comment_id');
                    var _token = $('input[name="_token"]').val();
                    if (confirm('Bạn có chắc là muốn xóa bình luận này?')) {
                        $.ajax({
                            url: "{{ url('/recall-comment') }}",
                            method: 'POST',
                            data: {
                                comment_id: comment_id,
                                _token: _token
                            },
                            success: function(data) {
                                load_comment();
                            }
                        });
                    }
                });
            });
        </script>
    @endpush
@endsection

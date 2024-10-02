<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Quản trị viên</title>
    <link rel="shortcut icon" href="{{ asset('Frontend/image/logo.png') }}">
    {{-- <link rel="icon" type="image/x-icon" href=""> --}}
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"
        rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">

    <link href="{{ asset('/Admin/plugins/jqvmap/jqvmap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/Admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}"rel="stylesheet" />
    {{-- <link href="{{ asset('/Admin/plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet" /> --}}
    {{-- <link href="{{ asset('/Admin/plugins/sweetalert2/sweetalert2.css') }}" rel="stylesheet" /> --}}
    <!-- DataTables -->
    <link href="{{ asset('/Admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/Admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/Admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <!-- Select2 -->
    <link href="{{ asset('/Admin/plugins/select2/css/select2.min.css') }}"rel="stylesheet">
    <link href="{{ asset('/Admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}" rel="stylesheet">

    <link href="{{ asset('/Admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/Admin/css/adminlte.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/Admin/css/adminlte.css') }}" rel="stylesheet">
    <link href="{{ asset('/Admin/css/main-style.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('/Admin/css/sweetalert.css') }}" rel="stylesheet"> --}}
    {{-- <link href="{{ asset('/Admin/css/morris.css') }}" rel="stylesheet"> --}}
    {{-- <link href="{{ asset('/Admin/css/toastr.min.css') }}" rel="stylesheet"> --}}
    {{-- <link href="{{ asset('/Admin/css/style-responsive.css') }}" rel="stylesheet" /> --}}
    {{-- <link href="{{ asset('/Admin/css/ionicons.min.css') }}" rel="stylesheet" /> --}}
    {{-- iziToast Notification --}}
    <link href="{{ asset('/Admin/css/iziToast.min.css') }}" rel="stylesheet">
    {{-- froala editor --}}
    <link href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css" rel="stylesheet" />

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    {{-- <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/trang-chu') }}">
                    Trang chủ
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </div> --}}

    @if (Auth::user())
        <div class="wrapper">
            {{-- <div class="preloader" id="preloader">
                <div class="progress-bar"></div>
            </div> --}}
            @include('admin.page-ribs.header')
            @include('admin.page-ribs.sidebar-left')
            <div class="content-wrapper" style="padding-inline: 10px">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            @include('admin.page-ribs.footer')
        </div>
    @else
        @yield('content')
    @endif

    <script src="{{ asset('/Admin/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/Admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('/Admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('/Admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    {{-- <script src="{{ asset('/Admin/plugins/sweetalert2/sweetalert2.js') }}"></script> --}}
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('/Admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/Admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/Admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/Admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/Admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('/Admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <!-- 6 button table -->
    <script src="{{ asset('/Admin/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('/Admin/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('/Admin/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('/Admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('/Admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('/Admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- ChartJS -->
    {{-- <script src="{{ asset('/Admin/plugins/chart.js/Chart.min.js') }}"></script> --}}
    <!-- Select2 -->
    <script src="{{ asset('/Admin/plugins/select2/js/select2.full.min.js') }}"></script>

    {{-- <script src="{{ asset('/Admin/js/sweetalert.min.js') }}"></script> --}}
    <script src="{{ asset('/Admin/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/Admin/js/adminlte.js') }}"></script>
    {{-- <script src="{{ asset('/Admin/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('/Admin/js/morris.js') }}"></script>
    <script src="{{ asset('/Admin/js/morris.min.js') }}"></script>
    <script src="{{ asset('/Admin/js/raphael-min.js') }}"></script> --}}
    <script src="{{ asset('/Admin/js/jquery-ui.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

    {{-- iziToast Notification --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>

    {{-- froala-editor --}}
    <script src="https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js"></script>

    {{-- Setting iziToastSettings.js --}}
    <script>
        iziToast.settings({
            timeout: 2500,
            resetOnHover: true,
            position: 'bottomRight',
            transitionIn: 'fadeInLeft',
            transitionOut: 'fadeOutRight',
        });
    </script>
    <script>
        @if (Session::has('success'))
            iziToast.success({
                message: "{{ Session::get('success') }}",
            });
        @endif

        @if (Session::has('error'))
            iziToast.error({
                message: "{{ Session::get('error') }}",
            });
        @endif

        @if (Session::has('info'))
            iziToast.info({
                message: "{{ Session::get('info') }}",
            });
        @endif

        @if (Session::has('warning'))
            iziToast.warning({
                message: "{{ Session::get('warning') }}",
            });
        @endif
    </script>

    {{-- Setting iziToastSettings.js --}}
    <script>
        $(function() {
            $('.select2').select2()
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        })
    </script>
    {{-- sử dụng data table --}}
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
    {{-- sử dụng data table --}}

    {{-- status button --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButtons = document.querySelectorAll('.toggle-status');
            toggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const activeUrl = this.getAttribute('data-active-url');
                    const inactiveUrl = this.getAttribute('data-inactive-url');
                    const currentStatus = this.classList.contains('active') ? 1 : 0;
                    const newStatus = currentStatus === 1 ? 0 : 1;
                    const url = newStatus === 1 ? activeUrl : inactiveUrl;

                    fetch(url, {
                            method: 'GET',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute('content')
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                this.classList.toggle('active');
                                this.title = newStatus === 1 ? 'Hiển thị' : 'Ẩn';
                                iziToast.success({
                                    message: 'Đã áp dụng trạng thái mới!',
                                });
                            } else {
                                console.error('Đã xảy ra lỗi:', data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Đã xảy ra lỗi:', error);
                        });
                });
            });
        });
    </script>
    {{-- status button --}}

    {{-- Xoá dữ liệu trong table (dùng chung cho tất cả table) --}}
    <script>
        function deleteItem(element) {
            var id = $(element).data('id');
            var confirmMessage = $(element).data('confirm-message');
            var type = $(element).data('type');
            var token = $('meta[name="csrf-token"]').attr('content');

            if (confirm(confirmMessage)) {
                $.ajax({
                    url: '/' + type + '/' + id,
                    type: 'DELETE',
                    data: {
                        _token: token
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            iziToast.success({
                                message: response.message,
                            });
                            $('#' + type + '-row-' + id).remove();
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
        }
    </script>
    {{-- Xoá dữ liệu trong table --}}

    {{-- tự động đưa con trỏ chuột vào ô nhập liệu chứa class auto-focus khi trang được tải --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var inputElement = document.querySelector('.auto-focus');
            if (inputElement) {
                inputElement.focus();
            }
        });
    </script>
    {{-- tự động đưa con trỏ chuột vào ô nhập liệu chứa class auto-focus khi trang được tải --}}

    {{-- Tự động tạo slug --}}
    <script>
        function removeVietnameseDiacritics(str) {
            return str.normalize('NFD').replace(/[\u0300-\u036f]/g, '').replace(/đ/g, 'd').replace(/Đ/g, 'D');
        }

        function getRandomString(length) {
            var randomChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var result = '';
            for (var i = 0; i < length; i++) {
                result += randomChars.charAt(Math.floor(Math.random() * randomChars.length));
            }
            return result;
        }

        document.querySelectorAll('[data-slug-source]').forEach(function(input) {
            input.addEventListener('input', function() {
                var sourceType = this.getAttribute('data-slug-source');
                var title = this.value;
                var slug = removeVietnameseDiacritics(title)
                    .toLowerCase()
                    .replace(/ /g, '-')
                    .replace(/[^\w-]+/g, '')
                    .replace(/--+/g, '-')
                    .replace(/^-+/, '')
                    .replace(/-+$/, '');

                var now = new Date();
                // var timestamp = now.getFullYear().toString().substr(-2) +
                //     ('0' + (now.getMonth() + 1)).slice(-2) +
                //     ('0' + now.getDate()).slice(-2) +
                //     ('0' + now.getHours()).slice(-2) +
                //     ('0' + now.getMinutes()).slice(-2) +
                //     ('0' + now.getSeconds()).slice(-2);

                // var randomString = getRandomString(4); // Độ dài chuỗi ngẫu nhiên

                // slug += '-' + timestamp + '-' + randomString;

                var targetInput = document.querySelector('[data-slug-target="' + sourceType + '"]');
                if (targetInput) {
                    targetInput.value = slug;
                }
            });
        });
    </script>
    {{-- Tự động tạo slug --}}

    @stack('edit-category-JS')
    @stack('edit-genre-JS')
    @stack('edit-country-JS')
    @stack('edit-series-JS')
    @stack('create-episode-JS')
    @stack('movie-episode-JS')
    @stack('view-movie-episode-JS')
    {{-- khởi tạo FroalaEditor --}}
    <script>
        new FroalaEditor('.froala-editor');
    </script>
    {{-- khởi tạo FroalaEditor --}}


</body>

</html>

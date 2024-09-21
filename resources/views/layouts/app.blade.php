<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Quản trị viên</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('/frontend/images/home/icon-web.png') }}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"
        rel="stylesheet" />
    <link href="{{ asset('/Admin/plugins/jqvmap/jqvmap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/Admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}"rel="stylesheet" />
    <link href="{{ asset('/Admin/plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/Admin/plugins/sweetalert2/sweetalert2.css') }}" rel="stylesheet" />
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
    <link href="{{ asset('/Admin/css/sweetalert.css') }}" rel="stylesheet">
    <link href="{{ asset('/Admin/css/morris.css') }}" rel="stylesheet">
    <link href="{{ asset('/Admin/css/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/Admin/css/style-responsive.css') }}" rel="stylesheet" />
    <link href="{{ asset('/Admin/css/ionicons.min.css') }}" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
    <!-- summernote -->
    <link href="{{ asset('/Admin/plugins/summernote/summernote-bs4.min.css') }}" rel="stylesheet">

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    {{-- <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
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
            <div class="preloader" id="preloader">
                <div class="progress-bar"></div>
            </div>
            @include('admin.page-ribs.header')
            @include('admin.page-ribs.sidebar-left')
            <div class="content-wrapper">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            @include('admin.page-ribs.footer')
        </div>
    @else
        @yield('content')
    @endif
    <script>
        $.widget.bridge("uibutton", $.ui.button);
    </script>

    <script src="{{ asset('/Admin/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/Admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('/Admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('/Admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('/Admin/plugins/sweetalert2/sweetalert2.js') }}"></script>
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
    <!-- Summernote -->
    <script src=" {{ asset('/Admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('/Admin/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('/Admin/plugins/select2/js/select2.full.min.js') }}"></script>

    <script src="{{ asset('/Admin/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('/Admin/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/Admin/js/adminlte.js') }}"></script>
    <script src="{{ asset('/Admin/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('/Admin/js/morris.js') }}"></script>
    <script src="{{ asset('/Admin/js/morris.min.js') }}"></script>
    <script src="{{ asset('/Admin/js/raphael-min.js') }}"></script>
    <script src="{{ asset('/Admin/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('/Admin/js/toastr.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

</body>

</html>

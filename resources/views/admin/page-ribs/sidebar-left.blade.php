<aside class="main-sidebar sidebar-dark-primary elevation-4 bg-dnb">
    <!-- Brand Logo -->
    <a class="brand-link">
        <img src="{{ asset('Admin/images/logo-nonebg.png') }}" alt="AdminLTE Logo" class="brand-image" />
        <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('Admin/images/AdminLTELogo.png') }}" class="img-circle elevation-2"
                    alt="User Image" />
            </div>
            <div class="info">
                <a href="#" class="d-block"> {{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search" />
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item ">
                    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-header">Phân loại</li>
                {{-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Charts
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/charts/chartjs.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>ChartJS</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/charts/flot.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Flot</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/charts/inline.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Inline</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/charts/uplot.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>uPlot</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}
                <li class="nav-item ">
                    <a href="{{ route('category.index') }}"
                        class="nav-link {{ Request::is('category*') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-layer-group"></i>
                        <p>
                            Danh mục phim
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('genre.index') }}" class="nav-link {{ Request::is('genre*') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-bars-staggered"></i>
                        <p>Thể loại</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('country.index') }}"
                        class="nav-link {{ Request::is('country*') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-earth-americas"></i>
                        <p>Quốc gia</p>
                    </a>
                </li>
                <li class="nav-header">Phim</li>
                <li class="nav-item">
                    <a href="{{ route('series.index') }}"
                        class="nav-link {{ Request::is('series*') ? 'active' : '' }}">
                        <i class="nav-icon fa-brands fa-microsoft"></i>
                        <p>Series phim</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('movie.index') }}" class="nav-link {{ Request::is('movie*') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-film"></i>
                        <p> Phim</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('episode.index') }}"
                        class="nav-link {{ Request::is('episode*') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-list-ol"></i>
                        <p>Tập phim</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('comment.index') }}"
                        class="nav-link {{ Request::is('comment*') ? 'active' : '' }}">
                        <i class="nav-icon fa-regular fa-comments"></i>
                        <p>
                            Bình luận
                        </p>
                    </a>
                </li>
                <li class="nav-header">Website</li>
                <li class="nav-item">
                    <a href="{{ route('information.index') }}"
                        class="nav-link {{ Request::is('information*') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-info"></i>
                        <p>
                            Thông tin
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('slider.index') }}"
                        class="nav-link {{ Request::is('slider*') ? 'active' : '' }}">
                        <i class="nav-icon fa-regular fa-font-awesome"></i>
                        <p>
                            Slider
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>

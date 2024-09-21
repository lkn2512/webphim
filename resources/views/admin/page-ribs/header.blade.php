<nav class="main-header navbar navbar-expand navbar-white navbar-light ">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link">
                <div class="clock">
                    <span id="date"></span>
                    <span id="time"></span>
                </div>
            </a>
        </li>
        <script>
            const WEEK = ["Chủ nhật", 'Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7'];

            function zeroPadding(num, length) {
                return String(num).padStart(length, '0');
            }

            function updateTime() {
                var now = new Date();
                document.getElementById("time").innerText = " | " + zeroPadding(now.getHours(), 2) + ":" + zeroPadding(now
                    .getMinutes(),
                    2) + ":" + zeroPadding(now.getSeconds(), 2);
                document.getElementById("date").innerText = WEEK[now.getDay()] + ", " + zeroPadding(now.getDate(), 2) + "-" +
                    zeroPadding(now.getMonth() + 1, 2) + "-" + now.getFullYear();
            }
            updateTime();
            setInterval(updateTime, 1000);
        </script>


    </ul>
    <ul class="navbar-nav">
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                    {{-- {{ __('Logout') }}  --}}Đăng xuất
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>

</nav>

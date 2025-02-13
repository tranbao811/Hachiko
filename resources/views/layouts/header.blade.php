<nav class="navbar navbar-expand navbar-light navbar-bg" style="z-index: 3;top: 0;position: sticky;">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <li class="nav-item dropdown">
                <a style="display:none" id="myid" href="#" target="_top">Link</a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                    <span class="text-dark">{{ Auth::guard('admin')->user()->username }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="user"></i> Thông tin</a>
                    <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="pie-chart"></i> Số liệu</a>
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('admin.logout') }}" style="margin-bottom: 0px;">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class="align-middle me-1" data-feather="log-out"></i> ログアウト
                        </button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>

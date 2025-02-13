<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" style="font-size: 30px; text-align: center;" href="#">
            <span class="align-middle">商材管理</span>
        </a>

        <ul class="sidebar-nav">
            @php
            $userLevel = auth()->user()->level; // Lấy cấp độ của người dùng
            @endphp

            <li class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" style="font-size: 15px; margin-bottom: 15px;">
                <a class="sidebar-link" href="{{ route('admin.dashboard') }}">
                    <i class="align-middle" data-feather="shopping-bag"></i>
                    <span class="align-middle" style="color: rgba(233, 236, 239, 0.7);">注文状況</span>
                </a>
            </li>

            @if(in_array($userLevel, [1, 2, 3, 4, 5, 6, 7, 8]))
            <li class="sidebar-item {{ request()->routeIs('sim.sim_call*') ? 'active' : '' }}" style="font-size: 15px; margin-bottom: 15px;">
                <a class="sidebar-link dropdown-toggle d-none d-sm-inline-block">
                    <i class="align-middle" data-feather="phone-call"></i>
                    <span class="align-middle dropbtn" onclick="myFunctionSimCall(this, event)" style="color: rgba(233, 236, 239, 0.7);">音声回線</span>
                </a>
                <div id="myDropdownSimCall" class="dropdown-sidebar" style="margin: auto; font-size: 15px; width: auto; padding: 0 22px; border-radius: 10px;">
                    <a href="{{ route('sim.sim_call') }}">シムリスト</a>
                    <a href="{{ route('sim.sim_call_customer_request') }}">リクエスト</a>
                    <!-- Chỉ hiển thị nếu level là 2 hoặc 4 -->
                    @if(in_array(auth()->user()->level, [2, 4]))
                    <a href="{{ route('sim.sim_call_storage') }}">CSV経由でシムを追加</a>
                    <a href="{{ route('sim.sim_call_transfer') }}">転送倉庫</a>
                    @endif
                </div>
            </li>
            @else
            <li class="sidebar-item {{ request()->routeIs('sim.sim_call*') ? 'active' : '' }}" style="font-size: 15px; margin-bottom: 15px;">
                <a class="sidebar-link" href="{{ route('sim.sim_call') }}">
                    <i class="align-middle" data-feather="phone-call"></i>
                    <span class="align-middle" style="color: rgba(233, 236, 239, 0.7);">音声回線</span>
                </a>
            </li>
            @endif


            @if(in_array($userLevel, [1, 2, 3, 4, 5, 6, 7,8]))
            <li class="sidebar-item {{ request()->routeIs('sim.sim_data*') ? 'active' : '' }}" style="font-size: 15px; margin-bottom: 15px;">
                <a class="sidebar-link dropdown-toggle d-none d-sm-inline-block">
                    <i class="align-middle" data-feather="radio"></i>
                    <span class="align-middle" onclick="myFunctionSimData(this, event)" style="color: rgba(233, 236, 239, 0.7);">データ回線</span>
                </a>
                <div id="myDropdownSimData" class="dropdown-sidebar" style="margin: auto; font-size: 15px; width: auto; padding: 0 22px; border-radius: 10px;">
                    <a href="{{ route('sim.sim_data') }}">シムデータ一覧</a>
                    <a href="{{ route('sim.sim_data_customer_request') }}">リクエスト</a>
                    <!-- Chỉ hiển thị nếu level là 2 hoặc 4 -->
                    @if(in_array(auth()->user()->level, [2, 4]))
                    <a href="{{ route('sim.sim_data_storage') }}">CSV経由でシムを追加</a>
                    <a href="{{ route('sim.sim_data_transfer') }}">転送倉庫</a>
                    @endif
                </div>
            </li>
            @else
            <li class="sidebar-item {{ request()->routeIs('sim.sim_data*') ? 'active' : '' }}" style="font-size: 15px; margin-bottom: 15px;">
                <a class="sidebar-link" href="{{ route('sim.sim_data') }}">
                    <i class="align-middle" data-feather="radio"></i>
                    <span class="align-middle" style="color: rgba(233, 236, 239, 0.7);">データ回線</span>
                </a>
            </li>

            @endif

            <li class="sidebar-item {{ request()->routeIs('wifi.wifi_codinh') ? 'active' : '' }}" style="font-size: 15px; margin-bottom: 15px;">
                <a class="sidebar-link" href="{{ route('wifi.wifi_codinh') }}">
                    <i class="align-middle" data-feather="cast"></i>
                    <span class="align-middle" style="color: rgba(233, 236, 239, 0.7);">光回線</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('admin.wifi_khongday') ? 'active' : '' }}" style="font-size: 15px; margin-bottom: 15px;">
                <a class="sidebar-link" href="#">
                    <i class="align-middle" data-feather="rss"></i>
                    <span class="align-middle" style="color: rgba(233, 236, 239, 0.7);">無線Wi-Fi</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('admin.diengas') ? 'active' : '' }}" style="font-size: 15px; margin-bottom: 15px;">
                <a class="sidebar-link" href="#">
                    <i class="align-middle" data-feather="sun"></i>
                    <span class="align-middle" style="color: rgba(233, 236, 239, 0.7);">電気＆ガス</span>
                </a>
            </li>

            <li class="sidebar-item" style="font-size: 15px; margin-bottom: 15px;">
                <a class="sidebar-link" href="#">
                    <i class="align-middle" data-feather="user-plus"></i>
                    <span class="align-middle" style="color: rgba(233, 236, 239, 0.7);">マイペイメント</span>
                </a>
            </li>

            @if($userLevel == 1 || $userLevel == 2)
            <li class="sidebar-item {{ request()->routeIs('admin.admin*') ? 'active' : '' }}" style="font-size: 15px; margin-bottom: 15px;">
                <a class="sidebar-link dropdown-toggle d-none d-sm-inline-block">
                    <i class="align-middle" data-feather="sliders"></i>
                    <span class="align-middle dropbtn" onclick="myFunction(this, event)" style="color: rgba(233, 236, 239, 0.7);">パートナーアカウント</span>
                </a>
                <div id="myDropdown" class="dropdown-sidebar" style="margin: auto; font-size: 15px; width: auto; padding: 0 22px; border-radius: 10px;">
                    <a href="{{ route('admin.admin_accounts') }}">Danh sách đối tác</a>
                    <a href="{{ route('admin.admin_showRegisterForm') }}">Thêm đối tác mới</a>
                    <a href="#contact">Danh sách quản lý</a>
                    <a href="#contact">Thêm quản lý</a>
                </div>
            </li>
            @endif
        </ul>
    </div>
</nav>
<script>
    /* Khi người dùng nhấp vào nút,
chuyển đổi giữa ẩn và hiển thị nội dung thả xuống */
    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
        document.getElementById("myDropdown").setAttribute('togging', '1');
    }

    function myFunctionSimCall() {
        document.getElementById("myDropdownSimCall").classList.toggle("show");
        document.getElementById("myDropdownSimCall").setAttribute('togging', '1');
    }

    function myFunctionSimData() {
        document.getElementById("myDropdownSimData").classList.toggle("show");
        document.getElementById("myDropdownSimData").setAttribute('togging', '1');
    }

    // Đóng dropdown nếu nhấn ra ngoài
    window.onclick = function(event) {
        var dropdowns = document.querySelectorAll('.dropdown-sidebar');
        dropdowns.forEach(element => {
            if (
                element.classList.contains('show') &&
                !element.hasAttribute('togging')
            ) {
                element.classList.remove('show');
            }
            element.removeAttribute('togging');
        });
    }
</script>
<style>
    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-sidebar {
        display: none;
        /* position: absolute; */
        background-color: #07303e;
        max-width: 200px;
        overflow: auto;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .dropdown-sidebar a {
        color: white;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown a:hover {
        background-color: #ddd;
    }

    .show {
        display: block;
    }
</style>
@section('css')
<!-- Liên kết Bootstrap JS -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script> -->
<style>
    /* Lớp phủ (overlay) để làm mờ phần còn lại của trang */
    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        /* Màu nền mờ tối */
        display: none;
        /* Ẩn mặc định */
        z-index: 999;
        /* Đảm bảo overlay nằm trên tất cả các phần tử */
        transition: background-color 0.3s ease;
        /* Hiệu ứng chuyển màu nền */
    }

    /* Hiệu ứng hover cho overlay */
    .overlay:hover {
        background-color: rgba(0, 0, 0, 0.7);
        /* Tối màu khi hover */
    }

    /* Popup chính */
    .popup {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        padding: 10px;
        box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.3);
        /* Mờ hơn để popup nổi bật hơn */
        z-index: 1000;
        /* Đảm bảo popup nằm trên overlay */
        border-radius: 10px;
        display: none;
        /* Ẩn mặc định */
        max-width: 1000px;
        /* Đặt chiều rộng tối đa */
        width: 90%;
        /* Chiếm 90% chiều rộng màn hình */
        box-sizing: border-box;
        /* Đảm bảo padding không làm thay đổi kích thước */
    }

    /* Các nút trong popup */
    .button-container {
        display: flex;
        /* Đặt các nút nằm ngang */
        justify-content: center;
        /* Căn giữa các nút */
        flex-wrap: wrap;
        /* Cho phép các nút xuống dòng khi không đủ chỗ */
    }

    .button-container .button {
        margin: 5px;
        padding: 10px 10px;
        border: none;
        font-size: 16 px;
        color: white;
        cursor: pointer;
        /* border-radius: 5px; Viền mềm mại cho các nút */
        transition: background-color 0.3s ease, transform 0.2s ease;
        /* Hiệu ứng mượt cho hover */
    }

    .button-container .button:hover {
        transform: scale(0.96);
        /* Giảm nhẹ kích thước khi hover */
    }

    /* Cụ thể cho từng nút với màu nền hover */
    .button[data-form-id="yeucau1"]:hover {
        background-color: #0056b3;
        /* Màu nền khi hover */
    }

    .button[data-form-id="yeucau2"]:hover {
        background-color: #e0a800;
        /* Màu nền khi hover */
    }

    .button[data-form-id="yeucau3"]:hover {
        background-color: #c82333;
        /* Màu nền khi hover */
    }

    .button[data-form-id="yeucau4"]:hover {
        background-color: #019762;
        /* Màu nền khi hover */
    }

    .button[data-form-id="yeucau5"]:hover {
        background-color: #5c1a8e;
        /* Màu nền khi hover */
    }

    .button[data-form-id="yeucau6"]:hover {
        background-color: #032f8e;
        /* Màu nền khi hover */
    }

    .button[data-form-id="yeucau7"]:hover {
        background-color: #e60000;
        /* Màu nền khi hover */
    }


    /* Nút Upload */
    #uploadBtn {
        background-color: red;
        color: white;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 5px;
        /* Viền mềm mại */
        transition: background-color 0.3s ease;
    }

    #uploadBtn:hover {
        background-color: royalblue;
        /* Màu khi hover */
    }

    /* Tùy chỉnh một số style cho giao diện Bootstrap 5 */
    .table th,
    .table td {
        vertical-align: middle;
    }

    .card-footer {
        font-size: 0.9rem;
    }

    .card-header input {
        font-size: 1rem;
    }

    .table-responsive {
        max-height: 500px;
        overflow-y: auto;
    }

    .btn-outline-primary {
        padding: 5px 10px;
        font-size: 0.9rem;
    }

    .card-body {
        padding: 20px;
    }

    /* CSS cho button khi service_status = '在庫' */
    .btn-info {
        background-image: linear-gradient(45deg, rgb(84 0 255), rgb(136 0 255));
        /* Gradient màu nền */
        color: #fff;
        /* Đổi màu chữ thành trắng */
        transition: transform 0.3s ease, background-color 0.3s ease;
        /* Hiệu ứng chuyển tiếp */
    }

    th,
    td {
        border: 0px solid #ddd;
        padding: 8px;
        text-align: left;
        border-collapse: collapse;
        overflow: hidden;
        /* Add this line to ensure the border-radius is applied */
        white-space: nowrap;
        /* Ngăn chặn xuống dòng */
        max-width: 250px;
    }

    thead {
        position: sticky;
        top: 0;
        background-color: #fff;
        /* Tùy chọn: để đảm bảo hàng tiêu đề có nền */
        /* z-index: 1000; */
        /* Tùy chọn: để đảm bảo hàng tiêu đề nằm trên cùng */
    }

    #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #customers td,
    #customers th {
        border: 1px solid #f5f7fb;
        padding: 8px;
    }

    #customers tr:nth-child(odd) {
        background-color: #f2f2f2;
    }

    #customers tr:hover {
        background-color: #ddd;
    }

    #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #9d0000;
        color: white;
    }

    div.form-container {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
        max-width: 1100px;
        margin: 20px auto;
    }

    div.form-container label {
        font-weight: bold;
        margin-bottom: 5px;
        display: inline;
        color: #333;
        font-size: 14px;
    }

    div.form-container input[type="text"],
    div.form-container input[type="date"],
    div.form-container input[type="number"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 5px;
        border: 1px solid #ccc;
        border-radius: 15px;
        box-sizing: border-box;
        font-size: 15px;
    }

    div.form-container select {
        width: 100%;
        padding: 10px;
        margin-bottom: 5px;
        border: 1px solid #ccc;
        border-radius: 15px;
        box-sizing: border-box;
        font-size: 15px;
    }

    div.form-container button[type="submit"],
    div.form-container button[type="button"] {
        width: 150px;
        padding: 10px;
        border: none;
        border-radius: 16px;
        color: white;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    div.form-container button[type="submit"] {
        background-color: #00ad0e;
    }

    div.form-container button[type="submit"]:hover {
        background-color: #007a0a;
    }

    div.form-container button[type="button"] {
        background-color: #ff0000;
    }

    div.form-container button[type="button"]:hover {
        background-color: #960000;
    }

    div.form-container div {
        margin-bottom: 15px;
    }

    div.form-container div div {
        margin-bottom: 10px;
    }

    div.form-container div.button-container {
        display: flex;
        justify-content: center;
        gap: 40px;
        margin-top: 20px;
    }

    @media (max-width: 768px) {
        div.form-container {
            padding: 10px;
        }

        div.form-container div {
            flex-direction: column;
        }

        div.form-container div div {
            width: 100%;
        }
    }

    .popup-container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        /* Màu nền mờ */
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
        /* Đảm bảo popup nằm trên cùng */
    }

    .form-container {
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        width: 50%;
        /* Điều chỉnh kích thước form */
        max-width: 700px;
        /* Giới hạn kích thước tối đa */
    }

    /* CSS cho button khi service_status = '在庫' */
    .btn-info {
        background-image: linear-gradient(45deg, rgb(84 0 255), rgb(136 0 255));
        /* Gradient màu nền */
        color: #fff;
        /* Đổi màu chữ thành trắng */
        transition: transform 0.3s ease, background-color 0.3s ease;
        /* Hiệu ứng chuyển tiếp */
    }

    /* CSS để thay đổi kiểu dáng modal */
    #addAccountModal .modal-dialog {
        max-width: 800px;
        /* Tăng chiều rộng của modal */
        border-radius: 10px;
        /* Bo góc modal */
    }

    #addAccountModal .modal-content {
        border-radius: 10px;
        /* Bo góc nội dung của modal */
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        /* Thêm hiệu ứng bóng đổ */
    }

    .modal-header {
        border-bottom: 1px solid #e0e0e0;
        background-color: #f8f9fa;
        /* Màu nền sáng cho header */
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .modal-body {
        padding: 2rem;
        /* Thêm padding cho nội dung */
    }

    .modal-title {
        font-weight: 500;
        font-size: 1.25rem;
        /* Đặt kích thước font tiêu đề */
    }

    .form-control {
        border-radius: 5px;
        /* Bo góc cho các input và select */
        box-shadow: none;
        /* Bỏ shadow cho các input */
    }

    /* Căn giữa các nút trong button-group */
    .button-group {
        display: flex;
        justify-content: center;
        /* Căn giữa các nút theo chiều ngang */
        gap: 10px;
        width: 100%;
        /* Khoảng cách giữa các nút */
    }

    /* Nếu muốn điều chỉnh thêm kích thước nút */
    .small-button {
        padding: 10px 20px;
        font-size: 14px;
        border-radius: 5px;
    }
</style>
@endsection
@extends('layouts.app')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<main class="content" style="padding-top: 30px;">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-xl-6 col-xxl-6 d-flex">
                <div class="w-100">
                    <div class="row">
                        <div class="col-sm-6" style="width: 48%">
                            <div class="card" style="background-image: linear-gradient(rgb(28, 187, 140), rgb(28, 187, 140)); color: #fff; border-radius: 20px;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title" style="color:#fff">Tài khoản đối tác phát nhân</h5>
                                        </div>
                                        <div class="col-auto">
                                            <div class="stat text-primary" style="background: #fff">
                                                <i class="align-middle" data-feather="check-square"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="" style="color:#fff; margin-bottom: 0px;" id="totalPartnerManager1">{{ $totalPartnerManager1 }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-xxl-6 d-flex">
                <div class="w-100">
                    <div class="row">
                        <div class="col-sm-6" style="width: 48%">
                            <div class="card" style="background-image: linear-gradient(45deg, rgb(84 0 255) ,rgb(136 0 255) ); color: #fff;border-radius: 20px;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title" style="color:#fff">Tài khoản đối tác cá nhân</h5>
                                        </div>
                                        <div class="col-auto">
                                            <div class="stat text-primary" style="background: #fff">
                                                <i class="align-middle" data-feather="layers"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="" style="color:#fff; margin-bottom: 0px;" id="totalPartnerManager2">{{ $totalPartnerManager2 }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h1 class="h1 mb-3" style="text-align: center"><strong>Danh sách đối tác</strong></h1>
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm" style="border-radius: 20px;">
                        <div class="card-header d-flex justify-content-between align-items-center" style="border-radius: 20px;">
                            <div>
                                <input type="text" id="searchInput_Sim" class="form-control" style="width: 400px; border-radius: 20px;" placeholder="回線情報検索（電話番号、製造番号）" onkeyup="searchTable_Sim()">
                            </div>
                            <div>
                                <a href="{{ route('admin.admin_showRegisterForm') }}" class="btn btn-primary" style="border-radius: 20px;">
                                    Thêm tài khoản
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th class="text-center">順番</th>
                                            <th class="text-center">Ngày đăng ký</th>
                                            <th class="text-center">Tên đối tác</th>
                                            <th class="text-center">Số điện thoại</th>
                                            <th class="text-center">Địa chỉ</th>
                                            <th class="text-center">Tên công ty</th>
                                            <th class="text-center">Địa chỉ Mail</th>
                                            <th class="text-center">Mã bưu điện</th>
                                            <th class="text-center">Cấp độ tài khoản</th>
                                            <th class="text-center">Người phụ trách tài khoản</th>
                                            <th class="text-center">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $index => $item)
                                        <tr data-id="{{ $item->id }}">
                                            <td class="order-index text-center">{{ $index + 1 }}</td>
                                            <td class="text-center">{{ \Carbon\Carbon::parse($item->created_at)->format('Y/m/d') }}</td>
                                            <td class="text-center">{{ $item->username }}</td>
                                            <td class="text-center">{{ $item->telephonenumber }}</td>
                                            <td class="text-center">{{ $item->address }}</td>
                                            <td class="text-center">{{ $item->business }}</td>
                                            <td class="text-center">{{ $item->emailaddress }}</td>
                                            <td class="text-center">{{ $item->tax_number }}</td>
                                            <td class="text-center">
                                                @php
                                                $levelMapping = [
                                                1 => 'Giám đốc',
                                                2 => 'Quản lý',
                                                3 => 'Kế toán',
                                                4 => 'Thủ tục đăng ký WIFI',
                                                5 => 'Thủ tục đăng ký SIM',
                                                6 => 'Kỹ thuật',
                                                7 => 'Đối tác (Người dùng hệ thống)',
                                                8 => 'Cộng tác viên đối tác',
                                                ];
                                                $level = $item->level;
                                                $levelName = $levelMapping[$level] ?? 'Chưa xác định';
                                                @endphp
                                                {{ $levelName }}
                                            </td>
                                            <td class="text-center">
                                                @php
                                                $managerMapping = [
                                                1 => 'Chu Đức Quang',
                                                2 => 'Hồ Thị Hoài',
                                                ];
                                                $manager = $item->id_manager;
                                                $managerName = $managerMapping[$manager] ?? 'Chưa xác định';
                                                @endphp
                                                {{ $managerName }}
                                            </td>
                                            <td class="text-center">
                                                <button onclick="openPopup_update(this)" class="btn btn-outline-primary" style="border-radius: 20px;">
                                                    <i class="fa-regular fa-share-from-square"></i> 選択
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Popup Modal để sửa thông tin Admin -->
    <div class="overlay" id="popupOverlay" style="display:none;"></div>
    <div class="popup" id="updatePopup" style="display:none;top:40%">
        <div class="modal-header">
            <h2 class="modal-title">Sửa thông tin Admin</h2>
        </div>
        <div class="modal-body">
            <!-- Form sửa thông tin admin -->
            <form method="POST" action="" id="updateForm">
                @csrf
                <input type="hidden" id="adminId" name="adminId">
                <div class="form-group">
                    <label for="username">Tên đăng nhập</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="useraccount">Tài khoản người dùng</label>
                    <input type="text" class="form-control" id="useraccount" name="useraccount" required>
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="form-group">
                    <label for="telephonenumber">Số điện thoại</label>
                    <input type="text" class="form-control" id="telephonenumber" name="telephonenumber" required>
                </div>
                <div class="form-group">
                    <label for="address">Địa chỉ</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                </div>
                <div class="form-group">
                    <label for="business">Tên công ty</label>
                    <input type="text" class="form-control" id="business" name="business">
                </div>
                <div class="form-group">
                    <label for="emailaddress">Địa chỉ Mail</label>
                    <input type="email" class="form-control" id="emailaddress" name="emailaddress">
                </div>
                <div class="form-group">
                    <label for="tax_number">Mã bưu điện</label>
                    <input type="text" class="form-control" id="tax_number" name="tax_number">
                </div>
                <div class="form-group">
                    <label for="level">Cấp độ</label>
                    <select class="form-control" id="level" name="level">
                        <option value="1">Giám đốc</option>
                        <option value="2">Quản lý</option>
                        <option value="3">Kế toán</option>
                        <option value="4">Thủ tục đăng ký WIFI</option>
                        <option value="5">Thủ tục đăng ký SIM</option>
                        <option value="6">Kỹ thuật</option>
                        <option value="7">Đối tác (Người dùng hệ thống)</option>
                        <option value="8">Cộng tác viên đối tác</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="manager">Người quản lý</label>
                    <select class="form-control" id="manager" name="id_manager">
                        <option value="1">Chu Đức Quang</option>
                        <option value="2">Hồ Thị Hoài</option>
                    </select>
                </div>
                <div class="button-group">
                    <button type="submit" class="confirm small-button">送信</button>
                    <button type="button" class="back small-button" onclick="closePopup()">閉じる</button>
                </div>
            </form>
        </div>
    </div>

</main>

<script>
    // Hàm mở popup sửa thông tin admin
    function openPopup_update(button) {
        // Lấy ID admin từ dòng đang nhấn
        var adminId = button.closest('tr').getAttribute('data-id'); // Lấy data-id từ tr

        // Cập nhật URL của form sửa (action) dựa trên ID admin
        var form = document.getElementById('updateForm');
        var actionUrl = '/admin/update-admin/' + adminId; // Thêm ID vào URL
        form.setAttribute('action', actionUrl); // Cập nhật action của form

        // Gửi yêu cầu lấy thông tin admin từ server
        fetch('/admin/get-admin-details/' + adminId)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Điền thông tin vào form
                    document.getElementById('adminId').value = data.data.id || '';
                    document.getElementById('username').value = data.data.username || '';
                    document.getElementById('useraccount').value = data.data.useraccount || '';
                    document.getElementById('password').value = ''; // Để trống mật khẩu, người dùng có thể nhập mới nếu muốn
                    document.getElementById('telephonenumber').value = data.data.telephonenumber || '';
                    document.getElementById('address').value = data.data.address || '';
                    document.getElementById('business').value = data.data.business || '';
                    document.getElementById('emailaddress').value = data.data.emailaddress || '';
                    document.getElementById('tax_number').value = data.data.tax_number || '';
                    document.getElementById('level').value = data.data.level || '';
                    document.getElementById('manager').value = data.data.id_manager || '';

                    // Mở popup và overlay
                    document.getElementById('updatePopup').style.display = 'block';
                    document.getElementById('popupOverlay').style.display = 'block';
                } else {
                    alert("Không tìm thấy thông tin admin.");
                }
            })
            .catch(error => {
                console.error('Có lỗi xảy ra:', error);
                alert('Không thể tải thông tin admin.');
            });
    }

    // Hàm đóng popup
    function closePopup() {
        document.getElementById('updatePopup').style.display = 'none';
        document.getElementById('popupOverlay').style.display = 'none';
    }
</script>
@endsection
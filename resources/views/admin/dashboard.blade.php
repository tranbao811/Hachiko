@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<style>
    .button_sim {
        color: white;
        border: none;
        padding: 10px 20px;
        margin: 5px;
        border-radius: 22px;
        cursor: pointer;
        transition: background-color 0.3s;
        flex: 1;
    }

    .search-container {
        width: 100%;
        padding-bottom: 10px;
        padding-left: 50px;
        padding-top: 20px;
        padding-right: 20px;
    }

    .search-container h2 {
        margin-bottom: 15px;
        text-align: center;
        font-size: 40px;
        color: #ff0000;
        font-weight: bold;
    }

    .search-container h3 {
        margin-bottom: 30px;
        text-align: center;
        font-size: 16px;
        color: #000000;
    }

    .search-container .form-group {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
    }

    .search-container label {
        font-weight: bold;
        color: #555;
        margin-right: 10px;
        width: 100px;
    }

    .search-container input[type="text"],
    .search-container select {
        flex: 1;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 20px;
        font-size: 14px;
        color: #333;
        margin-right: 10px;
    }

    .responsive-table {
        overflow-x: auto;
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
        z-index: 1000;
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

    /* Popup container */
    .popup {
        display: none;
        /* Ẩn popup mặc định */
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
        /* Màu nền mờ */
    }

    /* Popup content */
    .popup-content {
        background-color: white;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    /* Close button */
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    .modal-dialog-centered {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modal-custom-width .modal-dialog {
        max-width: 1000px;
    }

    .modal-content {
        margin: auto;
        border-radius: 1.3rem;
    }

    .error {
        color: red;
        /* Màu chữ đỏ cho thông báo lỗi */
        font-size: 12px;
    }

    .invalid {
        border: 2px solid red;
        /* Viền đỏ cho các ô nhập liệu không hợp lệ */
    }

    /* CSS để định dạng phần hiển thị chi tiết */
    .full-address {
        display: none;
        position: absolute;
        background-color: #888;
        border: 1px solid #888;
        padding: 10px;
        z-index: 1000;
        max-width: 400px;
        word-wrap: break-word;
        border-radius: 10px;
        color: #fff;
    }

    /* Màu nền xanh da trời nhạt cho các cột đặc biệt */
    .table th,
    .table td {
        vertical-align: middle;
    }

    .table .approval-status-col,
    .table .product-number-col,
    .table .inquiry-number-col,
    .table .shipping-status-col,
    .table .memo-col {
        background-color: rgb(172, 238, 247) !important;
        /* Màu xanh da trời nhạt */
        font-weight: bold;
        /* Làm nổi bật các cột */
    }

    /* Đảm bảo các cột đặc biệt có văn bản căn giữa */
    .table td,
    .table th {
        text-align: center;
    }

    /* Tăng cường hiệu ứng phân trang */
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

    .modal-content {
        width: 1000px;
        margin: auto;
    }

    /* Loại bỏ hiệu ứng hover khi readonly */
    #update_inquiry_number.readonly-hover:hover {
        background-color: initial;
        /* Giữ nguyên màu gốc */
        color: initial;
        /* Giữ nguyên màu chữ */
        cursor: not-allowed;
        /* Thay đổi con trỏ chuột */
    }
</style>
@endsection
@extends('layouts.app')
@section('content')
<main class="content" style="padding-top: 30px;">
    <div class="container-fluid p-0">
        {{-- Thông báo thành công --}}
        @if(session('success'))
        <div class="alert alert-success" id="success-alert">
            {{ session('success') }}
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <div class="row">
            <div class="col-xl-6 col-xxl-7">
                <div class="card flex-fill" style="border-radius: 20px;">
                    <div class="card-header" style="border-radius: 20px;">
                        <h5 class="card-title mb-0" style="color: black; font-size: 20px;">代理店情報</h5>
                    </div>
                    <div class="card-body">
                        <table id="customers">
                            <tr>
                                <td style="font-size: small;">会社名</td>
                                <td style="font-size: small;">{{ $business }}</td>
                            </tr>
                            <tr>
                                <td style="font-size: small;">担当者</td>
                                <td style="font-size: small;">{{ $username }}</td>
                            </tr>
                            <tr>
                                <td style="font-size: small;">電話番号</td>
                                <td style="font-size: small;">{{ $telephonenumber }}</td>
                            </tr>
                            <tr>
                                <td style="font-size: small;">メールアドレス</td>
                                <td style="font-size: small;">{{ $emailaddress }}</td>
                            </tr>
                            <tr>
                                <td style="font-size: small;">住所</td>
                                <td style="font-size: small;">{{ $address }}</td>
                            </tr>
                            <tr>
                                <td style="font-size: small;">納税者番号</td>
                                <td style="font-size: small;">{{ $tax_number }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-xxl-5 d-flex">
                <div class="w-100">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card" style="background-image: linear-gradient(45deg, rgb(64, 153, 255), rgb(115, 180, 255)); color: #fff; border-radius: 20px;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title" style="color:#fff">承認状況</h5>
                                        </div>
                                        <div class="col-auto">
                                            <div class="stat text-primary" style="background: #fff">
                                                <i class="align-middle" data-feather="check-circle"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3" style="color:#fff" id="approvedCount">{{ $approvedCount ?? '0' }}</h1> <!-- Hiển thị số lượng yêu cầu đã xác nhận -->
                                </div>
                            </div>
                            <div class="card" style="background-image: linear-gradient(45deg, rgb(255, 83, 112), rgb(255, 134, 154)); color: #fff; border-radius: 20px;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title" style="color:#fff">キャンセル</h5>
                                        </div>
                                        <div class="col-auto">
                                            <div class="stat text-primary" style="background: #fff">
                                                <i class="align-middle" data-feather="x-circle"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3" style="color:#fff" id="cancelledCount">{{ $cancelledCount ?? '0' }}</h1> <!-- Hiển thị số lượng yêu cầu đã huỷ bỏ -->
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="card" style="background-image: linear-gradient(45deg, rgb(119 90 48), rgb(255, 203, 128)); color: #fff; border-radius: 20px;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title" style="color:#fff">発送状況</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary" style="background: #fff">
                                                <i class="align-middle" data-feather="truck"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3" style="color:#fff" id="shippedCount">{{ $shippedCount }}</h1> <!-- Hiển thị số lượng yêu cầu đã gửi hoặc đưa tay -->
                                </div>
                            </div>
                            <div class="card" style="background-image: linear-gradient(45deg, rgb(46, 216, 182), rgb(89, 224, 197)); color: #fff; border-radius: 20px;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title" style="color:#fff">取消</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary" style="background: #fff">
                                                <i class="align-middle" data-feather="delete"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3" style="color:#fff" id="cancelledShippingCount">{{ $cancelledShippingCount }}</h1> <!-- Hiển thị số lượng yêu cầu hủy bỏ -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h1 class="h3 mb-3" style="text-align: center"><strong>注文一覧</strong></h1>
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm" style="border-radius: 20px;">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <input type="text" id="searchInput" class="form-control" style="width: 400px; border-radius: 20px;" placeholder="注文情報検索（商品番号、お問い合わせ番号）" onkeyup="searchTable()">
                        </div>
                        <div>
                            <button id="button_sim" class="btn btn-primary" style="height: 35px;border-radius: 20px;width: 100px;" onclick="openPopup()">注文依頼</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="dataTable">
                                <thead style="margin: 0;">
                                    <tr>
                                        <th class="text-center">順番</th>
                                        <th class="d-none d-xl-table-cell text-center">日付</th>
                                        <th class="d-none d-xl-table-cell text-center">納品種類</th>
                                        <th class="d-none d-xl-table-cell text-center">数量</th>
                                        <th class="d-none d-xl-table-cell text-center">プラン</th>
                                        <th class="d-none d-xl-table-cell text-center">納品希望日</th>
                                        <th class="d-none d-xl-table-cell text-center">郵便番号</th>
                                        <th class="d-none d-xl-table-cell text-center">お届け住所</th>
                                        <th class="d-none d-xl-table-cell text-center">お届け時間</th>
                                        <th class="d-none d-xl-table-cell text-center">発送タイプ</th>
                                        <th class="d-none d-xl-table-cell text-center">備考</th>
                                        <th class="text-center approval-status-col">承認状況</th>
                                        <th class="text-center product-number-col">商品番号</th>
                                        <th class="text-center inquiry-number-col">お問合せ番号</th>
                                        <th class="text-center shipping-status-col">発送状況</th>
                                        <th class="text-center memo-col">メモ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $index => $item)
                                    <tr class="order-row {{ in_array(Auth::user()->level, [2, 5]) ? 'clickable' : '' }}" data-id="{{ $item->id }}">
                                        <td class="order-index text-center">{{ $index + 1 }}</td>
                                        <td class="delivery_date text-center">{{ \Carbon\Carbon::parse($item->delivery_date)->format('Y/m/d') }}</td>
                                        <td class="delivery_type text-center">{{ $item->delivery_type }}</td>
                                        <td class="quantity text-center">{{ $item->quantity }}</td>
                                        <td class="plan text-center">{{ $item->plan }}</td>
                                        <td class="desired_delivery_date text-center">{{ \Carbon\Carbon::parse($item->desired_delivery_date)->format('Y/m/d') }}</td>
                                        <td class="postal_code text-center">{{ $item->postal_code }}</td>
                                        <td class="delivery_address text-center">{{ $item->delivery_address }}</td>
                                        <td class="delivery_time text-center">{{ $item->delivery_time }}</td>
                                        <td class="shipping_type text-center">{{ $item->shipping_type }}</td>
                                        <td class="notes text-center">{{ $item->notes }}</td>
                                        <td class="approval_status text-center">{{ $item->approval_status }}</td>
                                        <td class="product_number text-center">{{ $item->product_number }}</td>
                                        <td class="inquiry_number text-center">{{ $item->inquiry_number }}</td>
                                        <td class="shipping_status text-center">{{ $item->shipping_status }}</td>
                                        <td class="memo text-center">{{ $item->memo }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-muted">{{ $data->count() }} 件の結果</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Phần hiển thị chi tiết địa chỉ -->
        <div id="fullAddress" class="full-address"></div>
        <!-- Modal create-->
        <div class="modal fade" id="createOrderModal" aria-hidden="true" aria-labelledby="createOrderModalLabel" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 900px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="createOrderModalLabel" style="margin: auto;">注文依頼</h>
                    </div>
                    <div class="modal-body">
                        <form id="createOrderForm" method="POST" action="{{ route('order_sim.create') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="create_delivery_date" class="form-label">日付</label>
                                        <input type="date" name="delivery_date" id="create_delivery_date" class="form-control" placeholder="Ngày đặt hàng" required readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="create_delivery_type" class="form-label">納品種類</label>
                                        <select name="delivery_type" id="create_delivery_type" class="form-control" required>
                                            <option value="" selected>-- 選択してください --</option>
                                            <option value="【音声シム】ドコモシム">【音声シム】ドコモシム</option>
                                            <option value="【データシム】ソフトバンクシム">【データシム】ソフトバンクシム</option>
                                            <option value="【データシム】AU">【データシム】AU</option>
                                            <option value="【データシム】楽天">【データシム】楽天</option>
                                            <option value="【端末ルーター】">【端末ルーター】</option>
                                            <option value="不明">不明</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="create_quantity" class="form-label">数量</label>
                                        <input type="number" name="quantity" id="create_quantity" class="form-control" placeholder="Số lượng" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="create_plan" class="form-label">プラン</label>
                                        <select name="plan" id="create_plan" class="form-control" required>
                                            <option value="" selected>-- 選択してください --</option>
                                            <option value="1GB">1GB</option>
                                            <option value="3GB">3GB</option>
                                            <option value="5GB">5GB</option>
                                            <option value="7GB">7GB</option>
                                            <option value="10GB">10GB</option>
                                            <option value="15GB">15GB</option>
                                            <option value="20GB">20GB</option>
                                            <option value="25GB">25GB</option>
                                            <option value="30GB">30GB</option>
                                            <option value="50GB">50GB</option>
                                            <option value="100GB">100GB</option>
                                            <option value="FULLGB">FULLGB</option>
                                            <option value="不明">不明</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="create_notes" class="form-label">備考</label>
                                        <input type="text" name="notes" id="create_notes" class="form-control" placeholder="Ghi chú (Tên người nhận, Facebook, ...)" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="create_postal_code" class="form-label">郵便番号</label>
                                        <input type="text" name="postal_code" id="create_postal_code" class="form-control" placeholder="Mã bưu điện" required
                                            maxlength="8" oninput="formatPostalCode(this)">
                                    </div>
                                    <div class="mb-3">
                                        <label for="create_delivery_address" class="form-label">お届け住所</label>
                                        <input type="text" name="delivery_address" id="create_delivery_address" class="form-control" placeholder="Địa chỉ giao hàng" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="create_shipping_type" class="form-label">発送タイプ</label>
                                        <select name="shipping_type" id="create_shipping_type" class="form-control" required>
                                            <option value="" selected>-- 選択してください --</option>
                                            <option value="代引き">代引き</option>
                                            <option value="着払い">着払い</option>
                                            <option value="本払い">本払い</option>
                                            <option value="レンタバックライト">レンタバックライト</option>
                                            <option value="クリックポスト">クリックポスト</option>
                                            <option value="不明">不明</option>
                                            <option value="手渡し">手渡し</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="create_desired_delivery_date" class="form-label">納品希望日</label>
                                        <input type="date" name="desired_delivery_date" id="create_desired_delivery_date" class="form-control" placeholder="Ngày giao mong muốn" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="create_delivery_time" class="form-label">お届け時間</label>
                                        <select name="delivery_time" id="create_delivery_time" class="form-control" required>
                                            <option value="" selected>-- 選択してください --</option>
                                            <option value="午前中">午前中</option>
                                            <option value="12~14">12~14</option>
                                            <option value="14~16">14~16</option>
                                            <option value="16~18">16~18</option>
                                            <option value="18~20">18~20</option>
                                            <option value="19~21">19~21</option>
                                            <option value="不明">不明</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="button-container">
                                    <button type="submit" class="btn btn-primary" style="float: right;background-color:#00ad0e; width: 130px; height: 40px; border-radius: 15px;"
                                        onmouseover="this.style.backgroundColor='#007BFF'"
                                        onmouseout="this.style.backgroundColor='rgb(0, 165, 7)'">送信</button>
                                    <button type="button" class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal" style="background-color: red; width: 130px; height: 40px; border-radius: 15px;"
                                        onmouseover="this.style.backgroundColor='#007BFF'"
                                        onmouseout="this.style.backgroundColor='#f44336'">閉じる</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- The Modal Update -->
        <div class="modal fade" id="updateOrderModal" tabindex="-1" aria-labelledby="updateOrderModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="updateOrderModalLabel">Cập nhật đơn hàng</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="updateOrderForm" method="POST" action="" class="update-order-form">
                            @csrf
                            <input type="hidden" name="order_id" id="update_order_id">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="update_delivery_date" class="form-label">日付</label>
                                        <input type="date" name="delivery_date" id="update_delivery_date" class="form-control" placeholder="Ngày đặt hàng" required readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="update_delivery_type" class="form-label">納品種類</label>
                                        <input type="text" name="delivery_type" id="update_delivery_type" class="form-control" required readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="update_quantity" class="form-label">数量</label>
                                        <input type="number" name="quantity" id="update_quantity" class="form-control" placeholder="Số lượng" required readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="update_plan" class="form-label">プラン</label>
                                        <input type="text" name="plan" id="update_plan" class="form-control" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="update_notes" class="form-label">備考</label>
                                        <input type="text" name="notes" id="update_notes" class="form-control" placeholder="Ghi chú (Tên người nhận, Facebook, ...)" required readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="update_approval_status" class="form-label">承認状況</label>
                                        <select name="approval_status" id="update_approval_status" class="form-control">
                                            <option value="" selected>-- 選択してください --</option>
                                            <option value="承認済">承認済</option>
                                            <option value="キャンセル">キャンセル</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="update_product_number" class="form-label">商品番号</label>
                                        <input type="number" name="product_number" id="update_product_number" class="form-control" placeholder="Mã sản phẩm">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="update_postal_code" class="form-label">郵便番号</label>
                                        <input type="text" name="postal_code" id="update_postal_code" class="form-control" placeholder="Mã bưu điện" required readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="update_delivery_address" class="form-label">お届け住所</label>
                                        <input type="text" name="delivery_address" id="update_delivery_address" class="form-control" placeholder="Địa chỉ giao hàng" required readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="update_shipping_type" class="form-label">発送タイプ</label>
                                        <input type="text" name="shipping_type" id="update_shipping_type" class="form-control" required readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="update_desired_delivery_date" class="form-label">納品希望日</label>
                                        <input type="text" type="date" name="desired_delivery_date" id="update_desired_delivery_date" class="form-control" placeholder="Ngày giao mong muốn" required readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="update_delivery_time" class="form-label">お届け時間</label>
                                        <input type="text" name="delivery_time" id="update_delivery_time" class="form-control" required readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="update_inquiry_number" class="form-label">お問合せ番号</label>
                                        <input type="number" name="inquiry_number" id="update_inquiry_number" class="form-control" placeholder="Mã yêu cầu">
                                    </div>
                                    <div class="mb-3">
                                        <label for="update_shipping_status" class="form-label">発送状況</label>
                                        <select name="shipping_status" id="update_shipping_status" class="form-control">
                                            <option value="" selected>-- 選択してください --</option>
                                            <option value="発送済">発送済</option>
                                            <option value="手渡し">手渡し</option>
                                            <option value="取消し">取消し</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Thêm các trường bổ sung -->
                                <div class="mb-3">
                                    <label for="update_memo" class="form-label">メモ</label>
                                    <textarea name="memo" id="update_memo" class="form-control" placeholder="Ghi chú thêm"></textarea>
                                </div>

                                <div class="button-container">
                                    <button type="submit" class="btn btn-primary" style="float: right; background-color:#00ad0e; width: 130px; height: 40px; border-radius: 15px;"
                                        onmouseover="this.style.backgroundColor='#007BFF'"
                                        onmouseout="this.style.backgroundColor='rgb(0, 165, 7)'">送信</button>
                                    <button type="button" class="btn btn-danger" style="border-radius: 15px;width: 130px;"  data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal" 
                                        onmouseover="this.style.backgroundColor='#007BFF'"
                                        onmouseout="this.style.backgroundColor='#f44336'">閉じる</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal Delete Order -->
        <!-- <div class="modal fade" id="deleteOrderModal" tabindex="-1" aria-labelledby="deleteOrderModalLabel">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteOrderModalLabel">Xóa đơn hàng</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Bạn có chắc chắn muốn xóa đơn hàng này không?</p>
                        <form id="deleteOrderForm">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="order_id" id="delete_order_id">
                            <button type="submit">Xóa</button>
                            <button type="button" data-bs-dismiss="modal">Hủy</button>
                        </form>
                    </div>
                </div>
            </div>
        </div> -->
</main>
<script>
    function formatPostalCode(input) {
        let value = input.value.replace(/\D/g, ''); // Loại bỏ tất cả ký tự không phải là chữ số
        if (value.length > 3) {
            value = value.slice(0, 3) + '-' + value.slice(3, 7);
        }
        input.value = value;
    }

    function closePopup() {
        var editOrderModal = bootstrap.Modal.getInstance(document.getElementById('editOrderModal'));
        editOrderModal.hide();
    }

    // Đóng popup khi nhấn ra ngoài
    window.onclick = function(event) {
        var popup = document.getElementById("createOrderForm");
        if (event.target == popup) {
            popup.style.display = "none";
            // Lấy đối tượng form và reset lại giá trị
            document.getElementById("createOrderForm").reset();
        }
    }

    // Hàm mở Popup Modal khi nhấn nút
    function openPopup() {
        // Mở modal bằng Bootstrap's JavaScript API
        const createOrderModal = new bootstrap.Modal(document.getElementById('createOrderModal'));
        createOrderModal.show();
    }

    document.addEventListener("DOMContentLoaded", function() {
        const deliveryDateInput = document.getElementById("create_delivery_date");
        const desiredDeliveryDateInput = document.getElementById("create_desired_delivery_date");

        // Cập nhật ngày đặt hàng là ngày hiện tại khi tải trang
        const today = new Date().toISOString().split("T")[0];
        deliveryDateInput.value = today;
        deliveryDateInput.setAttribute("min", today);

        // Cập nhật min cho trường ngày giao mong muốn dựa trên ngày đặt hàng
        deliveryDateInput.addEventListener("change", function() {
            desiredDeliveryDateInput.setAttribute("min", this.value);
            // Đặt giá trị mặc định cho ngày giao mong muốn nếu rỗng
            if (desiredDeliveryDateInput.value < this.value) {
                desiredDeliveryDateInput.value = this.value;
            }
        });

        // Thiết lập giá trị min ban đầu cho trường ngày giao mong muốn
        desiredDeliveryDateInput.setAttribute("min", deliveryDateInput.value);

        // Tìm thông báo thành công
        var successAlert = document.getElementById('success-alert');
        if (successAlert) {
            // Thiết lập thời gian 3 giây để ẩn thông báo
            setTimeout(function() {
                successAlert.style.display = 'none';
            }, 2000);
        }
    });

    document.getElementById('create_quantity').addEventListener('input', function() {
        if (this.value < 1) {
            alert('Số lượng phải lớn hơn hoặc bằng 1');
            this.value = 1; // Tự động đặt lại về 1
        }
    });

    // Lắng nghe sự kiện nhấn chuột
    document.querySelectorAll('.delivery_address').forEach(function(element) {
        element.addEventListener('click', function(event) {
            var fullAddressDiv = document.getElementById('fullAddress');
            fullAddressDiv.innerText = this.innerText;
            var rect = this.getBoundingClientRect();

            // Định vị phần chi tiết
            fullAddressDiv.style.top = (rect.top + window.scrollY) + 'px';
            fullAddressDiv.style.left = (rect.left + window.scrollX) + 'px';

            // Hiển thị phần chi tiết
            fullAddressDiv.style.display = 'block';
        });
    });

    // Ẩn phần chi tiết khi nhấn ra ngoài
    document.addEventListener('click', function(event) {
        var fullAddressDiv = document.getElementById('fullAddress');
        if (!fullAddressDiv.contains(event.target) && !event.target.classList.contains('delivery_address')) {
            fullAddressDiv.style.display = 'none';
        }
    });

    // Lắng nghe sự kiện thay đổi trên dropdown update_shipping_status
    document.getElementById('update_shipping_status').addEventListener('change', function() {
        const inquiryInput = document.getElementById('update_inquiry_number');

        if (this.value === '手渡し') {
            // Thêm readonly và vô hiệu hóa hover
            inquiryInput.setAttribute('readonly', true);
            inquiryInput.classList.add('readonly-hover');
        } else {
            // Loại bỏ readonly và khôi phục hover
            inquiryInput.removeAttribute('readonly');
            inquiryInput.classList.remove('readonly-hover');
        }
    });

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.order-row.clickable').forEach(row => {
            row.addEventListener('click', async function(event) {
                if (!event.target.classList.contains('delivery_address')) {
                    const itemId = this.dataset.id;

                    if (!itemId) {
                        console.error('Không tìm thấy ID đơn hàng.');
                        return;
                    }

                    try {
                        const response = await fetch(`/order/${itemId}/edit`);
                        if (!response.ok) {
                            throw new Error(`Lỗi API: ${response.status} - ${response.statusText}`);
                        }
                        const data = await response.json();

                        // Kiểm tra nếu có lỗi trả về từ server
                        if (data.error) {
                            console.error(data.error);
                            alert(data.error); // Hiển thị thông báo lỗi nếu có
                            return;
                        }

                        // Đổ dữ liệu vào form modal
                        document.getElementById('update_order_id').value = data.id || '';
                        document.getElementById('update_delivery_date').value = data.delivery_date || '';
                        document.getElementById('update_delivery_type').value = data.delivery_type || '';
                        document.getElementById('update_quantity').value = data.quantity || '';
                        document.getElementById('update_plan').value = data.plan || '';
                        document.getElementById('update_desired_delivery_date').value = data.desired_delivery_date || '';
                        document.getElementById('update_postal_code').value = data.postal_code || '';
                        document.getElementById('update_delivery_address').value = data.delivery_address || '';
                        document.getElementById('update_delivery_time').value = data.delivery_time || '';
                        document.getElementById('update_shipping_type').value = data.shipping_type || '';
                        document.getElementById('update_notes').value = data.notes || '';
                        document.getElementById('update_approval_status').value = data.approval_status || '';
                        document.getElementById('update_product_number').value = data.product_number || '';
                        document.getElementById('update_inquiry_number').value = data.inquiry_number || '';
                        document.getElementById('update_shipping_status').value = data.shipping_status || '';
                        document.getElementById('update_memo').value = data.memo || '';

                        // Cập nhật action của form
                        const formAction = `/updateOrderSim/${data.id}`; // Tạo đường dẫn action đúng
                        document.querySelector('.update-order-form').action = formAction;

                        // Hiển thị modal
                        const updateOrderModal = new bootstrap.Modal(document.getElementById('updateOrderModal'));
                        updateOrderModal.show();
                    } catch (error) {
                        console.error('Lỗi khi tìm nạp dữ liệu đơn hàng:', error);
                        alert('Không thể tải dữ liệu đơn hàng. Vui lòng thử lại sau.');
                    }
                }
            });
        });
    });
</script>
@endsection
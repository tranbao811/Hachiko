@section('css')
<style>
/* Đảm bảo bảng có chiều rộng 100% */
.table {
    width: 100%;
    table-layout: auto;
    border-collapse: collapse;
}

/* Thiết lập các border cho bảng */
.table th,
.table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
}

/* Định dạng màu nền cho các cột tiêu đề */
.table th {
    background-color: #f8f9fa;
    font-weight: bold;
    color: #555;
}

/* Cải thiện hiển thị cho các hàng khi di chuột qua */
.table tr:hover {
    background-color: #f1f1f1;
}

/* Cải thiện giao diện của ô tìm kiếm */
.search-container input {
    width: 300px;
    border-radius: 20px;
    padding: 10px;
    border: 1px solid #ccc;
    margin-right: 10px;
    font-size: 14px;
}

/* Cải thiện nút "Đăng ký WIFI" */
.button_wifi {
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 20px;
    font-size: 14px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.button_wifi:hover {
    background-color: rgb(3, 40, 209);
}
</style>
<style>
/* Màn hình nền tối */
.overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 90%;
    background: rgba(0, 0, 0, 0.5);
    display: none;
    /* Mặc định ẩn */
}

/* Popup */
.popup {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    display: none;
    /* Mặc định ẩn */
}



/* Kiểu dáng tổng thể của modal */
.modal-content {
    background-color: #f9f9f9;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    width: 1000px;
}

/* Kiểu dáng cho phần đầu modal */
.modal-header {
    border-bottom: 1px solid #ddd;
    padding-bottom: 10px;
}

.modal-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #333;
}

/* Kiểu dáng cho nhãn form */
.form-label {
    font-size: 1rem;
    font-weight: 500;
    color: #444;
}

/* Kiểu dáng cho các trường input */
.form-control {
    border-radius: 10px;
    padding: 10px;
    font-size: 1rem;
    border: 1px solid #ccc;
    transition: border-color 0.3s ease;
}

/* Kiểu dáng cho nút bấm */
.btn {
    font-weight: 600;
    padding: 10px 15px;
    border-radius: 15px;
    text-transform: uppercase;
}

.btn-primary {
    background-color: #00ad0e;
    border-color: #00ad0e;
}

.btn-danger {
    background-color: #dc3545;
    border-color: #dc3545;
}

.btn-primary:hover {
    background-color: #009e0a;
    border-color: #009e0a;
}

.btn-danger:hover {
    background-color: #c82333;
    border-color: #c82333;
}

/* Hiệu ứng khi focus vào trường input */
.form-control:focus {
    border-color: rgb(207, 0, 0);
    box-shadow: 0 0 5px rgb(173, 0, 0);
}

/* Kiểu dáng cho bố cục */
.row {
    margin-bottom: 15px;
}

.col-md-6 {
    padding-right: 15px;
    padding-left: 15px;
}

.button-container {
    display: flex;
    justify-content: space-between;
    padding-top: 15px;
}

.button-container button {
    width: 130px;
}

/* Đảm bảo modal luôn nằm giữa màn hình */
.modal-dialog {
    max-width: 1400px;
    /* Kích thước tối đa của modal */
    width: 100%;
}

.modal-dialog-centered {
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Định dạng nội dung bên trong modal */
.modal-content {
    border-radius: 15px;
    background-color: #f9f9f9;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    margin: auto;
    border-radius: 1.3rem;
}

select {
    padding: 8px 20px;
    /* Tạo khoảng cách cho các mục */
    border-radius: 8px;
    /* Bo tròn các góc */
    border: 2px solid #ccc;
    /* Đường viền nhẹ */
    font-size: 14px;
    /* Kích thước font */
    background-color: #f9f9f9;
    /* Màu nền cho dropdown */
    appearance: none;
    /* Xóa kiểu mặc định của dropdown */
    -webkit-appearance: none;
    -moz-appearance: none;
    width: 100%;
}

select:focus {
    border-color: #007BFF;
    /* Màu viền khi có focus */
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    /* Hiệu ứng đổ bóng khi focus */
}

option {
    padding: 10px;
    /* Tạo khoảng cách cho các mục trong dropdown */
    font-size: 14px;
    /* Kích thước font */
    border-radius: 5px;
    /* Bo góc các mục */
}

/* Hiệu ứng khi di chuột qua từng mục */
option:hover {
    background-color: #f0f0f0;
    /* Màu nền khi di chuột qua */
}

/* Thêm hiệu ứng hover cho từng màu sắc */
option[value="戻入"]:hover {
    background-color: darkred;
    /* Màu nền khi hover vào "戻入" */
}

option[value="獲得"]:hover {
    background-color: darkgreen;
    /* Màu nền khi hover vào "獲得" */
}

option[value="未定"]:hover {
    background-color: #ccc;
    /* Màu nền khi hover vào "未定" */
}
</style>
@endsection
@extends('layouts.app')
@section('content')
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<!-- Hiển thị lỗi nếu có -->
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<meta name="csrf-token" content="{{ csrf_token() }}">
<main class="content" style="padding-top: 30px;">
    <div class="container-fluid p-0">
        <div class="row">
            <h1 class="h3 mb-3" style="text-align: center"><strong>回線一覧</strong></h1>
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm" style="border-radius: 20px;">
                        <div class="search-container">
                            <input type="text" id="searchInput_WIFI"
                                style="width: 400px; border-radius: 20px; padding: 10px;"
                                placeholder="回線情報検索（電話番号、製造番号）" placeholder="注文情報検索（商品番号、お問い合わせ番号）"
                                onkeyup="searchTable_WiFi()">
                            <button id="button_wifi" class="button_wifi"
                                style="background-color: #007bff; float:right; margin:auto" data-bs-toggle="modal"
                                data-bs-target="#wifiModal">
                                Đăng ký WIFI
                            </button>
                            <select name="entry_status" id="type_select"
                                style="padding: 10px; border-radius: 20px; border: 1px solid #ccc; margin-right: 10px;width: auto;"
                                onchange="filterTableByEntryStatus()">
                                <option value="">総合</option>
                                <option value="エントリー済み">エントリー済み</option>
                                <option value="エントリー待ち">エントリー待ち</option>
                                <option value="口座登録待ち">口座登録待ち</option>
                                <option value="後確待ち">後確待ち</option>
                                <option value="営業対応中">営業対応中</option>
                                <option value="キャンセル">キャンセル</option>
                                <option value="普段解約">普段解約</option>
                                <option value="短期・強制解約">短期・強制解約</option>
                                <option value="書類不備">書類不備</option>
                                <option value="エリア外">エリア外</option>
                                <option value="回線あり">回線あり</option>
                                <option value="NTT調査">NTT調査</option>
                            </select>
                        </div>
                        <div class="card-body" style="height: 610px">
                            <div style="overflow-y: auto; max-height: 590px;">
                                <table class="table table-striped table-bordered" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th class="d-none d-xl-table-cell">順番</th>
                                            <!-- Điều kiện hiển thị các cột dành cho người dùng có cấp độ 1, 2, 3, 4, 5 -->
                                            @php
                                            $userLevel = auth()->user()->level;
                                            @endphp
                                            @if(in_array($userLevel, [1, 2, 3, 4, 5]))
                                            <th class="d-none d-xl-table-cell"
                                                style="background-color: rgb(238, 255, 0) !important; font-weight: bold;">
                                                キャリア確定</th>
                                            <th class="d-none d-xl-table-cell"
                                                style="background-color: rgb(238, 255, 0) !important; font-weight: bold;">
                                                入金状況</th>
                                            <th class="d-none d-xl-table-cell"
                                                style="background-color: rgb(238, 255, 0) !important; font-weight: bold;">
                                                申込番号</th>
                                            <th class="d-none d-xl-table-cell"
                                                style="background-color: rgb(238, 255, 0) !important; font-weight: bold;">
                                                備考欄</th>
                                            @endif
                                            <!-- Các cột khác luôn hiển thị -->
                                            @if(in_array($userLevel, [1, 2, 3, 4, 5, 6]))
                                            <th class="d-none d-xl-table-cell">クルーコード</th>
                                            @endif
                                            <th class="d-none d-xl-table-cell">担当者名</th>
                                            <th class="d-none d-xl-table-cell">手数料金額</th>
                                            <th class="d-none d-xl-table-cell"
                                                style="background-color: rgb(90, 222, 255) !important; font-weight: bold;">
                                                支払状態</th>
                                            <th class="d-none d-xl-table-cell"
                                                style="background-color: rgb(90, 222, 255) !important; font-weight: bold;">
                                                年度</th>
                                            <th class="d-none d-xl-table-cell"
                                                style="background-color: rgb(90, 222, 255) !important; font-weight: bold;">
                                                受取状態時点</th>
                                            <th class="d-none d-xl-table-cell"
                                                style="background-color: rgb(0, 255, 21) !important; font-weight: bold;">
                                                販売先</th>
                                            <th class="d-none d-xl-table-cell"
                                                style="background-color: rgb(0, 255, 21) !important; font-weight: bold;">
                                                本氏名</th>
                                            <th class="d-none d-xl-table-cell"
                                                style="background-color: rgb(0, 255, 21) !important; font-weight: bold;">
                                                Facebook</th>
                                            <th class="d-none d-xl-table-cell">Hồ sơ</th>
                                            <th class="d-none d-xl-table-cell">SIM</th>
                                            <th class="d-none d-xl-table-cell">Cục phát</th>
                                            <th class="d-none d-xl-table-cell">Tình trạng gửi đơn</th>
                                            <th class="d-none d-xl-table-cell">Tình trạng cuộc gọi xác nhận</th>
                                            <th class="d-none d-xl-table-cell"
                                                style="background-color: rgb(0, 255, 21) !important; font-weight: bold;">
                                                申込日</th>
                                            <th class="d-none d-xl-table-cell"
                                                style="background-color: rgb(0, 255, 21) !important; font-weight: bold;">
                                                申込内容</th>
                                            <th class="d-none d-xl-table-cell"
                                                style="background-color: rgb(0, 255, 21) !important; font-weight: bold;">
                                                申込タイプ</th>
                                            <th class="d-none d-xl-table-cell"
                                                style="background-color: rgb(0, 255, 21) !important; font-weight: bold;">
                                                契約者名（TANAKA・TAROU）</th>
                                            <th class="d-none d-xl-table-cell"
                                                style="background-color: rgb(0, 255, 21) !important; font-weight: bold;">
                                                契約者名（タナカ・タロウ）</th>
                                            <th class="d-none d-xl-table-cell"
                                                style="background-color: rgb(0, 255, 21) !important; font-weight: bold;">
                                                申込者・性別</th>
                                            <th class="d-none d-xl-table-cell"
                                                style="background-color: rgb(0, 255, 21) !important; font-weight: bold;">
                                                申込者・生年月日</th>
                                            <th class="d-none d-xl-table-cell"
                                                style="background-color: rgb(0, 255, 21) !important; font-weight: bold;">
                                                連絡先※ハイフン（-）有り</th>
                                            @if(in_array($userLevel, [1, 2, 3, 4, 5, 6]))
                                            <th class="d-none d-xl-table-cell">後確担当者</th>
                                            @endif
                                            <th class="d-none d-xl-table-cell"
                                                style="background-color: rgb(0, 255, 21) !important; font-weight: bold;">
                                                後確時間帯</th>
                                            <th class="d-none d-xl-table-cell"
                                                style="background-color: rgb(0, 255, 21) !important; font-weight: bold;">
                                                メールアドレス</th>
                                            <th class="d-none d-xl-table-cell"
                                                style="background-color: rgb(0, 255, 21) !important; font-weight: bold;">
                                                国籍</th>
                                            <th class="d-none d-xl-table-cell"
                                                style="background-color: rgb(0, 255, 21) !important; font-weight: bold;">
                                                郵便番号※ハイフン無し</th>
                                            <th class="d-none d-xl-table-cell"
                                                style="background-color: rgb(0, 255, 21) !important; font-weight: bold;">
                                                住所 ※英数字記号は半角でご記入ください。</th>
                                            <th class="d-none d-xl-table-cell"
                                                style="background-color: rgb(0, 255, 21) !important; font-weight: bold;">
                                                回線設置先の建物のおおよその戸数を記入</th>
                                            <th class="d-none d-xl-table-cell"
                                                style="background-color: rgb(0, 255, 21) !important; font-weight: bold;">
                                                支払方法</th>
                                            <th class="d-none d-xl-table-cell"
                                                style="background-color: rgb(0, 255, 21) !important; font-weight: bold;">
                                                開通前レンタル</th>
                                            <th class="d-none d-xl-table-cell"
                                                style="background-color: rgb(0, 255, 21) !important; font-weight: bold;">
                                                工事希望日</th>
                                            <th class="d-none d-xl-table-cell"
                                                style="background-color: rgb(0, 255, 21) !important; font-weight: bold;">
                                                工事分割回数</th>
                                            <th class="d-none d-xl-table-cell"
                                                style="background-color: rgb(0, 255, 21) !important; font-weight: bold;">
                                                キャンペーン</th>
                                            <th class="d-none d-xl-table-cell">Tình trạng Entry</th>
                                            <th class="d-none d-xl-table-cell">Trình trạng lắp đặt</th>
                                            <th class="d-none d-xl-table-cell">工事タイプ</th>
                                            <th class="d-none d-xl-table-cell">工事日（NURO光の場合、自宅工事）</th>
                                            <th class="d-none d-xl-table-cell"
                                                style="background-color: rgb(255, 0, 221) !important; font-weight: bold;">
                                                開通日（NURO光の場合、外工事）</th>
                                            <th class="d-none d-xl-table-cell"
                                                style="background-color: rgb(255, 0, 221) !important; font-weight: bold;">
                                                月目</th>
                                            <th class="d-none d-xl-table-cell"
                                                style="background-color: rgb(255, 0, 221) !important; font-weight: bold;">
                                                年度</th>
                                            <th class="d-none d-xl-table-cell"
                                                style="background-color: rgb(255, 0, 221) !important; font-weight: bold;">
                                                TP-Link</th>
                                            <th class="d-none d-xl-table-cell"
                                                style="background-color: rgb(255, 0, 221) !important; font-weight: bold;">
                                                本人登録URL</th>
                                            <th class="d-none d-xl-table-cell"
                                                style="background-color: rgb(255, 0, 221) !important; font-weight: bold;">
                                                本人登録状況</th>
                                            <th class="d-none d-xl-table-cell"
                                                style="background-color: rgb(255, 0, 221) !important; font-weight: bold;">
                                                口座登録状況</th>
                                            @if(in_array($userLevel, [1, 2, 3, 4, 5, 6]))
                                            <th class="d-none d-xl-table-cell">在留番号</th>
                                            <th class="d-none d-xl-table-cell">資格状況</th>
                                            <th class="d-none d-xl-table-cell">在留カード共有先</th>
                                            @endif
                                            <th class="d-none d-xl-table-cell">備考欄</th>
                                            <th class="d-none d-xl-table-cell">処理状況記入欄</th>
                                            <th class="d-none d-xl-table-cell">状態欄</th>
                                            <th class="d-none d-xl-table-cell">月目</th>
                                            <th class="d-none d-xl-table-cell"
                                                style="background-color: rgb(90, 222, 255) !important; font-weight: bold;">
                                                確認欄</th>
                                            <th class="d-none d-xl-table-cell"
                                                style="background-color: rgb(255, 0, 221) !important; font-weight: bold;">
                                                ログインURL</th>
                                            <th class="d-none d-xl-table-cell"
                                                style="background-color: rgb(255, 0, 221) !important; font-weight: bold;">
                                                MYPAGE-ID</th>
                                            <th class="d-none d-xl-table-cell"
                                                style="background-color: rgb(255, 0, 221) !important; font-weight: bold;">
                                                パスワード</th>
                                            <th class="d-none d-xl-table-cell"
                                                style="background-color: rgb(255, 0, 221) !important; font-weight: bold;">
                                                支払確認状況（１回目）</th>
                                            <th class="d-none d-xl-table-cell"
                                                style="background-color: rgb(255, 0, 221) !important; font-weight: bold;">
                                                支払確認状況（２回目）</th>
                                            <th class="d-none d-xl-table-cell"
                                                style="background-color: rgb(255, 0, 221) !important; font-weight: bold;">
                                                支払確認状況（３回目）</th>
                                            @if(in_array($userLevel, [1, 2, 3, 4, 5, 6]))
                                            <th class="d-none d-xl-table-cell"
                                                style="background-color: rgb(90, 222, 255) !important; font-weight: bold;">
                                                支払状況</th>
                                            <th class="d-none d-xl-table-cell"
                                                style="background-color: rgb(90, 222, 255) !important; font-weight: bold;">
                                                支払メモ</th>
                                            <th class="d-none d-xl-table-cell"
                                                style="background-color: rgb(90, 222, 255) !important; font-weight: bold;">
                                                初月</th>
                                            <th class="d-none d-xl-table-cell"
                                                style="background-color: rgb(90, 222, 255) !important; font-weight: bold;">
                                                2月目</th>
                                            <th class="d-none d-xl-table-cell"
                                                style="background-color: rgb(90, 222, 255) !important; font-weight: bold;">
                                                3月目</th>
                                            <th class="d-none d-xl-table-cell"
                                                style="background-color: rgb(90, 222, 255) !important; font-weight: bold;">
                                                手数料</th>
                                            <th class="d-none d-xl-table-cell"
                                                style="background-color: rgb(90, 222, 255) !important; font-weight: bold;">
                                                合計</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $index => $item)
                                        <tr data-id="{{ $item->id }}">
                                            <td class="order-index">{{ $loop->iteration }}</td>
                                            @php
                                            $userLevel = auth()->user()->level;
                                            @endphp
                                            @if(in_array($userLevel, [1, 2, 3, 4, 5]))
                                            <td>
                                                <input type="checkbox"
                                                    {{ $item->career_confirmed == 1 ? 'checked' : '' }}
                                                    name="career_confirmed[{{ $item->id }}]">
                                            </td>
                                            <td>
                                                <select
                                                    style="padding: 5px 15px; border-radius: 5px; border: 1px solid #ccc; font-size: 14px; width: 60px;">
                                                    <option value="戻入" style="background-color: red; color: white;"
                                                        {{ $item->payment_status == '戻入' ? 'selected' : '' }}>戻入
                                                    </option>
                                                    <option value="獲得" style="background-color: green; color: white;"
                                                        {{ $item->payment_status == '獲得' ? 'selected' : '' }}>獲得
                                                    </option>
                                                    <option value="未定"
                                                        style="background-color: lightgray; color: black;"
                                                        {{ $item->payment_status == '未定' ? 'selected' : '' }}>未定
                                                    </option>
                                                </select>
                                            </td>
                                            <td class="application_number" contenteditable="false"
                                                style="max-width: 150px;">{{ $item->application_number }}</td>
                                            <td class="remarks" contenteditable="false" style="max-width: 150px;">
                                                {{ $item->remarks }}</td>
                                            @endif
                                            @if(in_array($userLevel, [1, 2, 3, 4, 5, 6]))
                                            <td class="crew_code" contenteditable="false" style="max-width: 150px;">
                                                {{ $item->crew_code }}</td>
                                            @endif
                                            <td class="person_in_charge" contenteditable="false"
                                                style="max-width: 150px;">{{ $item->person_in_charge }}</td>
                                            <td class="fee_amount" contenteditable="false" style="max-width: 150px;">
                                                {{ $item->fee_amount }}</td>
                                            <td class="payment_status_detail" contenteditable="false"
                                                style="max-width: 150px;">{{ $item->payment_status_detail }}</td>
                                            <td class="fiscal_year" contenteditable="false" style="max-width: 150px;">
                                                {{ $item->fiscal_year }}</td>
                                            <td class="receipt_status_at_time" contenteditable="false"
                                                style="max-width: 150px;">{{ $item->receipt_status_at_time }}</td>
                                            <td class="sales_destination" contenteditable="false"
                                                style="max-width: 150px;">{{ $item->sales_destination }}</td>
                                            <td class="full_name" contenteditable="false" style="max-width: 150px;">
                                                {{ $item->full_name }}</td>
                                            <td class="facebook_url" contenteditable="false" style="max-width: 150px;">
                                                {{ $item->facebook_url }}</td>
                                            <td class="profile" contenteditable="false" style="max-width: 150px;">
                                                {{ $item->profile }}</td>
                                            <td class="sim" contenteditable="false" style="max-width: 150px;">
                                                {{ $item->sim }}</td>
                                            <td class="router" contenteditable="false" style="max-width: 150px;">
                                                {{ $item->router }}</td>
                                            <td class="application_status" contenteditable="false"
                                                style="max-width: 150px;">{{ $item->application_status }}</td>
                                            <td class="confirmation_call_status" contenteditable="false"
                                                style="max-width: 150px;">{{ $item->confirmation_call_status }}</td>
                                            <td class="application_date" contenteditable="false"
                                                style="max-width: 150px;">{{ $item->application_date }}</td>
                                            <td class="application_details" contenteditable="false"
                                                style="max-width: 150px;">{{ $item->application_details }}</td>
                                            <td class="application_type" contenteditable="false"
                                                style="max-width: 150px;">{{ $item->application_type }}</td>
                                            <td class="contractor_name_kanji" contenteditable="false"
                                                style="max-width: 150px;">{{ $item->contractor_name_kanji }}</td>
                                            <td class="contractor_name_kana" contenteditable="false"
                                                style="max-width: 150px;">{{ $item->contractor_name_kana }}</td>
                                            <td class="applicant_gender" contenteditable="false"
                                                style="max-width: 150px;">{{ $item->applicant_gender }}</td>
                                            <td class="applicant_birthdate" contenteditable="false"
                                                style="max-width: 150px;">{{ $item->applicant_birthdate }}</td>
                                            <td class="contact_number" contenteditable="false"
                                                style="max-width: 150px;">{{ $item->contact_number }}</td>
                                            @if(in_array($userLevel, [1, 2, 3, 4, 5, 6]))
                                            <td class="post_confirmation_person" contenteditable="false"
                                                style="max-width: 150px;">{{ $item->post_confirmation_person }}</td>
                                            @endif
                                            <td class="post_confirmation_time" contenteditable="false"
                                                style="max-width: 150px;">{{ $item->post_confirmation_time }}</td>
                                            <td class="email" contenteditable="false" style="max-width: 150px;">
                                                {{ $item->email }}</td>
                                            <td class="nationality" contenteditable="false" style="max-width: 150px;">
                                                {{ $item->nationality }}</td>
                                            <td class="postal_code" contenteditable="false" style="max-width: 150px;">
                                                {{ $item->postal_code }}</td>
                                            <td class="address" contenteditable="false" style="max-width: 150px;">
                                                {{ $item->address }}</td>
                                            <td class="estimated_households_count" contenteditable="false"
                                                style="max-width: 150px;">{{ $item->estimated_households_count }}</td>
                                            <td class="payment_method" contenteditable="false"
                                                style="max-width: 150px;">{{ $item->payment_method }}</td>
                                            <td class="pre_installation_rental" contenteditable="false"
                                                style="max-width: 150px;">{{ $item->pre_installation_rental }}</td>
                                            <td class="construction_request_date" contenteditable="false"
                                                style="max-width: 150px;">{{ $item->construction_request_date }}</td>
                                            <td class="construction_payment_installments" contenteditable="false"
                                                style="max-width: 150px;">{{ $item->construction_payment_installments }}
                                            </td>
                                            <td class="campaign" contenteditable="false" style="max-width: 150px;">
                                                {{ $item->campaign }}</td>
                                            <td class="entry_status" contenteditable="false" style="max-width: 150px;">
                                                {{ $item->entry_status }}</td>
                                            <td class="installation_status" contenteditable="false"
                                                style="max-width: 150px;">{{ $item->installation_status }}</td>
                                            <td class="construction_type" contenteditable="false"
                                                style="max-width: 150px;">{{ $item->construction_type }}</td>
                                            <td class="construction_date" contenteditable="false"
                                                style="max-width: 150px;">{{ $item->construction_date }}</td>
                                            <td class="opening_date" contenteditable="false" style="max-width: 150px;">
                                                {{ $item->opening_date }}</td>
                                            <td class="month_number" contenteditable="false" style="max-width: 150px;">
                                                {{ $item->month_number }}</td>
                                            <td class="fiscal_year_again" contenteditable="false"
                                                style="max-width: 150px;">{{ $item->fiscal_year_again }}</td>
                                            <td class="tp_link" contenteditable="false" style="max-width: 150px;">
                                                {{ $item->tp_link }}</td>
                                            <td class="registration_url" contenteditable="false"
                                                style="max-width: 150px;">{{ $item->registration_url }}</td>
                                            <td class="registration_status" contenteditable="false"
                                                style="max-width: 150px;">{{ $item->registration_status }}</td>
                                            <td class="account_registration_status" contenteditable="false"
                                                style="max-width: 150px;">{{ $item->account_registration_status }}</td>
                                            @if(in_array($userLevel, [1, 2, 3, 4, 5, 6]))
                                            <td class="residence_card_number" contenteditable="false"
                                                style="max-width: 150px;">{{ $item->residence_card_number }}</td>
                                            <td class="qualification_status" contenteditable="false"
                                                style="max-width: 150px;">{{ $item->qualification_status }}</td>
                                            <td>
                                                <input type="checkbox"
                                                    {{ $item->residence_card_shared_with == 1 ? 'checked' : '' }}
                                                    disabled>
                                            </td>
                                            <td class="remarks_detail" contenteditable="false"
                                                style="max-width: 150px;">{{ $item->remarks_detail }}</td>
                                            @endif
                                            <td class="processing_status" contenteditable="false"
                                                style="max-width: 150px;">{{ $item->processing_status }}</td>
                                            <td class="status" contenteditable="false" style="max-width: 150px;">
                                                {{ $item->status }}</td>
                                            <td class="month_number_again" contenteditable="false"
                                                style="max-width: 150px;">{{ $item->month_number_again }}</td>
                                            <td class="confirmation_field" contenteditable="false"
                                                style="max-width: 150px;">{{ $item->confirmation_field }}</td>
                                            <td class="login_url" contenteditable="false" style="max-width: 150px;">
                                                {{ $item->login_url }}</td>
                                            <td class="mypage_id" contenteditable="false" style="max-width: 150px;">
                                                {{ $item->mypage_id }}</td>
                                            <td class="password" contenteditable="false" style="max-width: 150px;">
                                                {{ $item->password }}</td>
                                            <td class="payment_confirmation_status_1" contenteditable="false"
                                                style="max-width: 150px;">{{ $item->payment_confirmation_status_1 }}
                                            </td>
                                            <td class="payment_confirmation_status_2" contenteditable="false"
                                                style="max-width: 150px;">{{ $item->payment_confirmation_status_2 }}
                                            </td>
                                            <td class="payment_confirmation_status_3" contenteditable="false"
                                                style="max-width: 150px;">{{ $item->payment_confirmation_status_3 }}
                                            </td>
                                            @if(in_array($userLevel, [1, 2, 3, 4, 5, 6]))
                                            <td class="payment_status_detail_final" contenteditable="false"
                                                style="max-width: 150px;">{{ $item->payment_status_detail_final }}</td>
                                            <td class="payment_memo" contenteditable="false" style="max-width: 150px;">
                                                {{ $item->payment_memo }}</td>
                                            <td class="first_month" contenteditable="false" style="max-width: 150px;">
                                                {{ $item->first_month }}</td>
                                            <td class="second_month" contenteditable="false" style="max-width: 150px;">
                                                {{ $item->second_month }}</td>
                                            <td class="third_month" contenteditable="false" style="max-width: 150px;">
                                                {{ $item->third_month }}</td>
                                            <td class="fee" contenteditable="false" style="max-width: 150px;">
                                                {{ $item->fee }}</td>
                                            <td class="total" contenteditable="false" style="max-width: 150px;">
                                                {{ $item->total }}</td>
                                            @endif
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
        </div>
    </div>

    <div class="modal fade" id="wifiModal" tabindex="-1" aria-labelledby="wifiModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="wifiModalLabel">Đăng ký WIFI</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="orderForm" action="{{ route('wifi.create_wificodinh') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="mb-3">
                                <label for="sales_destination" class="form-label">販売先 (Nơi bán)</label>
                                <input type="text" class="form-control" id="sales_destination" name="sales_destination"
                                    placeholder="Nhập nơi bán" value="{{ old('sales_destination', $username) }}"
                                    required readonly>
                            </div>
                            <div class="mb-3">
                                <label for="full_name" class="form-label">本氏名 (Tên đầy đủ)</label>
                                <input type="text" class="form-control" id="full_name" name="full_name"
                                    placeholder="Nhập tên đầy đủ" required>
                            </div>
                            <div class="mb-3">
                                <label for="facebook_url" class="form-label">Facebook</label>
                                <input type="text" class="form-control" id="facebook_url" name="facebook_url"
                                    placeholder="Nhập Facebook">
                            </div>
                            <div class="mb-3">
                                <label for="application_date" class="form-label">申込日 (Ngày đăng ký)</label>
                                <input type="date" class="form-control" id="application_date" name="application_date"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="application_details" class="form-label">申込内容 (Nội dung đăng ký)</label>
                                <select class="form-control" id="application_details" name="application_details"
                                    required>
                                    <option value="" disabled selected>選択してください</option> <!-- Lựa chọn mặc định -->
                                    @foreach ($application_details as $content)
                                    <option value="{{ $content->id }}">{{ $content->content_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="application_types" class="form-label">申込タイプ (Loại đăng ký)</label>
                                <select class="form-control" id="application_types" name="application_types" required>
                                    <option value="" disabled selected>選択してください</option>
                                    @foreach ($application_types as $type)
                                    <option value="{{ $type->id }}">{{ $type->type_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Khoảng cách giữa 2 trường với màu nền đỏ -->
                            <div class="mb-3" style="background-color: red; height: 1px;"></div>

                            <div class="mb-3">
                                <label for="contractor_name_kanji" class="form-label">契約者名（TANAKA・TAROU）</label>
                                <input type="text" class="form-control" id="contractor_name_kanji"
                                    name="contractor_name_kanji" placeholder="Nhập tên Kanji" required>
                            </div>
                            <div class="mb-3">
                                <label for="contractor_name_kana" class="form-label">契約者名（タナカ・タロウ）</label>
                                <input type="text" class="form-control" id="contractor_name_kana"
                                    name="contractor_name_kana" placeholder="Nhập tên Kana" required>
                            </div>
                            <div class="mb-3">
                                <label for="applicant_gender" class="form-label">申込者・性別 (Giới tính)</label>
                                <select class="form-control" id="applicant_gender" name="applicant_gender">
                                    <option value="" selected>-- 選択してください --</option>
                                    <option value="男">男性 (Nam)</option>
                                    <option value="女">女性 (Nữ)</option>
                                    <option value="不明">不明 (Không rõ ràng)</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="applicant_birthdate" class="form-label">申込者・生年月日 (Ngày sinh)</label>
                                <input type="date" class="form-control" id="applicant_birthdate"
                                    name="applicant_birthdate" required>
                            </div>

                            <div class="mb-3">
                                <label for="contact_number" class="form-label">連絡先※ハイフン（-）有り (Số liên lạc)</label>
                                <input type="text" class="form-control" id="contact_number" name="contact_number"
                                    placeholder="VD: 090-1234-5678" required>
                            </div>
                            <div class="mb-3">
                                <label for="post_confirmation_time" class="form-label">後確時間帯 (Thời gian xác
                                    nhận)</label>
                                <input type="time" class="form-control" id="post_confirmation_time"
                                    name="post_confirmation_time" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">メールアドレス (Email)</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Nhập email" required>
                            </div>
                            <div class="mb-3">
                                <label for="nationality" class="form-label">国籍 (Quốc tịch)</label>
                                <select class="form-control" name="nationality" id="nationality" required>
                                    <option value="" disabled selected>選択してください</option>
                                    @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name_ja }} ({{ $country->name_en }})
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Khoảng cách giữa 2 trường với màu nền đỏ -->
                            <div class="mb-3" style="background-color: red; height: 1px;"></div>

                            <div class="mb-3">
                                <label for="postal_code" class="form-label">郵便番号 (Mã bưu điện)</label>
                                <input type="text" class="form-control" id="postal_code" name="postal_code"
                                    placeholder="Nhập mã bưu điện" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">住所 (Địa chỉ)</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    placeholder="Nhập địa chỉ" required>
                            </div>
                            <div class="mb-3">
                                <label for="estimated_households_count" class="form-label">回線設置先の建物のおおよその戸数 (Số căn hộ
                                    ước tính)</label>
                                <input type="number" class="form-control" id="estimated_households_count"
                                    name="estimated_households_count" placeholder="Nhập số căn hộ" min="1">
                            </div>
                            <div class="mb-3">
                                <label for="payment_method" class="form-label">支払方法 (Phương thức thanh toán)</label>
                                <select class="form-control" id="payment_method" name="payment_method" required>
                                    <option value="" disabled selected>選択してください</option> <!-- Lựa chọn mặc định -->
                                    <option value="クレジット">クレジット (Thẻ tín dụng)</option>
                                    <option value="口座">口座 (Tài khoản ngân hàng)</option>
                                    <option value="コンビニ">コンビニ (Cửa hàng tiện lợi)</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="pre_installation_rental" class="form-label">開通前レンタル (Cho thuê trước khi cài
                                    đặt)</label>
                                <select class="form-control" id="pre_installation_rental" name="pre_installation_rental"
                                    required>
                                    <option value="" disabled selected>選択してください</option> <!-- Lựa chọn mặc định -->
                                    <option value="有">有 (Có)</option>
                                    <option value="無">無 (Không)</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="construction_request_date" class="form-label">工事希望日 (Ngày thi công mong
                                    muốn)</label>
                                <select class="form-control" name="construction_request_date"
                                    id="construction_request_date" required>
                                    <option value="" disabled selected>選択してください</option>
                                    @foreach ($construction_dates as $construction_date)
                                    <option value="{{ $construction_date->id }}">{{ $construction_date->date_option }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="construction_payment_installments" class="form-label">工事分割回数 (Số lần thanh
                                    toán)</label>
                                <select class="form-control" id="construction_payment_installments"
                                    name="construction_payment_installments" required>
                                    <option value="" disabled selected>選択してください</option> <!-- Lựa chọn mặc định -->
                                    <option value="一括">一括</option>
                                    <option value="分割（24回）">分割（24回）</option>
                                </select>
                                <div class="mb-3">
                                    <label for="campaign" class="form-label">キャンペーン (Khuyến mãi)</label>
                                    <select class="form-control" name="campaign" id="campaign" required>
                                        <option value="" disabled selected>選択してください</option>
                                        @foreach ($campaigns as $campaign)
                                        <option value="{{ $campaign->id }}">{{ $campaign->campaign_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <p><strong>【LƯU Ý QUAN TRỌNG】</strong></p>
                                <div class="important-notes"
                                    style="border: 1px solid #ccc; padding: 10px; margin-bottom: 20px; max-height: 300px; overflow-y: auto; background-color: #f9f9f9">
                                    <p><strong>* ĐỐI VỚI WIFI CỐ ĐỊNH CÁP QUANG（光回線）</strong><br>
                                        - Cước phí và ưu đãi tham khảo lại tại danh mục sản phẩm: <a
                                            href="https://hachikoservice.com/wi-fi-co-dinh/">Nhấn và đây</a>
                                        - Yêu cầu Quý khách vui lòng điền đầy đủ thông tin.</p>

                                    <p><strong>* ĐỐI VỚI WIFI CỐ ĐỊNH KHÔNG DÂY (Wifi Softbank Air・Home)</strong><br>
                                        - Cước phí và ưu đãi tham khảo lại tại danh mục sản phẩm: <a
                                            href="https://hachikoservice.com/wi-fi-co-dinh-khong-day/">Nhấn và đây</a>
                                        - Yêu cầu Quý khách vui lòng điền đầy đủ thông tin.</p>

                                    <p>＊Sau khi hoàn tất đơn đăng ký, hệ thống sẽ xử lý sau 1~3 ngày làm việc (Ngoại trừ
                                        Thứ 7, Chủ Nhật). Để xác nhận tình trạng đơn đăng ký Quý khách vui lòng liên hệ
                                        qua HOTLINE: 050-6866-1234 (24/7) hoặc Fanpage: <a
                                            href="https://www.facebook.com/hachikonetwork">www.facebook.com/hachikonetwork</a>
                                        (Hachiko Network - Dịch Vụ Viễn Thông Nhật Bản)</p>
                                </div>

                                <!-- Nút gửi -->
                                <div class="button-container mt-3">
                                    <button type="submit" class="btn btn-primary"
                                        style="float: right; margin: auto; background-color:#00ad0e; width: 130px; height: 40px; border-radius: 15px;"
                                        onmouseover="this.style.backgroundColor='#007BFF'"
                                        onmouseout="this.style.backgroundColor='rgb(0, 165, 7)'">送信</button>
                                    <button type="button" class="btn btn-danger"
                                        style="border-radius: 15px; margin: auto;width: 130px;" data-bs-dismiss="modal"
                                        onmouseover="this.style.backgroundColor='#007BFF'"
                                        onmouseout="this.style.backgroundColor='#f44336'">閉じる</button>
                                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</main>

<script>
document.getElementById('postal_code').addEventListener('input', function(event) {
    var postalCode = event.target.value.replace(/\D/g, ''); // Xóa tất cả ký tự không phải số
    if (postalCode.length <= 3) {
        event.target.value = postalCode; // Nếu chưa đủ 4 số, không thêm dấu '-'
    } else {
        event.target.value = postalCode.slice(0, 3) + '-' + postalCode.slice(3, 7); // Thêm dấu '-' sau 3 số
    }
});
document.getElementById('contact_number').addEventListener('input', function(event) {
    var phoneNumber = event.target.value.replace(/\D/g, ''); // Xóa mọi ký tự không phải số
    if (phoneNumber.length <= 3) {
        event.target.value = phoneNumber; // Nếu chưa đủ 4 số, không thêm dấu '-'
    } else if (phoneNumber.length <= 6) {
        event.target.value = phoneNumber.slice(0, 3) + '-' + phoneNumber.slice(3); // Thêm dấu '-' sau 3 số
    } else {
        event.target.value = phoneNumber.slice(0, 3) + '-' + phoneNumber.slice(3, 7) + '-' + phoneNumber.slice(
            7, 11); // Thêm dấu '-' sau 3 và 6 số
    }
});

// Lắng nghe sự kiện khi modal được đóng
var myModal = document.getElementById('wifiModal');
myModal.addEventListener('hidden.bs.modal', function(event) {
    // Reset form khi modal đóng
    document.getElementById('orderForm').reset();
});

document.addEventListener("DOMContentLoaded", function() {
    var today = new Date().toISOString().split('T')[0];
    document.getElementById('application_date').value = today;
    // document.getElementById('constructionDate').value = today;
    document.getElementById('application_date').min = today;
    document.getElementById('construction_request_date').min = today;
});

function searchTable_WiFi() {
    var input, filter, table, tr, td, i, j, txtValue, index = 1;
    input = document.getElementById('searchInput_WIFI');
    filter = input.value.toUpperCase();
    table = document.getElementById('dataTable');
    tr = table.getElementsByTagName('tr');

    // Lặp qua tất cả các hàng trong bảng và ẩn những hàng không khớp với truy vấn tìm kiếm
    for (i = 1; i < tr.length; i++) {
        tr[i].style.display = 'none';
        td = tr[i].getElementsByTagName('td');
        for (j = 0; j < td.length; j++) {
            if (td[j]) {
                txtValue = td[j].textContent || td[j].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = '';
                    // Cập nhật số lượng đơn hàng
                    tr[i].getElementsByClassName('order-index')[0].innerText = index++;
                    break;
                }
            }
        }
    }
}

function filterTableByEntryStatus() {
    var selectedStatus = document.getElementById("type_select").value; // Lấy giá trị chọn từ dropdown
    var table = document.getElementById("dataTable");
    var rows = table.getElementsByTagName("tr");

    // Lặp qua tất cả các hàng trong bảng (trừ hàng tiêu đề)
    for (var i = 1; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName("td");
        var entryStatusCell = cells[39]; // Cột "Tình trạng Entry" là cột thứ 34 (chỉ số 33)

        // Kiểm tra nếu có giá trị trong cột "Tình trạng Entry" và so sánh với giá trị đã chọn
        if (entryStatusCell) {
            var entryStatus = entryStatusCell.textContent || entryStatusCell.innerText;
            if (selectedStatus === "" || entryStatus === selectedStatus) {
                rows[i].style.display = ""; // Hiển thị hàng nếu khớp
            } else {
                rows[i].style.display = "none"; // Ẩn hàng nếu không khớp
            }
        }
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Lắng nghe sự kiện nhấn vào cột "application_number" và "remarks"
    document.querySelectorAll('.table td').forEach(function(cell) {
        // Khi nhấn vào một ô trong bảng
        cell.addEventListener('click', function(event) {
            // Kiểm tra nếu ô đang ở trạng thái không thể chỉnh sửa
            if (this.getAttribute('contenteditable') === 'false') {
                // Mở rộng cột và cho phép chỉnh sửa
                this.setAttribute('contenteditable', 'true');
                this.classList.add('expanded'); // Thêm lớp 'expanded' nếu cần thay đổi style

                // Đặt con trỏ vào ô khi mở rộng
                this.focus();

                // Ngừng sự kiện click truyền tiếp để không bị xử lý bởi document
                event.stopPropagation();
            }
        });

        // Lắng nghe sự kiện "blur" để tự động lưu khi người dùng rời khỏi ô
        cell.addEventListener('blur', function(event) {
            if (this.getAttribute('contenteditable') === 'true') {
                // Lấy giá trị đã chỉnh sửa
                var newValue = this.innerText.trim();

                if (newValue !== '') {
                    // Lưu giá trị mới vào server
                    autoSaveValue(this, newValue);
                }

                // Đặt lại chế độ không thể chỉnh sửa
                this.setAttribute('contenteditable', 'false');
                this.classList.remove('expanded');
            }
        });
    });

    // Lắng nghe sự kiện nhấn ra ngoài (click vào bất kỳ đâu ngoài các ô trong bảng)
    document.addEventListener('click', function(event) {
        const clickedOutside = !event.target.closest('.table td');

        if (clickedOutside) {
            // Lấy tất cả các ô đang mở rộng (contenteditable = true)
            document.querySelectorAll('.table td[contenteditable="true"]').forEach(function(cell) {
                // Thu nhỏ lại cột và dừng chế độ chỉnh sửa
                cell.setAttribute('contenteditable', 'false');
                cell.classList.remove('expanded');
            });
        }
    });
});

function autoSaveValue(cell, newValue) {
    // Xác định trường cần lưu từ class của ô
    const field = cell.classList.contains('application_number') ? 'application_number' :
        cell.classList.contains('remarks') ? 'remarks' :
        cell.classList.contains('crew_code') ? 'crew_code' :
        cell.classList.contains('person_in_charge') ? 'person_in_charge' :
        cell.classList.contains('fee_amount') ? 'fee_amount' :
        cell.classList.contains('payment_status_detail') ? 'payment_status_detail' :
        cell.classList.contains('fiscal_year') ? 'fiscal_year' :
        cell.classList.contains('receipt_status_at_time') ? 'receipt_status_at_time' :
        cell.classList.contains('sales_destination') ? 'sales_destination' :
        cell.classList.contains('full_name') ? 'full_name' :
        cell.classList.contains('facebook_url') ? 'facebook_url' :
        cell.classList.contains('profile') ? 'profile' :
        cell.classList.contains('sim') ? 'sim' :
        cell.classList.contains('router') ? 'router' :
        cell.classList.contains('application_status') ? 'application_status' :
        cell.classList.contains('confirmation_call_status') ? 'confirmation_call_status' :
        cell.classList.contains('application_date') ? 'application_date' :
        cell.classList.contains('application_details') ? 'application_details' :
        cell.classList.contains('application_type') ? 'application_type' :
        cell.classList.contains('contractor_name_kanji') ? 'contractor_name_kanji' :
        cell.classList.contains('contractor_name_kana') ? 'contractor_name_kana' :
        cell.classList.contains('applicant_gender') ? 'applicant_gender' :
        cell.classList.contains('applicant_birthdate') ? 'applicant_birthdate' :
        cell.classList.contains('contact_number') ? 'contact_number' :
        cell.classList.contains('post_confirmation_person') ? 'post_confirmation_person' :
        cell.classList.contains('post_confirmation_time') ? 'post_confirmation_time' :
        cell.classList.contains('email') ? 'email' :
        cell.classList.contains('nationality') ? 'nationality' :
        cell.classList.contains('postal_code') ? 'postal_code' :
        cell.classList.contains('address') ? 'address' :
        cell.classList.contains('estimated_households_count') ? 'estimated_households_count' :
        cell.classList.contains('payment_method') ? 'payment_method' :
        cell.classList.contains('pre_installation_rental') ? 'pre_installation_rental' :
        cell.classList.contains('construction_request_date') ? 'construction_request_date' :
        cell.classList.contains('construction_payment_installments') ? 'construction_payment_installments' :
        cell.classList.contains('campaign') ? 'campaign' :
        cell.classList.contains('entry_status') ? 'entry_status' :
        cell.classList.contains('installation_status') ? 'installation_status' :
        cell.classList.contains('construction_type') ? 'construction_type' :
        cell.classList.contains('construction_date') ? 'construction_date' :
        cell.classList.contains('opening_date') ? 'opening_date' :
        cell.classList.contains('month_number') ? 'month_number' :
        cell.classList.contains('fiscal_year_again') ? 'fiscal_year_again' :
        cell.classList.contains('tp_link') ? 'tp_link' :
        cell.classList.contains('registration_url') ? 'registration_url' :
        cell.classList.contains('registration_status') ? 'registration_status' :
        cell.classList.contains('account_registration_status') ? 'account_registration_status' :
        cell.classList.contains('residence_card_number') ? 'residence_card_number' :
        cell.classList.contains('qualification_status') ? 'qualification_status' :
        cell.classList.contains('remarks_detail') ? 'remarks_detail' :
        cell.classList.contains('processing_status') ? 'processing_status' :
        cell.classList.contains('status') ? 'status' :
        cell.classList.contains('month_number_again') ? 'month_number_again' :
        cell.classList.contains('confirmation_field') ? 'confirmation_field' :
        cell.classList.contains('login_url') ? 'login_url' :
        cell.classList.contains('mypage_id') ? 'mypage_id' :
        cell.classList.contains('password') ? 'password' :
        cell.classList.contains('payment_confirmation_status_1') ? 'payment_confirmation_status_1' :
        cell.classList.contains('payment_confirmation_status_2') ? 'payment_confirmation_status_2' :
        cell.classList.contains('payment_confirmation_status_3') ? 'payment_confirmation_status_3' :
        cell.classList.contains('payment_status_detail_final') ? 'payment_status_detail_final' :
        cell.classList.contains('payment_memo') ? 'payment_memo' :
        cell.classList.contains('first_month') ? 'first_month' :
        cell.classList.contains('second_month') ? 'second_month' :
        cell.classList.contains('third_month') ? 'third_month' :
        cell.classList.contains('fee') ? 'fee' :
        cell.classList.contains('total') ? 'total' : ''; // Điều kiện để xác định trường

    const id = cell.closest('tr').dataset.id; // Lấy ID từ thuộc tính data-id của hàng

    // Debug: kiểm tra giá trị gửi đi   
    console.log("Data to send:", {
        id: id,
        field: field,
        value: newValue
    });

    // Gửi yêu cầu lưu qua AJAX
    fetch('/update-field', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                'content'), // CSRF token từ meta
            },
            body: JSON.stringify({
                id: id,
                field: field,
                value: newValue
            })
        })
        .then(response => response.json())
        .then(data => {
            console.log('Response:', data); // Debug: kiểm tra phản hồi từ server
            if (data.success) {
                console.log('Đã lưu thành công!');
            } else {
                alert('Có lỗi xảy ra khi lưu!');
            }
        })
        .catch(error => {
            console.error('Có lỗi xảy ra:', error);
        });
}
</script>

@endsection
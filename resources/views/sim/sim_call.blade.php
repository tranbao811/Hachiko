@section('css')
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
</style>
@endsection
@extends('layouts.app')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<main class="content" style="padding-top: 30px;">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-xl-6 col-xxl-6 d-flex">
                <div class="w-100">
                    <div class="row">
                        <div class="col-sm-6" style="width: 48%">
                            <div class="card" style="background-image: linear-gradient(45deg, rgb(42, 142, 255), rgb(82, 162, 253)); color: #fff; border-radius: 20px;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title" style="color:#fff">開通済み</h5>
                                        </div>
                                        <div class="col-auto">
                                            <div class="stat text-primary" style="background: #fff">
                                                <i class="align-middle" data-feather="check-square"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="" style="color:#fff; margin-bottom: 0px;" id="group1Count">{{ $group1Count }}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6" style="width: 48%">
                            <div class="card" style="background-image: linear-gradient(rgb(28, 187, 140), rgb(28, 187, 140)); color: #fff; border-radius: 20px;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title" style="color:#fff">利用中</h5>
                                        </div>
                                        <div class="col-auto">
                                            <div class="stat text-primary" style="background: #fff">
                                                <i class="align-middle" data-feather="bar-chart"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="" style="color:#fff; margin-bottom: 0px;" id="group2Count">{{ $group2Count }}</h1>
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
                            <div class="card" style="background-image: linear-gradient(45deg, rgb(247, 38, 73), rgb(250, 66, 96)); color: #fff; border-radius: 20px;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title" style="color:#fff">解約済み</h5>
                                        </div>
                                        <div class="col-auto">
                                            <div class="stat text-primary" style="background: #fff">
                                                <i class="align-middle" data-feather="trash-2"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="" style="color:#fff; margin-bottom: 0px;" id="group3Count">{{ $group3Count }}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6" style="width: 48%">
                            <div class="card" style="background-image: linear-gradient(45deg, rgb(84 0 255) ,rgb(136 0 255) ); color: #fff;border-radius: 20px;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title" style="color:#fff">在庫</h5>
                                        </div>
                                        <div class="col-auto">
                                            <div class="stat text-primary" style="background: #fff">
                                                <i class="align-middle" data-feather="layers"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="" style="color:#fff; margin-bottom: 0px;" id="group4Count">{{ $group4Count }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h1 class="h3 mb-3" style="text-align: center"><strong>回線一覧</strong></h1>
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm" style="border-radius: 20px;">
                        <div class="card-header d-flex justify-content-between align-items-center" style="border-radius: 20px;">
                            <div>
                                <input type="text" id="searchInput_Sim" class="form-control" style="width: 400px; border-radius: 20px;" placeholder="回線情報検索（電話番号、製造番号）" onkeyup="searchTable_Sim()">
                            </div>
                            <div>
                                <button id="csv" class="btn btn-primary" style="border-radius: 20px;">ファイルCSV</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th class="text-center">順番</th>
                                            <th class="text-center">出荷日</th>
                                            <th class="text-center">電話番号</th>
                                            <th class="text-center">製造番号</th>
                                            <th class="text-center">プラン名</th>
                                            <th class="text-center">かけ放題</th>
                                            <th class="text-center">利用開始日</th>
                                            <th class="text-center">利用状況</th>
                                            <th class="text-center">解約日</th>
                                            <th class="text-center">備考</th>
                                            @if(in_array(auth()->user()->level, [1, 2, 4]) || (auth()->user()->level == 7 && auth()->user()->id_manager_admin == 2))
                                            <th class="text-center">Người quản lý</th>
                                            @endif
                                            <th class="text-center" style="width: 100px;">操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $index => $item)
                                        <tr data-id="{{ $item->id }}">
                                            <td class="order-index text-center">{{ $index + 1 }}</td>
                                            <td class="text-center">{{ \Carbon\Carbon::parse($item->shipping_date)->format('Y/m/d') }}</td>
                                            <td class="text-center">{{ $item->phone_number }}</td>
                                            <td class="text-center">{{ $item->serial_number }}</td>
                                            <td class="text-center">{{ $item->plan_name }}</td>
                                            <td class="text-center">{{ $item->unlimited_calls }}</td>
                                            <td class="text-center">{{ \Carbon\Carbon::parse($item->service_start_date)->format('Y/m/d') }}</td>
                                            <td class="text-center">
                                                @if($item->service_status)
                                                <a class="btn 
                                                    @if($item->service_status == '利用中') btn-success
                                                    @elseif($item->service_status == '解約済') btn-danger
                                                    @elseif($item->service_status == '再発行') btn-secondary
                                                    @elseif($item->service_status == '停止' || $item->service_status == '利用停止') btn-warning
                                                    @elseif($item->service_status == '在庫') btn-info
                                                    @else btn-primary @endif" style="width: 100%; border-radius: 20px;">
                                                    {{ $item->service_status }}
                                                </a>
                                                @endif
                                            </td>
                                            <!-- {{ \Carbon\Carbon::parse($item->cancellation_date)->format('Y/m/d') }} -->
                                            <td class="text-center">{{ $item->cancellation_date }}</td>
                                            <td class="text-center">{{ $item->memo }}</td>
                                            @if(in_array(auth()->user()->level, [1, 2, 4]) || (auth()->user()->level == 7 && auth()->user()->id_manager_admin == 2))
                                            <td class="text-center">{{ $item->admin->username ?? 'N/A' }}</td>
                                            @endif
                                            <td class="text-center">
                                                <button onclick="openPopup1(this)" class="btn btn-outline-primary" style="border-radius: 20px;">
                                                    <i class="fa-regular fa-share-from-square"></i> 選択
                                                </button>
                                            </td>
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
    <!-- Popup tải lên CSV -->
    <div id="popupContent" class="popup-container" style="display:none;">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="form-container"> <!-- style="max-width:500px;" -->
            <h2>CSVファイルをアップロード</h2>

            <!-- Chọn yêu cầu (Request type) -->
            <label for="requestType">ご依頼の選択：</label>
            <select id="requestType" required>
                <option value="" disabled selected>シート名を選択してください</option>
                <option value="開通">開通</option>
                <option value="停止">停止</option>
                <option value="再開">再開</option>
                <option value="再発行">再発行</option>
                <option value="解約">解約</option>
                <option value="かけ放題">かけ放題</option>
                <option value="データ変更">データ変更</option>
            </select>
            <br><br>

            <!-- Chọn 依頼日 -->
            <label for="requestDate">ご依頼の日付：</label>
            <input type="date" id="requestDate" required>
            <br><br>

            <!-- Chọn file CSV -->
            <input type="file" id="fileInput" accept=".csv" required onchange="previewCSV(event)">
            <br><br>

            <!-- Bảng hiển thị dữ liệu CSV trước khi tải lên -->
            <div id="csvPreview" style="max-height: 400px; overflow-y: auto; border: 1px solid #ddd; border-radius: 8px; padding: 10px;">
                <table id="csvTable" style="width: 100%; display: block; border-collapse: collapse;">
                    <thead style="background-color: #f8f9fa; display: table; width: 100%; table-layout: fixed;">
                        <tr>
                            <th class="d-none d-xl-table-cell">CSVファイル情報</th>
                        </tr>
                    </thead>
                    <tbody id="csvTableBody" style="display: block; overflow-y: auto; height: 300px; width: 100%; overflow-x: hidden;">
                        <!-- Dữ liệu CSV sẽ được chèn ở đây -->
                    </tbody>
                </table>
            </div>

            <!-- Nút upload -->
            <button type="button" style="margin-left: 200px; background-color:rgb(0, 165, 7); color: white; border: none; padding: 10px 20px; cursor: pointer; font-size: 16px; border-radius: 20px; transition: background-color 0.3s ease;"
                onmouseover="this.style.backgroundColor='#007BFF'"
                onmouseout="this.style.backgroundColor='rgb(0, 165, 7)'"
                onclick="uploadFile()">アップロード</button>

            <button type="button" style="float:right; margin-right: 200px; margin-top: 4px; margin-bottom: 4px; background-color: #f44336; color: white; border: none; padding: 10px 20px; cursor: pointer; font-size: 16px; border-radius: 20px; transition: background-color 0.3s ease;"
                onmouseover="this.style.backgroundColor='#007BFF'"
                onmouseout="this.style.backgroundColor='#f44336'"
                onclick="handleClose_popupContent()">閉じる</button>
        </div>
    </div>

    <!-- Lớp phủ (overlay) để làm mờ phần còn lại của trang -->
    <div class="overlay" id="overlay" onclick="closeAllPopups()"></div>

    <!-- Popup 1 -->
    <div id="popup1" class="popup" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: white; padding: 20px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5); z-index: 1000; border-radius: 10px; display: none; margin:0;">
        <h2>依頼選択</h2>
        <div class="button-container">
            <input type="hidden" id="selectedRowId" name="selectedRowId">
            <input type="hidden" id="selectedRequestName" name="selectedRequestName"> <!-- Hidden input to store the selected request name -->
            <button class="button" style="background-color: #007bff;" data-form-id="yeucau1" data-request-name="開通" onclick="showSelectedForm(this)">開通</button>
            <button class="button" style="background-color: #ffc107;" data-form-id="yeucau2" data-request-name="停止" onclick="showSelectedForm(this)">停止</button>
            <button class="button" style="background-color: #dc3545;" data-form-id="yeucau3" data-request-name="再開" onclick="showSelectedForm(this)">再開</button>
            <button class="button" style="background-color: #01a67c;" data-form-id="yeucau4" data-request-name="再発行" onclick="showSelectedForm(this)">再発行</button>
            <button class="button" style="background-color: #752d99;" data-form-id="yeucau5" data-request-name="データ変更" onclick="showSelectedForm(this)">データ変更</button>
            <button class="button" style="background-color: #040092;" data-form-id="yeucau6" data-request-name="かけ放題" onclick="showSelectedForm(this)">かけ放題</button>
            <button class="button" style="background-color: #ff0000;" data-form-id="yeucau7" data-request-name="解約" onclick="showSelectedForm(this)">解約</button>
        </div>
    </div>

    <div id="yeucau1" class="popup">
        <input type="hidden" id="selectedRowId" name="yeucau" value="開通">
        <!-- Nội dung form 1 -->
        <form id="editForm1" class="form-yeucau1" data-method="POST" onsubmit="submitForm('editForm1'); return false;">
            @csrf
            <h2>開通</h2>
            <div class="row">
                <div class="form-group">
                    <label for="editField1" class="form-label">出荷日</label>
                    <input type="text" id="editField1" class="form-control" placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label for="editField2" class="form-label">電話番号</label>
                    <input type="text" class="form-control" id="editField2" placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label for="editField3" class="form-label">製造番号</label>
                    <input type="text" class="form-control" id="editField3" placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label for="editField4" class="form-label">プラン名</label>
                    <select class="form-control" id="editField4" name="editField4" required>
                        <!-- <option value="未開通">未開通</option> -->
                        <option value="1GB">1GB</option>
                        <option value="3GB">3GB</option>
                        <option value="5GB">5GB</option>
                        <option value="7GB">7GB</option>
                        <option value="10GB">10GB</option>
                        <option value="15GB">15GB</option>
                        <option value="20GB">10GB</option>
                        <option value="25GB">25GB</option>
                        <option value="50GB">50GB</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="editField5" class="form-label">かけ放題</label>
                    <select id="editField5" class="form-control" name="editField5">
                        <option value="普通">普通</option>
                        <option value="5分以内">5分以内</option>
                        <option value="10分以内">10分以内</option>
                        <option value="15分以内">15分以内</option>
                        <option value="カケ放題">カケ放題</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="ngayyeucau" class="form-label">依頼日</label>
                    <input type="date" class="form-control" id="ngayyeucau" placeholder="" pattern="\d{4}-\d{2}-\d{2}">
                </div>
                <div class="button-group">
                    <button type="submit" class="confirm small-button">送信</button>
                    <button type="button" class="back small-button" onclick="closeAllPopups()">閉じる</button>
                </div>
            </div>
        </form>
    </div>
    <div id="yeucau2" class="popup">
        <input type="hidden" id="selectedRowId" name="yeucau" value="停止">
        <!-- Nội dung form 2 -->
        <form id="editForm2" class="form-yeucau2" data-method="POST" onsubmit="submitForm('editForm2'); return false;">
            @csrf
            <h2>停止</h2>
            <div class="row">
                <div class="form-group">
                    <label for="editField1" class="form-label">出荷日</label>
                    <input type="text" class="form-control" id="editField1" placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label for="editField2" class="form-label">電話番号</label>
                    <input type="text" class="form-control" id="editField2" placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label for="editField3" class="form-label">製造番号</label>
                    <input type="text" class="form-control" id="editField3" placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label for="editField4" class="form-label">プラン名</label>
                    <input type="text" class="form-control" id="editField4" placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label for="editField5" class="form-label">かけ放題</label>
                    <input type="text" class="form-control" id="editField5" placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label for="editField6" class="form-label">利用開始日</label>
                    <input type="text" class="form-control" id="editField6" placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label for="editField7" class="form-label">利用状況</label>
                    <input type="text" class="form-control" id="editField7" placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label for="ngayyeucau" class="form-label">依頼日</label>
                    <input type="date" class="form-control" id="ngayyeucau" placeholder="">
                </div>
                <div class="button-group">
                    <button type="submit" class="confirm small-button">送信</button>
                    <button type="button" class="back small-button" onclick="closeAllPopups()">閉じる</button>
                </div>
            </div>
        </form>
    </div>

    <div id="yeucau3" class="popup">
        <input type="hidden" id="selectedRowId" name="yeucau" value="再開">
        <!-- Nội dung form 3 -->
        <form id="editForm3" class="form-yeucau3" data-method="POST" onsubmit="submitForm('editForm3'); return false;">
            @csrf
            <h2>再開</h2>
            <div class="row">
                <div class="form-group">
                    <label for="editField1" class="form-label">出荷日</label>
                    <input type="text" class="form-control" id="editField1" placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label for="editField2" class="form-label">電話番号</label>
                    <input type="text" class="form-control" id="editField2" placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label for="editField3" class="form-label">製造番号</label>
                    <input type="text" class="form-control" id="editField3" placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label for="editField4" class="form-label">プラン名</label>
                    <input type="text" class="form-control" id="editField4" placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label for="editField5" class="form-label">かけ放題</label>
                    <input type="text" class="form-control" id="editField5" placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label for="editField6" class="form-label">利用開始日</label>
                    <input type="text" class="form-control" id="editField6" placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label for="editField7" class="form-label">利用状況</label>
                    <input type="text" class="form-control" id="editField7" placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label for="ngayyeucau" class="form-label">依頼日</label>
                    <input type="date" class="form-control" id="ngayyeucau" placeholder="">
                </div>
                <div class="button-group">
                    <button type="submit" class="confirm small-button">送信</button>
                    <button type="button" class="back small-button" onclick="closeAllPopups()">閉じる</button>
                </div>
            </div>
        </form>
    </div>
    <div id="yeucau4" class="popup">
        <input type="hidden" id="selectedRowId" name="yeucau" value="再発行">
        <!-- Nội dung form 4 -->
        <form id="editForm4" class="form-yeucau4" data-method="POST" onsubmit="submitForm('editForm4'); return false;">
            @csrf
            <h2>再発行</h2>
            <div class="row">
                <div class="form-group">
                    <label for="editField1" class="form-label">出荷日</label>
                    <input type="text" class="form-control" id="editField1" placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label for="editField2" class="form-label">電話番号</label>
                    <input type="text" class="form-control" id="editField2" placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label for="editField3" class="form-label">製造番号</label>
                    <input type="text" class="form-control" id="editField3" placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label for="editField4" class="form-label">プラン名</label>
                    <input type="text" class="form-control" id="editField4" placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label for="editField5" class="form-label">かけ放題</label>
                    <input type="text" class="form-control" id="editField5" placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label for="editField6" class="form-label">利用開始日</label>
                    <input type="text" class="form-control" id="editField6" placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label for="editField7" class="form-label">利用状況</label>
                    <input type="text" class="form-control" id="editField7" placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label for="loaisim" class="form-label">商材種類</label>
                    <input type="text" class="form-control" id="loaisim" name="loaisim" value="音声シム" readonly>
                </div>

                <div class="form-group">
                    <label for="ngayyeucau" class="form-label">依頼日</label>
                    <input type="date" class="form-control" id="ngayyeucau" placeholder="">
                </div>
                <div class="button-group">
                    <button type="submit" class="confirm small-button">送信</button>
                    <button type="button" class="back small-button" onclick="closeAllPopups()">閉じる</button>
                </div>
            </div>
        </form>
    </div>
    <div id="yeucau5" class="popup">
        <input type="hidden" id="selectedRowId" name="yeucau" value="データ変更">
        <!-- Nội dung form 5 -->
        <form id="editForm5" class="form-yeucau5" data-method="POST" onsubmit="submitForm('editForm5'); return false;">
            @csrf
            <h2>データ変更</h2>
            <div class="row">
                <div class="form-group">
                    <label for="editField1" class="form-label">出荷日</label>
                    <input type="text" class="form-control" id="editField1" placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label for="editField2" class="form-label">電話番号</label>
                    <input type="text" class="form-control" id="editField2" placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label for="editField3" class="form-label">製造番号</label>
                    <input type="text" class="form-control" id="editField3" placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label for="editField4" class="form-label">プラン名</label>
                    <select id="editField4" class="form-control" name="editField4">
                        <option value="1GB">1GB</option>
                        <option value="3GB">3GB</option>
                        <option value="5GB">5GB</option>
                        <option value="7GB">7GB</option>
                        <option value="10GB">10GB</option>
                        <option value="25GB">25GB</option>
                        <option value="50GB">50GB</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="editField5" class="form-label">かけ放題</label>
                    <input type="text" class="form-control" id="editField5" placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label for="editField6" class="form-label">利用開始日</label>
                    <input type="text" class="form-control" id="editField6" placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label for="editField7" class="form-label">利用状況</label>
                    <input type="text" class="form-control" id="editField7" placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label for="ngayyeucau" class="form-label">依頼日</label>
                    <input type="date" class="form-control" id="ngayyeucau" placeholder="">
                </div>
                <div class="button-group">
                    <button type="submit" class="confirm small-button">送信</button>
                    <button type="button" class="back small-button" onclick="closeAllPopups()">閉じる</button>
                </div>
            </div>
        </form>
    </div>
    <div id="yeucau6" class="popup">
        <input type="hidden" id="selectedRowId" name="yeucau" value="かけ放題">
        <!-- Nội dung form 6 -->
        <form id="editForm6" class="form-yeucau6" data-method="POST" onsubmit="submitForm('editForm6'); return false;">
            @csrf
            <h2>かけ放題</h2>
            <div class="row">
                <div class="form-group">
                    <label for="editField1" class="form-label">出荷日</label>
                    <input type="text" class="form-control" id="editField1" placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label for="editField2" class="form-label">電話番号</label>
                    <input type="text" class="form-control" id="editField2" placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label for="editField3" class="form-label">製造番号</label>
                    <input type="text" class="form-control" id="editField3" placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label for="editField4" class="form-label">プラン名</label>
                    <input type="text" class="form-control" id="editField4" placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label for="editField5" class="form-label">かけ放題</label>
                    <select id="editField5" class="form-control" name="editField5">
                        <option value="普通">普通</option>
                        <option value="5分以内">5分以内</option>
                        <option value="10分以内">10分以内</option>
                        <option value="15分以内">15分以内</option>
                        <option value="カケ放題">カケ放題</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="editField6" class="form-label">利用開始日</label>
                    <input type="text" class="form-control" id="editField6" placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label for="editField7" class="form-label">利用状況</label>
                    <input type="text" class="form-control" id="editField7" placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label for="ngayyeucau" class="form-label">依頼日</label>
                    <input type="date" class="form-control" id="ngayyeucau" placeholder="">
                </div>
                <div class="button-group">
                    <button type="submit" class="confirm small-button">送信</button>
                    <button type="button" class="back small-button" onclick="closeAllPopups()">閉じる</button>
                </div>
            </div>
        </form>
    </div>
    <div id="yeucau7" class="popup">
        <input type="hidden" id="selectedRowId" name="yeucau" value="解約">
        <!-- Nội dung form 7 -->
        <form id="editForm7" class="form-yeucau7" data-method="POST" onsubmit="submitForm('editForm7'); return false;">
            @csrf
            <h2>SIM解約</h2>
            <div class="row">
                <div class="form-group">
                    <label for="editField1" class="form-label">出荷日</label>
                    <input type="text" class="form-control" id="editField1" placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label for="editField2" class="form-label">電話番号</label>
                    <input type="text" class="form-control" id="editField2" placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label for="editField3" class="form-label">製造番号</label>
                    <input type="text" class="form-control" id="editField3" placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label for="editField4" class="form-label">プラン名</label>
                    <input type="text" class="form-control" id="editField4" placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label for="editField5" class="form-label">かけ放題</label>
                    <input type="text" class="form-control" id="editField5" placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label for="editField6" class="form-label">利用開始日</label>
                    <input type="text" class="form-control" id="editField6" placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label for="editField7" class="form-label">利用状況</label>
                    <input type="text" class="form-control" id="editField7" placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label for="editField11" class="form-label">解約日</label>
                    <input type="text" class="form-control" id="editField11" placeholder="SIM解約日" readonly>
                </div>
                <div class="form-group">
                    <label for="loaisim" class="form-label">商材種類</label>
                    <input type="text" class="form-control" id="loaisim" name="loaisim" value="音声シム" readonly>
                </div>

                <div class="form-group">
                    <label for="ngayyeucau" class="form-label">依頼日</label>
                    <input type="date" class="form-control" id="ngayyeucau" placeholder="">
                </div>
                <div class="button-group">
                    <button type="submit" class="confirm small-button">送信</button>
                    <button type="button" class="back small-button" onclick="closeAllPopups()">閉じる</button>
                </div>
            </div>
        </form>
    </div>
</main>

<script>
    let debounceTimeout;

    function searchTable_Sim() {
        // Dừng xử lý nếu người dùng gõ quá nhanh (debounce)
        clearTimeout(debounceTimeout);
        debounceTimeout = setTimeout(() => {
            var input = document.getElementById('searchInput_Sim');
            var filter = input.value.toUpperCase();
            var table = document.getElementById('dataTable');
            var tr = table.querySelectorAll('tr');

            // Tạo mảng lưu trữ các kết quả
            let rowsToDisplay = [];

            // Lặp qua tất cả các hàng trong bảng
            for (let i = 1; i < tr.length; i++) {
                let row = tr[i];
                let td = row.getElementsByTagName('td');
                let matchFound = false;

                // Tìm kiếm trong các cột thứ 2 và thứ 3 (電話番号 và 製造番号)
                for (let j = 2; j <= 3; j++) {
                    if (td[j]) {
                        let txtValue = td[j].textContent || td[j].innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            matchFound = true;
                            break;
                        }
                    }
                }

                // Thêm hoặc loại bỏ hàng vào mảng dựa trên kết quả tìm kiếm
                if (matchFound) {
                    rowsToDisplay.push(row);
                }
            }

            // Cập nhật DOM sau khi vòng lặp xong
            for (let i = 1; i < tr.length; i++) {
                let row = tr[i];
                // Nếu hàng có trong mảng rowsToDisplay thì hiển thị, ngược lại ẩn
                row.style.display = rowsToDisplay.includes(row) ? '' : 'none';
            }
        }, 300); // Tạm dừng 300ms giữa các lần gõ
    }

    document.addEventListener('DOMContentLoaded', function() {
        const currentDate = new Date().toISOString().split('T')[0];
        document.getElementById('requestDate').setAttribute('min', currentDate);
    });

    // Hàm đóng tất cả các popup
    function closeAllPopups() {
        document.getElementById('overlay').style.display = "none"; // Ẩn overlay
        const popups = document.querySelectorAll('.popup');
        popups.forEach(popup => popup.style.display = "none"); // Ẩn tất cả popup
        // Xóa dữ liệu trong trường "ngayyeucau" của các form
        const forms = document.querySelectorAll('form');
        forms.forEach(form => {
            const ngayYeuCauField = form.querySelector('#ngayyeucau');
            if (ngayYeuCauField) {
                ngayYeuCauField.value = ''; // Xóa giá trị của trường "ngayyeucau"
            }
        });
    }


    // Hàm mở popup1 (lựa chọn yêu cầu)
    function openPopup1(button) {
        // Tìm thẻ <tr> cha của nút được nhấn
        const row = button.closest('tr');
        const dataId = row.getAttribute('data-id'); // Lấy giá trị của data-id
        const rowData = Array.from(row.cells).map(cell => cell.textContent.trim());
        const servicestatus = rowData[7]; // Lấy trạng thái từ cột "利用状況"

        // Lưu dữ liệu vào localStorage để sử dụng sau
        localStorage.setItem('selectedRowData', JSON.stringify(rowData));
        localStorage.setItem('selectedRowId', dataId);

        // Hiển thị popup chọn yêu cầu
        document.getElementById('popup1').style.display = "block";
        document.getElementById('overlay').style.display = "block";

        // Ẩn/hiện các nút dựa trên trạng thái
        const buttons = document.querySelectorAll('#popup1 .button-container .button');
        buttons.forEach(button => {
            const formId = button.getAttribute('data-form-id');

            if (servicestatus === '在庫') {
                // Chỉ hiển thị nút yeucau1 và áp dụng hiệu ứng scale
                button.style.display = formId === 'yeucau1' ? 'inline-block' : 'none';
            } else if (servicestatus === '解約済') {
                // Chỉ hiển thị nút yeucau7 và áp dụng hiệu ứng scale
                button.style.display = formId === 'yeucau7' ? 'inline-block' : 'none';
            } else if (servicestatus === '利用停止' || servicestatus === '停止') {
                // Ẩn yeucau1 và yeucau2
                button.style.display = ['yeucau3', 'yeucau4', 'yeucau5', 'yeucau6', 'yeucau7'].includes(formId) ? 'inline-block' : 'none';
            } else if (servicestatus === '利用中') {
                // Ẩn yeucau1
                button.style.display = ['yeucau2', 'yeucau4', 'yeucau5', 'yeucau6', 'yeucau7'].includes(formId) ? 'inline-block' : 'none';
            } else if (servicestatus === '再発行') {
                // Ẩn yeucau4
                button.style.display = ['yeucau2', 'yeucau3', 'yeucau5', 'yeucau6', 'yeucau7'].includes(formId) ? 'inline-block' : 'none';
            } else {
                // Hiển thị tất cả các nút khác
                button.style.display = ['yeucau3', 'yeucau4', 'yeucau5', 'yeucau6'].includes(formId) ? 'inline-block' : 'none';
            }
        });

        // Xử lý riêng cho editForm7 dựa trên servicestatus
        const editForm7Buttons = document.querySelectorAll('#editForm7 button');
        editForm7Buttons.forEach(button => {
            if (servicestatus === '解約済' || servicestatus === '解約') {
                // Nếu servicestatus là "解約済", chỉ hiển thị nút có class "back"
                if (button.classList.contains('back')) {
                    button.style.display = 'inline-block'; // Hiển thị nút back
                } else {
                    button.style.display = 'none'; // Ẩn các nút khác
                }

                // Thêm lớp để vô hiệu hóa hover của form-group1 khi servicestatus là "解約済"
                const formGroup1 = document.querySelector('.form-group1');
                if (formGroup1) {
                    formGroup1.classList.add('disabled-hover'); // Thêm lớp 'disabled-hover'
                }
            } else {
                // Nếu servicestatus khác "解約済", hiển thị tất cả các nút và bỏ lớp 'disabled-hover'
                button.style.display = 'inline-block';

                // Bỏ lớp 'disabled-hover' nếu có
                const formGroup1 = document.querySelector('.form-group1');
                if (formGroup1) {
                    formGroup1.classList.remove('disabled-hover'); // Bỏ lớp 'disabled-hover'
                }
            }
        });

    }


    // Hàm hiển thị form yêu cầu khi nhấn nút
    function showSelectedForm(button) {
        const formId = button.getAttribute('data-form-id'); // Lấy form-id từ nút được chọn
        const requestName = button.textContent.trim(); // Lấy tên yêu cầu từ nội dung nút được chọn

        // Lưu tên yêu cầu đã chọn vào một input ẩn
        document.getElementById('selectedRequestName').value = requestName;

        // Lấy dữ liệu từ localStorage
        const rowData = JSON.parse(localStorage.getItem('selectedRowData'));

        if (!rowData) {
            alert("無効なデータです。もう一度お試しください。");
            closeAllPopups();
            return;
        }

        // Điền dữ liệu vào các trường trong form
        fillFormData(formId, rowData);

        // Đóng popup lựa chọn và mở form yêu cầu
        closeAllPopups();
        document.getElementById(formId).style.display = "block";
        document.getElementById('overlay').style.display = "block";
    }

    // Điền dữ liệu vào các trường trong form
    function fillFormData(formId, rowData) {
        const form = document.getElementById(formId);
        if (!form) return;

        // Mapping dữ liệu từ rowData vào form
        const [index, shippingDate, phoneNumber, serialNumber, planName, unlimitedCalls, serviceStartDate, serviceStatus, cancellationDate] = rowData;

        if (formId === 'yeucau1') {
            form.querySelector('#editField1').value = shippingDate || '';
            form.querySelector('#editField2').value = phoneNumber || '';
            form.querySelector('#editField3').value = serialNumber || '';
            form.querySelector('#editField4').value = planName || '';
            form.querySelector('#editField5').value = unlimitedCalls || '';
        } else if (formId === 'yeucau7') {
            form.querySelector('#editField1').value = shippingDate || '';
            form.querySelector('#editField2').value = phoneNumber || '';
            form.querySelector('#editField3').value = serialNumber || '';
            form.querySelector('#editField4').value = planName || '';
            form.querySelector('#editField5').value = unlimitedCalls || '';
            form.querySelector('#editField6').value = serviceStartDate || '';
            form.querySelector('#editField7').value = serviceStatus || '';
            form.querySelector('#editField11').value = cancellationDate || '';
        } else {
            form.querySelector('#editField1').value = shippingDate || '';
            form.querySelector('#editField2').value = phoneNumber || '';
            form.querySelector('#editField3').value = serialNumber || '';
            form.querySelector('#editField4').value = planName || '';
            form.querySelector('#editField5').value = unlimitedCalls || '';
            form.querySelector('#editField6').value = serviceStartDate || '';
            form.querySelector('#editField7').value = serviceStatus || '';
        }

        // Logic ẩn/hiện dựa trên serviceStatus
        if (serviceStatus === '解約済' || serviceStatus === '解約') {
            // Ẩn ngayyeucau (input và label)
            const ngayYeuCauInput = form.querySelector('#ngayyeucau');
            const ngayYeuCauLabel = form.querySelector('label[for="ngayyeucau"]');
            if (ngayYeuCauInput) ngayYeuCauInput.style.display = 'none';
            if (ngayYeuCauLabel) ngayYeuCauLabel.style.display = 'none';

            // Hiện editField11 (input và label)
            const editField11Input = form.querySelector('#editField11');
            const editField11Label = form.querySelector('label[for="editField11"]');
            if (editField11Input) editField11Input.style.display = '';
            if (editField11Label) editField11Label.style.display = '';
        } else {
            // Hiện ngayyeucau (input và label)
            const ngayYeuCauInput = form.querySelector('#ngayyeucau');
            const ngayYeuCauLabel = form.querySelector('label[for="ngayyeucau"]');
            if (ngayYeuCauInput) ngayYeuCauInput.style.display = '';
            if (ngayYeuCauLabel) ngayYeuCauLabel.style.display = '';

            // Ẩn editField11 (input và label)
            const editField11Input = form.querySelector('#editField11');
            const editField11Label = form.querySelector('label[for="editField11"]');
            if (editField11Input) editField11Input.style.display = 'none';
            if (editField11Label) editField11Label.style.display = 'none';
        }

        // Đặt ngày hiện tại cho ngayyeucau và giới hạn chọn ngày trong quá khứ
        const ngayYeuCauInput = form.querySelector('#ngayyeucau');
        if (ngayYeuCauInput) {
            const today = new Date().toISOString().split('T')[0];
            // ngayYeuCauInput.value = today; // Đặt giá trị mặc định là ngày hiện tại
            ngayYeuCauInput.min = today; // Không cho phép chọn ngày trong quá khứ
        }
    }

    // Hàm để hiển thị formData dưới dạng đối tượng
    function logFormData(formData) {
        const obj = {};
        formData.forEach((value, key) => {
            obj[key] = value;
        });
        console.log(obj);
    }

    function submitForm(formId) {
        const form = document.getElementById(formId);
        const formData = new FormData(form);
        const method = form.getAttribute('data-method') || 'POST';

        // Lấy id_sim từ hàng được chọn
        const idSim = localStorage.getItem('selectedRowId');
        if (!idSim) {
            alert('SIMが見つかりません。');
            return;
        }

        // Lấy tên yêu cầu đã chọn từ input ẩn
        const selectedRequestName = document.getElementById('selectedRequestName').value;
        const createdAt = form.querySelector('#ngayyeucau').value;
        const dataSimcall = form.querySelector('#editField4').value;
        const timeSimcall = form.querySelector('#editField5').value;
        const memo = ''; // Giá trị mặc định là chuỗi rỗng
        const confirmedAt = ''; // Giá trị mặc định là chuỗi rỗng

        if (!selectedRequestName) {
            alert('選択した要求名が見つかりません！');
            return;
        }
        if (!createdAt) {
            alert('日付選択');
            return;
        }

        // Xử lý các loại yêu cầu khác nhau
        if (['停止', '再開', '再発行', '解約'].includes(selectedRequestName)) {
            formData.append('id_sim', idSim);
            formData.append('request_name', selectedRequestName);
            formData.append('created_at', createdAt);
        } else if (['かけ放題'].includes(selectedRequestName)) {
            formData.append('id_sim', idSim);
            formData.append('time_simcall', timeSimcall);
            formData.append('memo', memo);
            formData.append('confirmed_at', confirmedAt);
            formData.append('created_at', createdAt);
            formData.append('request_name', selectedRequestName);
        } else if (['データ変更'].includes(selectedRequestName)) {
            formData.append('id_sim', idSim);
            formData.append('data_simcall', dataSimcall);
            formData.append('memo', memo);
            formData.append('confirmed_at', confirmedAt);
            formData.append('created_at', createdAt);
            formData.append('request_name', selectedRequestName);
        } else if (['開通'].includes(selectedRequestName)) {
            formData.append('id_sim', idSim);
            formData.append('data_simcall', dataSimcall);
            formData.append('time_simcall', timeSimcall);
            formData.append('memo', memo);
            formData.append('confirmed_at', confirmedAt);
            formData.append('created_at', createdAt);
            formData.append('request_name', selectedRequestName);
        } else {
            alert('リクエストはサポート対象外です！');
            return;
        }

        // Hiển thị dữ liệu form gửi đi (tuỳ chọn, có thể bỏ qua)
        logFormData(formData);

        // Gửi dữ liệu đến API
        fetch('/saveRequestSimCall', {
                method: 'POST',
                body: formData,
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Thành công:', data);
                alert('データが正常に送信されました！');
            })
            .catch(error => {
                console.error('エラーが発生しました!', error);
                alert(`データの送信に失敗しました ${error.message}`);
            });

        // Đóng popup sau khi gửi
        closeAllPopups();
    }

    // Đóng popup khi nhấn ra ngoài
    window.addEventListener("click", event => {
        if (event.target.id === 'overlay') {
            closeAllPopups();
        }
    });

    // Hàm này sẽ gửi yêu cầu AJAX để lấy thống kê mới
    function updateStats() {
        $.ajax({
            url: '/sim-call', // Gọi route API lấy dữ liệu thống kê
            method: 'GET',
            success: function(response) {
                // Cập nhật số liệu thống kê trên trang
                $('#group1Count').text(response.group1Count);
                $('#group2Count').text(response.group2Count);
                $('#group3Count').text(response.group3Count);
                $('#group4Count').text(response.group4Count);
            },
            error: function(xhr, status, error) {
                console.error('データの取得中にエラーが発生しました', error);
            }
        });
    }
</script>

<script>
    // Khi nhấn vào nút CSV, hiển thị popup
    document.getElementById('csv').addEventListener('click', function() {
        document.getElementById('popupContent').style.display = 'block'; // Hiển thị popup
    });

    // Khi nhấn vào nút đóng popup, ẩn popup và reset form
    function handleClose_popupContent() {
        document.getElementById('popupContent').style.display = 'none'; // Ẩn popup

        // Reset các phần tử trong form (Chọn ngày, chọn file, chọn yêu cầu)
        document.getElementById('requestType').value = ''; // Reset select
        document.getElementById('requestDate').value = ''; // Reset input ngày
        document.getElementById('fileInput').value = ''; // Reset input file
        document.getElementById('csvTableBody').innerHTML = ''; // Xóa dữ liệu trong bảng CSV preview
    }

    // Đảm bảo popup sẽ đóng lại khi nhấn vào bất kỳ nơi nào bên ngoài popup
    window.onclick = function(event) {
        const popup = document.getElementById('popupContent');
        if (event.target === popup) {
            popup.style.display = 'none'; // Ẩn popup nếu nhấn ngoài popup

            // Reset các phần tử trong form (Chọn ngày, chọn file, chọn yêu cầu)
            document.getElementById('requestType').value = ''; // Reset select
            document.getElementById('requestDate').value = ''; // Reset input ngày
            document.getElementById('fileInput').value = ''; // Reset input file
            document.getElementById('csvTableBody').innerHTML = ''; // Xóa dữ liệu trong bảng CSV preview
        }
    }

    // Hiển thị dữ liệu CSV trên bảng và kiểm tra số điện thoại ngay khi hiển thị
    function previewCSV(event) {
        const file = event.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function(e) {
            const content = e.target.result;
            const rows = content.split("\n").map(row => row.split(","));
            const tableBody = document.getElementById("csvTableBody");
            tableBody.innerHTML = ""; // Xóa dữ liệu trong bảng trước khi hiển thị mới

            let hasInvalidSim = false; // Biến kiểm tra xem có số điện thoại không hợp lệ không

            // Duyệt qua các dòng trong CSV
            rows.forEach(row => {
                if (row.length > 0 && row[0].trim()) {
                    const phoneNumber = row[0].trim(); // Lấy số điện thoại từ cột đầu tiên

                    // Tạo một dòng mới cho bảng
                    const tr = document.createElement("tr");

                    // Thêm dữ liệu vào bảng
                    row.forEach((cell, index) => {
                        const td = document.createElement("td");
                        td.textContent = cell.trim();
                        td.style.textAlign = index === 0 ? "left" : "center";
                        tr.appendChild(td);
                    });

                    // Kiểm tra số điện thoại trong bảng sim_call
                    checkSimExistAndDisplay(phoneNumber, tr, tableBody, () => {
                        // Nếu có số điện thoại không tồn tại, thay đổi trạng thái của nút
                        hasInvalidSim = true;
                        toggleUploadButton(hasInvalidSim);
                    });
                }
            });

            // Sau khi xử lý xong CSV, kiểm tra lại nút Upload
            toggleUploadButton(hasInvalidSim);
        };

        reader.readAsText(file);
    }

    // Kiểm tra sự tồn tại của số điện thoại trong bảng sim_call và hiển thị thông báo nếu không tồn tại
    function checkSimExistAndDisplay(phoneNumber, tr, tableBody, onInvalidSim) {
        fetch(`/get_id_sim_by_phone_number?phone_number=${phoneNumber}`)
            .then(response => response.json())
            .then(data => {
                if (!data.idSim) {
                    // Nếu không tìm thấy số điện thoại, thêm thông báo lỗi vào bảng
                    const errorTd = document.createElement("td");
                    errorTd.colSpan = tr.children.length; // Đảm bảo thông báo lỗi chiếm toàn bộ chiều rộng bảng
                    errorTd.textContent = `SIM無存在`;
                    errorTd.style.color = "red";
                    errorTd.style.textAlign = "center";
                    tr.appendChild(errorTd);

                    // Gọi callback khi phát hiện số điện thoại không tồn tại
                    onInvalidSim();
                }

                // Thêm dòng vào bảng sau khi kiểm tra
                tableBody.appendChild(tr);
            })
            .catch(error => {
                console.error(`電話番号の確認中にエラーが発生しました ${phoneNumber}`, error);

                // Thêm thông báo lỗi vào bảng nếu có lỗi trong quá trình kiểm tra
                const errorTd = document.createElement("td");
                errorTd.colSpan = tr.children.length; // Đảm bảo thông báo lỗi chiếm toàn bộ chiều rộng bảng
                errorTd.textContent = "電話番号の確認中にエラーが発生しました";
                errorTd.style.color = "red";
                errorTd.style.textAlign = "center";
                tr.appendChild(errorTd);

                // Gọi callback khi có lỗi trong kiểm tra
                onInvalidSim();
            });
    }

    // Thay đổi trạng thái của nút Upload
    function toggleUploadButton(hasInvalidSim) {
        const uploadButton = document.querySelector(".btn-upload");

        if (hasInvalidSim) {
            // Thêm hiệu ứng hover nếu có số điện thoại không hợp lệ
            uploadButton.style.cursor = "not-allowed";
            uploadButton.title = "アップロードできません。番号が無効です。"; // Hiển thị tooltip
            uploadButton.disabled = true; // Vô hiệu hóa nút
        } else {
            // Đổi lại trạng thái bình thường
            uploadButton.style.cursor = "pointer";
            uploadButton.title = ""; // Xóa tooltip
            uploadButton.disabled = false; // Kích hoạt lại nút
        }
    }
    // Hàm lưu yêu cầu
    function saveRequestCall(idSim, requestName, createAt, dataSimcall = null, timeSimcall = null, callback) {
        const requestData = {
            id_sim: idSim,
            request_name: requestName,
            created_at: createAt, // Sử dụng requestDate làm create_at
            data_simcall: dataSimcall,
            time_simcall: timeSimcall
        };

        fetch('/save_request_call', {
                method: 'POST',
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(requestData)
            })
            .then(response => {
                if (!response.ok) {
                    return response.text().then(text => {
                        throw new Error(`Server responded with status ${response.status}: ${text}`);
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.status === 'success') {
                    console.log('データが正常に保存されました - Dữ liệu đã được lưu thành công.');
                } else {
                    // Nếu có lỗi trong dữ liệu trả về, hiển thị thông báo
                    alert(`エラーが発生しました: ${data.message || 'Không xác định'}`);
                }
            })
            .catch(error => {
                // Xử lý các lỗi chi tiết hơn
                console.error('エラーが発生しました:', error);
                alert(`エラーが発生しました: ${error.message || 'もう一度お試しください。'}`);
            })
            .finally(() => callback()); // Gọi lại callback sau khi xử lý
    }

    // Hàm upload file và xử lý khi tất cả dữ liệu đã được lưu thành công
    function uploadFile() {
        const requestType = document.getElementById("requestType").value;
        const requestDate = document.getElementById("requestDate").value;
        const file = document.getElementById("fileInput").files[0];

        // Kiểm tra nếu người dùng chưa nhập đầy đủ thông tin
        if (!requestType || !requestDate || !file) {
            alert('すべての項目を入力してください！'); // Thông báo nếu thiếu thông tin
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            const content = e.target.result;
            const rows = content.split("\n").map(row => row.split(","));

            let totalRequests = 0; // Tổng số yêu cầu
            let completedRequests = 0; // Số yêu cầu đã xử lý
            let stopProcessing = false; // Biến để kiểm tra có dừng quá trình hay không

            // Định nghĩa stopProcessingCallback để dừng quá trình
            function stopProcessingCallback() {
                stopProcessing = true; // Khi gọi callback này, quá trình sẽ dừng
                console.log("電話番号が見つからないため、処理を中止しました。");
            }

            rows.forEach((row, index) => {
                if (stopProcessing) return; // Nếu đã dừng, không xử lý các số tiếp theo

                // Kiểm tra nếu dòng có dữ liệu hợp lệ
                const phoneNumber = row[0].trim();
                if (phoneNumber) {
                    totalRequests++; // Đếm số yêu cầu
                    getIdSimByPhoneNumber(phoneNumber, requestType, requestDate, row, totalRequests, () => {
                        completedRequests++; // Tăng số lượng hoàn tất
                        if (completedRequests === totalRequests) {
                            // Hiển thị thông báo khi tất cả hoàn tất
                            alert('すべてのデータが正常に保存されました - Tất cả dữ liệu đã được lưu thành công.');
                            document.getElementById('popupContent').style.display = 'none'; // Ẩn popup
                        }
                    }, () => {
                        stopProcessing = true;
                    }); // Truyền vào callback để dừng quá trình nếu cần
                }
            });
        };

        reader.readAsText(file);
    }

    // Định nghĩa hàm getIdSimByPhoneNumber
    function getIdSimByPhoneNumber(phoneNumber, requestType, requestDate, row, totalRequests, callback, stopProcessingCallback) {
        // Kiểm tra số điện thoại
        if (!phoneNumber || phoneNumber.length < 10) {
            alert('電話番号が無効です');
            stopProcessingCallback(); // Dừng quá trình nếu số điện thoại không hợp lệ
            return;
        }

        // Kiểm tra dữ liệu trước khi tìm idSim
        const dataSimcall = row[1]?.trim();
        const timeSimcall = row[2]?.trim();

        // Kiểm tra yêu cầu '停止', '再開', '再発行', '解約'
        if (['停止', '再開', '再発行', '解約'].includes(requestType)) {
            // Nếu có dữ liệu khác ngoài số điện thoại thì báo lỗi
            if (dataSimcall || timeSimcall) {
                alert('このリクエストには電話番号のみが必要です。ファイル情報が正しくありませんので、もう一度お試しください。');
                stopProcessingCallback(); // Dừng quá trình nếu có dữ liệu khác
                return;
            }
        }

        // Kiểm tra dữ liệu tùy thuộc vào loại yêu cầu
        switch (requestType) {
            case '開通': // mở mới
                if (!dataSimcall || !timeSimcall || !dataSimcall.includes('GB') || (!timeSimcall.includes('普通') && !timeSimcall.includes('分以内'))) {
                    alert('有効化するには、通話時間と容量が必要となります。容量にはGBが必要で、通話時間は通常または数分以内である必要があります。');
                    stopProcessingCallback(); // Dừng quá trình nếu thiếu dữ liệu
                    return;
                }
                break;

            case 'データ変更': // đổi dung lương
                if (!dataSimcall || !dataSimcall.includes('GB')) {
                    alert('変更データにはGBの容量が必要');
                    stopProcessingCallback(); // Dừng quá trình nếu thiếu dữ liệu hoặc không có GB
                    return;
                }
                break;

            case 'かけ放題': // nghe gọi
                if (!timeSimcall || (!timeSimcall.includes('普通') && !timeSimcall.includes('分以内'))) {
                    alert('無制限の通話の場合、通話時間は通常または数分以内である必要があります。');
                    stopProcessingCallback(); // Dừng quá trình nếu thiếu dữ liệu hoặc không có "普通" hoặc "分以内"
                    return;
                }
                break;

            default: // Các yêu cầu khác chỉ cần phoneNumber
                // Không cần kiểm tra gì thêm
                break;
        }

        // Tìm idSim dựa trên phoneNumber
        fetch(`/get_id_sim_by_phone_number?phone_number=${phoneNumber}`)
            .then(response => response.json())
            .then(data => {
                if (data.idSim) {
                    const idSim = data.idSim;
                    // Lưu dữ liệu vào cơ sở dữ liệu
                    saveRequestCall(idSim, requestType, requestDate, dataSimcall, timeSimcall, callback);
                } else {
                    // Nếu không tìm thấy số điện thoại
                    alert(`電話番号 ${phoneNumber} が表にありません`);
                    stopProcessingCallback(); // Dừng quá trình xử lý
                }
            })
            .catch(error => {
                console.error(`電話番号検索中にエラーが発生しました: ${phoneNumber}`, error);
                alert('エラーが発生しました。もう一度試してください。');
                stopProcessingCallback(); // Dừng quá trình xử lý
            });
    }
</script>

@endsection
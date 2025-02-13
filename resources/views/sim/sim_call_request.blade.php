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
        background-color: #555;
        /* Màu nền khi hover */
        transform: scale(1.05);
        /* Tăng nhẹ kích thước khi hover */
    }

    /* Các hiệu ứng cho các nút đặc biệt */
    .button-container .button[data-form-id="yeucau1"] {
        background-color: #007bff;
        /* Màu xanh dương */
    }

    .button-container .button[data-form-id="yeucau2"] {
        background-color: #ffc107;
        /* Màu vàng */
    }

    .button-container .button[data-form-id="yeucau3"] {
        background-color: #dc3545;
        /* Màu đỏ */
    }

    .button-container .button[data-form-id="yeucau4"] {
        background-color: #01a67c;
        /* Màu xanh lá */
    }

    .button-container .button[data-form-id="yeucau5"] {
        background-color: #752d99;
        /* Màu tím */
    }

    .button-container .button[data-form-id="yeucau6"] {
        background-color: #040092;
        /* Màu xanh đậm */
    }

    .button-container .button[data-form-id="yeucau7"] {
        background-color: #ff0000;
        /* Màu đỏ đậm */
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

    /* Cố định chiều rộng cho cột memo và ẩn phần dài */
    .table td.memo {
        width: 150px;
        /* Cố định chiều rộng của cột memo */
        max-width: 150px;
        /* Không cho phép cột mở rộng quá chiều rộng này */
        white-space: nowrap;
        /* Không cho phép nội dung xuống dòng */
        overflow: hidden;
        /* Ẩn phần nội dung vượt quá chiều rộng */
        text-overflow: ellipsis;
        /* Hiển thị ba chấm (...) khi nội dung bị cắt */
        cursor: pointer;
        /* Thêm con trỏ tay khi di chuột vào cột để nhấn vào */
        padding: 4px;
        /* Thêm khoảng đệm trong để dễ đọc hơn */
        transition: max-height 0.3s ease-in-out;
        /* Thêm hiệu ứng chuyển động khi mở rộng */
    }

    /* Khi cột memo được nhấn vào, mở rộng để hiển thị hết nội dung */
    .table td.memo.expanded {
        white-space: normal;
        /* Cho phép nội dung xuống dòng */
        overflow: visible;
        /* Hiển thị hết nội dung mà không ẩn đi */
        height: auto;
        /* Mở rộng chiều cao để chứa nội dung */
        max-width: none;
        /* Không giới hạn chiều rộng */
        word-wrap: break-word;
        /* Nội dung dài sẽ bị cắt xuống dòng */
        background-color: #f9f9f9;
        /* Thêm nền màu nhẹ để dễ dàng nhận diện */
        border-radius: 5px;
        /* Thêm bo tròn cho ô khi mở rộng */
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        /* Thêm bóng đổ nhẹ để nổi bật */
    }

    /* Điều chỉnh khi cột memo được chỉnh sửa */
    .table td.memo[contenteditable="true"] {
        background-color: #f0f8ff;
        /* Màu nền nhẹ khi chỉnh sửa */
    }
</style>
@endsection
@extends('layouts.app')
@section('content')
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
                                            <h5 class="card-title" style="color:#fff">処理済み (Đã xử lý)</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary" style="background: #fff">
                                                <i class="align-middle" data-feather="check-square"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="" style="color:#fff; margin-bottom: 0px;" id="processedCount">
                                        {{ $processedCount }}
                                    </h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6" style="width: 48%">
                            <div class="card" style="background-image: linear-gradient(45deg, rgb(255, 165, 39), rgb(255, 177, 68)); color: #fff; border-radius: 20px;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title" style="color:#fff">処理待ち (Chưa xử lý)</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary" style="background: #fff">
                                                <i class="align-middle" data-feather="bar-chart"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="" style="color:#fff; margin-bottom: 0px;" id="pendingCount">
                                        {{ $pendingCount }}
                                    </h1>
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
                                            <h5 class="card-title" style="color:#fff">拒否 (Bị từ chối)</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary" style="background: #fff">
                                                <i class="align-middle" data-feather="trash-2"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="" style="color:#fff; margin-bottom: 0px;" id="totalCount">
                                        {{ $rejectedCount }}
                                    </h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6" style="width: 48%">
                            <div class="card" style="background-image: linear-gradient(rgb(28, 187, 140), rgb(28, 187, 140)); color: #fff; border-radius: 20px;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title" style="color:#fff">件数 (Tổng số yêu cầu)</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary" style="background: #fff">
                                                <i class="align-middle" data-feather="layers"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="" style="color:#fff; margin-bottom: 0px;" id="dataValue0">
                                        {{ $totalCount }}
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h1 class="h3 mb-3" style="text-align: center"><strong>Yêu Cầu Của Khách Hàng</strong></h1>
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <div class="row">
                <div class="d-flex">
                    <div class="card flex-fill" style="border-radius: 20px;">
                        <div class="search-container">
                            <input type="text" id="searchInput" style="width: 35%;" placeholder="回線情報検索（電話番号、製造番号）" onkeyup="searchTable()">
                        </div>
                        <div class="card flex-fill">
                            <div class="card-header">
                                <div class="responsive-table" style="position: relative;height: calc(100vh - 436px); margin: 0 auto; width: 100%">
                                    <table class="table table-hover my-0" id="dataTable" style="border-collapse: collapse; width: 100%">
                                        <thead>
                                            <tr>
                                                <th>順番</th>
                                                <th class="d-none d-xl-table-cell">Ngày yêu cầu</th>
                                                <th class="d-none d-xl-table-cell">Yêu cầu</th>
                                                <th class="d-none d-xl-table-cell">Người yêu cầu</th>
                                                <th class="d-none d-xl-table-cell">電話番号</th>
                                                <th class="d-none d-xl-table-cell">プラン名</th>
                                                <th class="d-none d-xl-table-cell">かけ放題</th>
                                                <th class="d-none d-xl-table-cell">利用開始日</th>
                                                <th class="d-none d-xl-table-cell">解約日</th>
                                                <th class="d-none d-xl-table-cell">備考</th>
                                                <th class="d-none d-xl-table-cell" style="text-align: center;">処理状況</th>

                                                <!-- Kiểm tra level và id_manager trong Blade -->
                                                @if(in_array($adminLevel, [1, 2, 4]) || ($adminLevel == 7 && Auth::user()->id_manager == 2))
                                                <th class="d-none d-xl-table-cell" style="text-align: center;">操作</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data as $item)
                                            <tr data-id="{{ $item->id }}">
                                                <td class="order-index">{{ $loop->iteration }}</td>
                                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') }}</td>
                                                <td>{{ $item->request_name }}</td>
                                                <td>{{ $item->simCall->admin->username ?? 'N/A' }}</td>
                                                <td>{{ $item->simCall->phone_number ?? 'N/A' }}</td>
                                                <td>{{ $item->data_simcall }}</td>
                                                <td>{{ $item->time_simcall }}</td>
                                                <td>{{ $item->confirmed_at }}</td>
                                                <td>{{ $item->cancelled_at }}</td>
                                                <td class="memo" contenteditable="false" style="max-width: 150px;">{{ $item->memo }}</td>
                                                <td style="text-align: center;">
                                                    @if($item->confirmed_at)
                                                    Đã xác nhận
                                                    @elseif($item->cancelled_at)
                                                    Đã huỷ bỏ
                                                    @else
                                                    Chưa xử lý
                                                    @endif
                                                </td>

                                                <!-- Hiển thị cột "操作" nếu level thỏa mãn hoặc admin có level 7 và id_manager = 2 -->
                                                @if(in_array($adminLevel, [1, 2, 4]) || ($adminLevel == 7 && Auth::user()->id_manager == 2))
                                                <td style="text-align: center;">
                                                    @if(!$item->confirmed_at && !$item->cancelled_at)
                                                    <!-- Nút Xác nhận -->
                                                    <button class="btn btn-sm confirm-btn btn-danger" data-id="{{ $item->id }}">
                                                        Xác nhận
                                                    </button>
                                                    <!-- Nút Huỷ bỏ -->
                                                    <button class="btn btn-sm cancel-btn btn-warning" data-id="{{ $item->id }}">
                                                        Huỷ bỏ
                                                    </button>
                                                    @elseif($item->confirmed_at)
                                                    <!-- Nếu đã xác nhận -->
                                                    <button class="btn btn-sm btn-success" disabled>
                                                        Đã xác nhận
                                                    </button>
                                                    @elseif($item->cancelled_at)
                                                    <!-- Nếu đã huỷ bỏ -->
                                                    <button class="btn btn-sm btn-secondary" disabled>
                                                        Đã huỷ bỏ
                                                    </button>
                                                    @endif
                                                </td>
                                                @endif
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
    </div>
</main>

<script>
    // Xử lý nút xác nhận
    document.querySelectorAll('.confirm-btn').forEach(button => {
        button.addEventListener('click', function() {
            let itemId = this.getAttribute('data-id');
            if (!this.disabled && confirm('Bạn có chắc chắn muốn xác nhận?')) {
                fetch(`/confirm-item/${itemId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            id: itemId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            let row = this.closest('tr');
                            row.querySelector('td:nth-child(10)').innerText = 'Đã xác nhận'; // Cập nhật trạng thái
                            this.disabled = true;
                            this.innerText = 'Đã xác nhận';
                            this.classList.remove('btn-danger');
                            this.classList.add('btn-success');
                            row.querySelector('.cancel-btn').style.display = 'none'; // Ẩn nút huỷ bỏ
                        }
                    })
                    .catch(error => console.error('Lỗi:', error));
            }
        });
    });

    // Xử lý nút huỷ bỏ
    document.querySelectorAll('.cancel-btn').forEach(button => {
        button.addEventListener('click', function() {
            let itemId = this.getAttribute('data-id');
            if (confirm('Bạn có chắc chắn muốn hủy yêu cầu này?')) {
                fetch(`/cancel-item/${itemId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            id: itemId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            let row = this.closest('tr');
                            row.querySelector('td:nth-child(10)').innerText = 'Đã huỷ bỏ'; // Cập nhật trạng thái
                            this.disabled = true;
                            this.innerText = 'Đã huỷ bỏ';
                            this.classList.remove('btn-warning');
                            this.classList.add('btn-secondary');
                            row.querySelector('.confirm-btn').style.display = 'none'; // Ẩn nút xác nhận
                        }
                    })
                    .catch(error => console.error('Lỗi:', error));
            }
        });
    });

    // Xử lý memo
    document.addEventListener('DOMContentLoaded', function() {
        // Lắng nghe sự kiện nhấn vào cột "memo"
        document.querySelectorAll('.table td.memo').forEach(function(cell) {
            // Khi nhấn vào cột memo
            cell.addEventListener('click', function(event) {
                // Mở rộng cột memo
                this.classList.add('expanded');

                // Cho phép chỉnh sửa nội dung
                this.setAttribute('contenteditable', 'true');
                this.focus(); // Đặt con trỏ vào ô khi mở rộng

                // Ngừng sự kiện click truyền tiếp để không bị xử lý bởi document
                event.stopPropagation();
            });
        });

        // Lắng nghe sự kiện nhấn ra ngoài (click vào bất kỳ đâu ngoài cột memo)
        document.addEventListener('click', function(event) {
            // Kiểm tra nếu nhấn ra ngoài cột memo
            const clickedOutside = !event.target.closest('.memo');

            if (clickedOutside) {
                // Lấy tất cả các cột memo đang mở rộng
                document.querySelectorAll('.table td.memo.expanded').forEach(function(cell) {
                    // Thu nhỏ lại cột memo và dừng chế độ chỉnh sửa
                    cell.classList.remove('expanded');
                    cell.setAttribute('contenteditable', 'false');
                });
            }
        });

        // Lắng nghe sự kiện "keydown" trên các cột memo
        document.querySelectorAll('.memo').forEach(function(cell) {
            cell.addEventListener('keydown', function(event) {
                if (event.key === 'Enter') { // Kiểm tra nếu phím nhấn là Enter
                    event.preventDefault(); // Ngăn chặn hành động mặc định của Enter (thêm dòng mới)

                    // Lấy giá trị sửa đổi trong ô memo
                    let newMemo = this.innerText.trim();

                    // Lấy ID của dòng hiện tại
                    let row = this.closest('tr');
                    let itemId = row.getAttribute('data-id'); // Lấy id từ thuộc tính data-id của tr

                    // Gửi yêu cầu AJAX để cập nhật memo
                    fetch(`/update-memo/${itemId}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                memo: newMemo
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Cập nhật giao diện sau khi thay đổi
                                alert('Đã lưu thay đổi memo');
                            } else {
                                alert('Có lỗi xảy ra khi lưu thay đổi');
                            }
                        })
                        .catch(error => {
                            console.error('Lỗi:', error);
                            alert('Có lỗi xảy ra khi gửi yêu cầu');
                        });
                }
            });
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const rows = Array.from(document.querySelectorAll("#dataTable tbody tr"));
        const today = new Date(); // Ngày hiện tại

        rows.sort((a, b) => {
            const createAtA = new Date(a.querySelector("td:nth-child(2)").textContent.trim());
            const createAtB = new Date(b.querySelector("td:nth-child(2)").textContent.trim());

            const diffA = Math.abs(today - createAtA);
            const diffB = Math.abs(today - createAtB);

            return diffA - diffB;
        });

        const tbody = document.querySelector("#dataTable tbody");
        tbody.innerHTML = ""; // Xóa tất cả các dòng trong tbody

        // Thêm các dòng đã sắp xếp và cập nhật số thứ tự
        rows.forEach((row, index) => {
            row.querySelector(".order-index").textContent = index + 1; // Cập nhật số thứ tự
            tbody.appendChild(row);
        });
    });
</script>

@endsection
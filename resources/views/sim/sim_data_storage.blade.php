@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    .content-csv p {
        text-align: center;
        font-size: 1em;
        margin-bottom: 20px;
        color: #666;
    }

    .content-csv input[type="file"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .content-csv button {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 5px;
        background-color: #007bff;
        color: #fff;
        font-size: 1em;
        cursor: pointer;
    }

    .content-csv button:hover {
        background-color: #0056b3;
    }

    .content-csv button:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.25);
    }

    .content-csv select {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    /* Tổng thể container */
    .content-csv {
        max-width: 1000px;
        margin: 0 auto;
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px 30px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Tiêu đề */
    .content-csv h2 {
        font-size: 22px;
        font-weight: bold;
        color: #333;
        text-align: center;
        margin-bottom: 20px;
    }

    /* Flex container */
    .flex-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 20px;
    }

    /* File input */
    #fileInput {
        flex: 1;
        padding: 7px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 14px;
    }

    /* Select box */
    select {
        flex: 1;
        padding: 12px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 6px;
        background-color: #fff;
    }

    /* Label */
    label {
        font-size: 14px;
        font-weight: bold;
        color: #555;
        display: block;
        margin-bottom: 5px;
    }

    /* Button */
    button#uploadBtn {
        margin-top: 5px;
        flex: 0.5;
        color: white;
        border: none;
        border-radius: 7px;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    button#uploadBtn:hover {
        background-color: rgb(0, 90, 163);
        transform: scale(1.02);
    }

    button#uploadBtn:active {
        transform: scale(0.98);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .flex-container {
            flex-direction: column;
            gap: 10px;
        }

        button#uploadBtn {
            width: 100%;
        }
    }
</style>
@endsection

@extends('layouts.app')

@section('content')
<main class="content" style="padding-top: 30px;">
    <!-- Giả sử ID người dùng được lưu trong một input ẩn -->
    <input type="hidden" id="managerId" value="{{ Auth::user()->id_manager }}">

    <div class="container-fluid p-0">
        <div class="row">
            <div class="row">
                <div class="content-csv">
                    <h2>ファイルCSVのアップロード</h2>
                    <div class="flex-container">
                        <div style="flex: 1;">
                            <label>CSVファイルを選択</label>
                            <input type="file" accept=".csv" id="fileInput">
                        </div>
                        <div style="flex: 1;">
                            <label for="usernameId">新しいSIM管理パートナー</label>
                            <select id="usernameId" name="usernameId">
                                <option value="">-- 管理者を選択 --</option>
                                @foreach ($usernameIds as $usernameId)
                                <option value="{{ $usernameId->id }}">{{ $usernameId->username }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button id="uploadBtn">アップロード</button>
                    </div>
                </div>
            </div>
            <div class="search-container">
                <button id="confirmBtn" class="button_save" style="background-color: #007bff; float:right; width: 150px;" disabled>確定</button>
                <h1 class="h3 mb-3" style="text-align: center; padding-left: 120px;"><strong>在ファイル内のSIMのリスト</strong></h1>
            </div>
            <div class="row">
                <div class="d-flex">
                    <div class="card flex-fill" style="border-radius: 20px;">

                        <div class="card flex-fill">
                            <div class="card-header">
                                <div class="responsive-table" style="position: relative;height: calc(100vh - 436px); margin: 0 auto; width: 100%">
                                    <table class="table table-hover my-0" id="previewTable" style="border-collapse: collapse; width: 100%">
                                        <thead>
                                            <tr>
                                                <th>順番</th>
                                                <th>出荷日</th>
                                                <th>電話番号</th>
                                                <th>製造番号</th>
                                                <th>プロバイダー</th>
                                                <th>プラン名</th>
                                                <th>利用状況</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Dữ liệu CSV sẽ được thêm vào đây -->
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

<meta name="csrf-token" content="{{ csrf_token() }}">
<script>
    // Lấy các phần tử DOM cần thiết
    const fileInput = document.getElementById("fileInput");
    const uploadBtn = document.getElementById("uploadBtn");
    const confirmBtn = document.getElementById("confirmBtn");
    const previewTable = document.getElementById("previewTable").getElementsByTagName('tbody')[0];

    uploadBtn.addEventListener("click", () => {
        const file = fileInput.files[0];
        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                const content = e.target.result;
                const rows = content.split("\n"); // Tách từng dòng

                // Xóa dữ liệu cũ trong bảng
                previewTable.innerHTML = "";

                let isValid = true; // Biến kiểm tra tính hợp lệ của dữ liệu

                // Biểu thức chính quy để kiểm tra số điện thoại hợp lệ
                const phoneNumberRegex = /^0\d{9,10}$/; // Số điện thoại bắt đầu bằng "0" và có 10 hoặc 11 chữ số

                // Lặp qua từng dòng của file CSV
                rows.forEach((row, index) => {
                    if (row.trim() !== "") { // Bỏ qua dòng trống
                        const columns = row.split(","); // Tách từng cột

                        // Lấy các giá trị cột
                        const [phoneNumber, serialNumber, provider, planName, serviceStatus] = [
                            columns[0]?.trim(),
                            columns[1]?.trim(),
                            columns[2]?.trim(),
                            columns[3]?.trim(),
                            columns[4]?.trim() || "在庫", // Mặc định là "在庫" nếu không có giá trị
                        ];

                        // Kiểm tra số điện thoại hợp lệ
                        if (!phoneNumberRegex.test(phoneNumber)) {
                            isValid = false; // Nếu số điện thoại không hợp lệ, tắt nút 確定
                        }

                        // Kiểm tra serialNumber hợp lệ (không để trống)
                        if (!serialNumber || serialNumber.trim() === "") {
                            isValid = false; // Nếu serialNumber trống, tắt nút 確定
                        }

                        // Kiểm tra provider (プロバイダー) và planName (プラン名) không được để trống
                        if (!provider || provider.trim() === "") {
                            isValid = false; // Nếu provider trống, tắt nút 確定
                        }
                        if (!planName || planName.trim() === "") {
                            isValid = false; // Nếu planName trống, tắt nút 確定
                        }

                        // Tạo một dòng mới trong bảng
                        const newRow = previewTable.insertRow();

                        // Cột số thứ tự
                        const cellIndex = newRow.insertCell(0);
                        cellIndex.textContent = index + 1;

                        // Cột 出荷日 (chỉ lấy năm, tháng và ngày)
                        const cellShipDate = newRow.insertCell(1);
                        const currentDate = new Date().toISOString().split('T')[0]; // Lấy phần ngày của ISO string
                        cellShipDate.textContent = currentDate;

                        // Cột 電話番号
                        const cellPhoneNumber = newRow.insertCell(2);
                        if (!phoneNumberRegex.test(phoneNumber)) {
                            cellPhoneNumber.textContent = "無効な電話番号"; // Nếu số điện thoại không hợp lệ
                            cellPhoneNumber.style.color = "red"; // Đặt màu đỏ cho thông báo
                        } else {
                            cellPhoneNumber.textContent = phoneNumber; // Nếu hợp lệ, hiển thị số điện thoại
                        }

                        // Cột 製造番号
                        const cellSerialNumber = newRow.insertCell(3);
                        if (!serialNumber || serialNumber.trim() === "") {
                            cellSerialNumber.textContent = "無効な製造番号"; // Thông báo nếu số serial trống
                            cellSerialNumber.style.color = "red"; // Đặt màu đỏ cho thông báo
                        } else {
                            cellSerialNumber.textContent = serialNumber || ""; // Cột 製造番号
                        }

                        // Cột プロバイダー
                        const cellProvider = newRow.insertCell(4);
                        if (!provider || provider.trim() === "") {
                            cellProvider.textContent = "無効なプロバイダー"; // Thông báo nếu provider trống
                            cellProvider.style.color = "red"; // Đặt màu đỏ cho thông báo
                        } else {
                            cellProvider.textContent = provider || ""; // Cột プロバイダー
                        }

                        // Cột プラン名
                        const cellPlanName = newRow.insertCell(5);
                        if (!planName || planName.trim() === "") {
                            cellPlanName.textContent = "無効なプラン名"; // Thông báo nếu planName trống
                            cellPlanName.style.color = "red"; // Đặt màu đỏ cho thông báo
                        } else {
                            cellPlanName.textContent = planName || ""; // Cột プラン名
                        }

                        // Cột サービス状況
                        const cellServiceStatus = newRow.insertCell(6);
                        cellServiceStatus.textContent = serviceStatus; // Cột サービス状況
                    }
                });

                // Kiểm tra tính hợp lệ của tất cả các dòng dữ liệu
                if (!isValid) {
                    confirmBtn.disabled = true; // Tắt nút 確定 nếu có số điện thoại, serial, provider hoặc plan name không hợp lệ
                } else {
                    confirmBtn.disabled = false; // Kích hoạt nút 確定 nếu tất cả số điện thoại, serial, provider và plan name hợp lệ
                }
            };

            // Đọc file dưới dạng text
            reader.readAsText(file);
        } else {
            alert("Vui lòng chọn một file!"); // Thông báo chọn file
        }
    });

    // Sự kiện click nút 確定
    confirmBtn.addEventListener("click", () => {
        const rows = [];
        const tableRows = previewTable.getElementsByTagName("tr");
        const managerId = document.getElementById("managerId").value; // Lấy ID_manager_admin người của tài khoản
        const usernameId = document.getElementById("usernameId").value; // Lấy ID_username người của tài khoản

        // Duyệt qua từng hàng của bảng để lấy dữ liệu
        for (let i = 0; i < tableRows.length; i++) {
            const cells = tableRows[i].getElementsByTagName("td");
            if (cells.length === 7) { // Đảm bảo đủ  cột dữ liệu
                rows.push({
                    shipping_date: new Date().toISOString().split('T')[0],
                    phone_number: cells[2].textContent, // 電話番号
                    serial_number: cells[3].textContent, // 製造番号
                    provider: cells[4].textContent, // 製造番号
                    plan_name: cells[5].textContent,
                    service_status: cells[6] && cells[6].textContent.trim() !== "" ?
                        cells[6].textContent.trim() : "在庫", // Gán giá trị mặc định nếu trống
                    id_manager_admin: managerId, // Thêm ID người dùng
                    id_username: usernameId !== undefined ? usernameId : null // Đảm bảo id_username có thể là null
                });
            }
        }

        // Gửi dữ liệu lên server
        fetch('/api/save_CsvSimData', {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    data: rows
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("データが正常に保存されました！"); // Thông báo thành công
                    // Clear dữ liệu trong bảng
                    previewTable.innerHTML = "";

                    // Reset input file
                    fileInput.value = "";

                    // Vô hiệu hóa nút 確定
                    confirmBtn.disabled = true;
                } else {
                    alert("データの保存に失敗しました: " + data.error); // Thông báo lỗi
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("エラーが発生しました。");
            });
    });
</script>

@endsection
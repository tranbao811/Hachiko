@extends('layouts.app')

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

    /* CSS */
    .error-row {
        background-color: #ffe6e6;
        /* Màu nền đỏ nhạt */
        color: red;
        /* Màu chữ đỏ */
        font-weight: bold;
    }

    /* Khi nút bị vô hiệu hóa */
    #confirmBtn[disabled] {
        cursor: not-allowed;
        background-color: #cccccc;
        /* Màu nền xám nhạt */
        opacity: 0.5;
        /* Giảm độ sáng */
        pointer-events: none;
        /* Không cho phép thao tác */
    }

    /* Khi nút được kích hoạt */
    #confirmBtn:not([disabled]) {
        cursor: pointer;
        background-color: #007bff;
        /* Màu nền mặc định */
        opacity: 1;
    }
</style>
@endsection

@section('content')
<main class="content" style="padding-top: 30px;">
    <!-- Giả sử ID người quản lý được lưu trong một input ẩn -->
    <input type="hidden" id="managerId" value="{{ Auth::user()->id_manager }}">

    <div class="container-fluid p-0">
        <div class="row">
            <div class="content-csv">
                <h2>ファイルCSVのアップロード</h2>
                <div class="flex-container">
                    <div style="flex: 1;">
                        <label for="usernameId">CSVファイルを選択</label>
                        <input type="file" accept=".csv" id="fileInput">
                    </div>
                    <button id="uploadBtn">SIMを確認</button>
                </div>
                <div class="flex-container">
                    <div style="flex: 1;">
                        <label for="usernameId">新しいSIM管理パートナー</label>
                        <select id="usernameId" name="usernameId">
                            <option value="">-- 管理者を選択 --</option>
                            @foreach ($usernameIds as $usernameId)
                            <option value="{{ $usernameId->id }}">{{ $usernameId->username }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div style="flex: 1;">
                        <label for="manager_usernameId">管理者が新しいSIMを管理</label>
                        <select id="manager_usernameId" name="manager_usernameId">
                            <option value="">-- 管理者を選択 --</option>
                            @foreach ($manager_usernameIds as $manager_usernameId)
                            <option value="{{ $manager_usernameId->id }}">{{ $manager_usernameId->name_manager }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="search-container">
                <button id="confirmBtn" class="button_save" style="background-color: #007bff; float:right; width: 150px;" disabled>確定</button>
                <h1 class="h2 mb-3" style="text-align: center; padding-left: 120px;"><strong>ファイル内のSIMのリスト</strong></h1>
            </div>
            <div class="row">
                <div class="d-flex">
                    <div class="card flex-fill" style="border-radius: 20px;">
                        <div class="card-header">
                            <div class="responsive-table" style="position: relative;height: calc(100vh - 436px); margin: 0 auto; width: 100%">
                                <table class="table table-hover my-0" id="previewTable" style="border-collapse: collapse; width: 100%">
                                    <thead>
                                        <tr>
                                            <th>順番</th>
                                            <th>出荷日</th>
                                            <th>電話番号</th>
                                            <th>製造番号</th>
                                            <th>利用状況</th>
                                            <th>Đối tác quản lý</th>
                                            <th>Admin quản lý</th>
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
</main>

<script>
    // JavaScript
    document.getElementById('uploadBtn').addEventListener('click', function() {
        const fileInput = document.getElementById('fileInput');
        const file = fileInput.files[0];
        const uploadBtn = document.getElementById('uploadBtn');
        const confirmBtn = document.getElementById('confirmBtn');

        if (!file) {
            alert('CSVファイル選択してください！');
            return;
        }

        uploadBtn.disabled = true;
        confirmBtn.disabled = true;

        const reader = new FileReader();
        reader.onload = function(event) {
            const fileContent = event.target.result;
            const simNumbers = parseCSV(fileContent);

            fetch("{{ route('sim.check_sim') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({
                        sim_numbers: simNumbers,
                    })
                })
                .then(response => response.json())
                .then(data => {
                    const tableBody = document.querySelector('#previewTable tbody');
                    tableBody.innerHTML = '';

                    let hasError = false; // Biến kiểm tra có SIM lỗi hay không

                    simNumbers.forEach((simNumber, index) => {
                        const row = document.createElement('tr');
                        const sim = data.data.find(item => item.phone_number === simNumber);

                        if (sim && !sim.error) {
                            // SIM tồn tại
                            row.innerHTML = `
                            <td>${index + 1}</td>
                            <td>${sim.shipping_date}</td>
                            <td>${sim.phone_number}</td>
                            <td>${sim.serial_number}</td>
                            <td>${sim.service_status}</td>
                            <td>${sim.admin_name}</td>
                            <td>${sim.manager_name}</td>
                        `;
                        } else {
                            // SIM không tồn tại
                            row.innerHTML = `
                            <td>${index + 1}</td>
                            <td colspan="6">SIM カード番号 "${simNumber}" は存在しません。</td>
                        `;
                            row.classList.add('error-row'); // Thêm lớp CSS để đánh dấu
                            hasError = true; // Đánh dấu có lỗi
                        }

                        tableBody.appendChild(row);
                    });

                    // Nếu có SIM lỗi, vô hiệu hóa nút confirmBtn
                    if (hasError) {
                        confirmBtn.disabled = true;
                        confirmBtn.style.cursor = 'not-allowed'; // Không cho phép hover
                        confirmBtn.style.opacity = '0.5'; // Giảm độ sáng của nút
                    } else {
                        confirmBtn.disabled = false;
                        confirmBtn.style.cursor = 'pointer';
                        confirmBtn.style.opacity = '1';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('エラーが発生しました。もう一度お試しください！');
                })
                .finally(() => {
                    uploadBtn.disabled = false;
                });
        };
        reader.readAsText(file);
    });

    function parseCSV(csvContent) {
        const rows = csvContent.split('\n');
        const simNumbers = rows.map(row => row.trim()).filter(row => row.length > 0);
        return simNumbers;
    }


    document.getElementById('confirmBtn').addEventListener('click', function() {
        const usernameId = document.getElementById('usernameId').value;
        const managerUsernameId = document.getElementById('manager_usernameId').value;

        if (!usernameId || !managerUsernameId) {
            alert('Vui lòng chọn người quản lý và admin quản lý.');
            return;
        }

        const tableRows = document.querySelectorAll('#previewTable tbody tr');
        const updatedSimData = [];

        tableRows.forEach(row => {
            const cells = row.cells;
            const simPhoneNumber = cells[2].innerText;
            const isValid = cells[4].innerText !== "SIM無存在";

            if (isValid) {
                updatedSimData.push({
                    phone_number: simPhoneNumber,
                    username_id: usernameId,
                    manager_username_id: managerUsernameId
                });
            }
        });

        fetch("{{ route('sim.update_manager') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({
                    sim_call: updatedSimData,
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('更新が完了しました！');
                } else {
                    alert('更新に失敗しました。もう一度お試しください！');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('エラーが発生しました。もう一度お試しください！');
            });
    });
</script>

@endsection
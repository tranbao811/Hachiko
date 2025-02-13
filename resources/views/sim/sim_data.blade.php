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
		transform: scale(0.95);
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
							<div class="card" style="background-image: linear-gradient(rgb(28, 187, 140), rgb(28, 187, 140)); color: #fff; border-radius: 20px;">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<h5 class="card-title" style="color:#fff">利用中</h5>
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
							<div class="card" style="background-image: linear-gradient(45deg, rgb(255, 182, 77), rgb(255, 182, 77)); color: #fff; border-radius: 20px;">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<h5 class="card-title" style="color:#fff">利用停止</h5>
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
							<div class="card" style="background-image: linear-gradient(45deg, rgb(247, 38, 73), rgb(250, 38, 73)); color: #fff; border-radius: 20px;">
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
							<div class="card" style="background-image: linear-gradient(45deg, rgb(84 0 255) ,rgb(136 0 255) );color: #fff; border-radius: 20px;">
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
								<input type="text" id="searchInput" class="form-control" style="width: 400px; border-radius: 20px;" placeholder="回線情報検索（電話番号、製造番号）" onkeyup="searchTable()">
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
											<th style="text-align: center">順番</th>
											<th class="d-none d-xl-table-cell" style="text-align: center">出荷日</th>
											<th class="d-none d-xl-table-cell" style="text-align: center">電話番号</th>
											<th class="d-none d-xl-table-cell" style="text-align: center">製造番号</th>
											<th class="d-none d-xl-table-cell" style="text-align: center">プロバイダー</th>
											<th class="d-none d-xl-table-cell" style="text-align: center">プラン名</th>
											<th class="d-none d-xl-table-cell" style="text-align: center">利用開始日</th>
											<th class="d-none d-xl-table-cell" style="text-align: center">利用状況</th>
											<th class="d-none d-xl-table-cell" style="text-align: center">解約日</th>
											<th class="d-none d-xl-table-cell" style="text-align: center">備考</th>
											@if(in_array(auth()->user()->level, [1, 2, 4]) || (auth()->user()->level == 7 && auth()->user()->id_manager_admin == 2))
											<th class="d-none d-xl-table-cell" style="text-align: center">Người quản lý</th>
											@endif
											<th style="width: 110px; text-align: center;">操作</th>
										</tr>
									</thead>
									<tbody>
										@foreach($data as $index => $item)
										<tr data-id="{{ $item->id }}">
											<td class="order-index" style="text-align: center">{{ $loop->iteration }}</td>
											<td style="text-align: center">{{ \Carbon\Carbon::parse($item->shipping_date)->format('Y/m/d') }}</td>
											<td style="text-align: center">{{ $item->phone_number }}</td>
											<td style="text-align: center">{{ $item->serial_number }}</td>
											<td style="text-align: center">{{ $item->provider }}</td>
											<td style="text-align: center">{{ $item->plan_name }}</td>
											<td style="text-align: center">{{ \Carbon\Carbon::parse($item->shipping_date)->format('Y/m/d') }}</td>
											<td style="text-align: center">
												@if($item->service_status)
												@if($item->service_status == '利用中')
												<a class="btn btn-success" style="width: 100%; border-radius: 20px;">利用中</a>
												@elseif($item->service_status == '解約済' || $item->service_status == '短期解約')
												<a class="btn btn-danger" style="width: 100%; border-radius: 20px;">解約済</a>
												@elseif($item->service_status == '再発行')
												<a class="btn btn-secondary" style="width: 100%; border-radius: 20px;">再発行</a>
												@elseif($item->service_status == '停止' || $item->service_status == '利用停止')
												<a class="btn" style="width: 100%;border-radius: 20px; background-image: linear-gradient(45deg, rgb(255, 182, 77), rgb(255, 182, 77)); color: #fff;">停止</a>
												@elseif($item->service_status == '在庫')
												<a class="btn" style="width: 100%; background-image: linear-gradient(45deg, rgb(84 0 255) ,rgb(136 0 255) );color: #fff; border-radius: 20px;">在庫</a>
												@elseif($item->service_status == '不明')
												<a class="btn" style="width: 100%; background-image:linear-gradient(45deg, rgb(158, 7, 7) ,rgb(158, 7, 7) );color: #fff; border-radius: 20px;">不明</a>
												@elseif($item->service_status == '不良')
												<a class="btn" style="width: 100%; border-radius: 20px;  background-image: linear-gradient(45deg, rgb(77, 169, 255), rgb(77, 169, 255));; color: #fff;">不良</a>
												@else
												<a class="btn btn-warning" style="width: 100%; border-radius: 20px;">{{ $item->service_status }}</a>
												@endif
												@endif
											</td>
											<td style="text-align: center">{{ $item->cancellation_date }}</td>
											<td style="text-align: center">{{ $item->notes }}</td>
											@if(in_array(auth()->user()->level, [1, 2, 4]) || (auth()->user()->level == 7 && auth()->user()->id_manager_admin == 2))
											<td style="text-align: center">{{ $item->admin->username ?? 'N/A' }}</td>
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
						<div class="card-footer d-flex justify-content-between align-items-center">
							<div>
								<small class="text-muted">{{ $data->count() }} 件の結果</small>
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
				<option value="停止">停止</option>
				<option value="再開">再開</option>
				<option value="再発行">再発行</option>
				<option value="解約">解約</option>
			</select>
			<br><br>

			<!-- Chọn ngày yêu cầu -->
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
							<th class="d-none d-xl-table-cell">Thông tin File CSV</th>
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
			<button class="button" style="background-color: #ffc107;" data-form-id="yeucau2" data-request-name="停止" onclick="showSelectedForm(this)">停止</button>
			<button class="button" style="background-color: #dc3545;" data-form-id="yeucau3" data-request-name="再開" onclick="showSelectedForm(this)">再開</button>
			<button class="button" style="background-color: #01a67c;" data-form-id="yeucau4" data-request-name="再発行" onclick="showSelectedForm(this)">再発行</button>
			<button class="button" style="background-color: #ff0000;" data-form-id="yeucau7" data-request-name="解約" onclick="showSelectedForm(this)">解約</button>
		</div>
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
					<input type="text" class="form-control" id="loaisim" name="loaisim" value="データシム" readonly>
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
					<input type="text" class="form-control" id="loaisim" name="loaisim" value="データシム" readonly>
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

			if (servicestatus === '解約済' || servicestatus === '解約') {
				// Chỉ hiển thị nút yeucau7
				button.style.display = formId === 'yeucau7' ? 'inline-block' : 'none';
			} else if (servicestatus === '利用停止' || servicestatus === '停止') {
				// Ẩn yeucau1 và yeucau2
				button.style.display = ['yeucau3', 'yeucau4', 'yeucau7'].includes(formId) ? 'inline-block' : 'none';
			} else if (servicestatus === '在庫') {
				// Ẩn yeucau3
				button.style.display = ['yeucau2', 'yeucau4', 'yeucau7'].includes(formId) ? 'inline-block' : 'none';
			} else if (servicestatus === '再発行') {
				// Ẩn yeucau3
				button.style.display = ['yeucau2', 'yeucau7'].includes(formId) ? 'inline-block' : 'none';
			} else if (servicestatus === '不良') {
				// Ẩn yeucau3
				button.style.display = ['yeucau4', 'yeucau7'].includes(formId) ? 'inline-block' : 'none';
			} else if (servicestatus === '利用中' || servicestatus === '不明') {
				// Ẩn yeucau1
				button.style.display = ['yeucau2', 'yeucau3', 'yeucau4', 'yeucau7'].includes(formId) ? 'inline-block' : 'none';
			}
		});

		// Xử lý riêng cho editForm7 dựa trên servicestatus
		const editForm7Buttons = document.querySelectorAll('#editForm7 button');
		editForm7Buttons.forEach(button => {
			if (servicestatus === "解約済" || servicestatus === "解約") {
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
			alert("Dữ liệu không hợp lệ, vui lòng thử lại!");
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
		const [index, shippingDate, phoneNumber, serialNumber, planName, Provider, serviceStartDate, serviceStatus, cancellationDate] = rowData;

		if (formId === 'yeucau7') {
			form.querySelector('#editField1').value = shippingDate || '';
			form.querySelector('#editField2').value = phoneNumber || '';
			form.querySelector('#editField3').value = serialNumber || '';
			form.querySelector('#editField4').value = Provider || '';
			form.querySelector('#editField5').value = planName || '';
			form.querySelector('#editField6').value = serviceStartDate || '';
			form.querySelector('#editField7').value = serviceStatus || '';
			form.querySelector('#editField11').value = cancellationDate || '';
		} else {
			form.querySelector('#editField1').value = shippingDate || '';
			form.querySelector('#editField2').value = phoneNumber || '';
			form.querySelector('#editField3').value = serialNumber || '';
			form.querySelector('#editField4').value = Provider || '';
			form.querySelector('#editField5').value = planName || '';
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
		// console.log(obj);
	}

	function submitForm(formId) {
		const form = document.getElementById(formId);
		const formData = new FormData(form);
		const method = form.getAttribute('data-method') || 'POST';

		// Lấy id_sim từ hàng được chọn
		const idSim = localStorage.getItem('selectedRowId');
		if (!idSim) {
			alert('Không tìm thấy id_sim!');
			return;
		}

		// Lấy tên yêu cầu đã chọn từ input ẩn
		const selectedRequestName = document.getElementById('selectedRequestName').value;
		const createdAt = form.querySelector('#ngayyeucau').value;
		const memo = ''; // Giá trị mặc định là chuỗi rỗng
		const confirmedAt = ''; // Giá trị mặc định là chuỗi rỗng

		if (!selectedRequestName) {
			alert('Không tìm thấy tên yêu cầu đã chọn!');
			return;
		}
		if (!createdAt) {
			alert('Vui lòng chọn ngày!');
			return;
		}

		// Xử lý các loại yêu cầu khác nhau
		if (['停止', '再開', '再発行', '解約'].includes(selectedRequestName)) {
			formData.append('id_sim', idSim);
			formData.append('request_name', selectedRequestName);
			formData.append('created_at', createdAt);
		}

		// Hiển thị dữ liệu form gửi đi (tuỳ chọn, có thể bỏ qua)
		logFormData(formData);

		// Gửi dữ liệu đến API
		fetch('/saveRequestSimData', {
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
				alert('Dữ liệu đã được gửi thành công!');
			})
			.catch(error => {
				console.error('Lỗi:', error);
				alert(`Gửi dữ liệu thất bại: ${error.message}`);
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

	document.addEventListener('DOMContentLoaded', function() {
        const currentDate = new Date().toISOString().split('T')[0];
        document.getElementById('requestDate').setAttribute('min', currentDate);
    });

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
		fetch(`/get_id_sim_by_phone_number_data?phone_number=${phoneNumber}`)
			.then(response => response.json())
			.then(data => {
				if (!data.idSim) {
					// Nếu không tìm thấy số điện thoại, thêm thông báo lỗi vào bảng
					const errorTd = document.createElement("td");
					errorTd.colSpan = tr.children.length; // Đảm bảo thông báo lỗi chiếm toàn bộ chiều rộng bảng
					errorTd.textContent = `SIM không tồn tại`;
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
				console.error(`Lỗi khi kiểm tra số điện thoại: ${phoneNumber}`, error);

				// Thêm thông báo lỗi vào bảng nếu có lỗi trong quá trình kiểm tra
				const errorTd = document.createElement("td");
				errorTd.colSpan = tr.children.length; // Đảm bảo thông báo lỗi chiếm toàn bộ chiều rộng bảng
				errorTd.textContent = "Đã xảy ra lỗi khi kiểm tra số điện thoại.";
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
	function saveRequestData(idSim, requestName, createAt, callback) {
		const requestData = {
			id_sim: idSim,
			request_name: requestName,
			created_at: createAt // Sử dụng requestDate làm create_at

		};

		fetch('/save_request_data', {
				method: 'POST',
				headers: {
					"Content-Type": "application/json",
					"X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
				},
				body: JSON.stringify(requestData)
			})
			.then(response => {
				if (!response.ok) {
					throw new Error(`Server responded with status ${response.status}`);
				}
				return response.json();
			})
			.then(data => {
				if (data.status === 'success') {
					console.log('データが正常に保存されました - Dữ liệu đã được lưu thành công.');
				} else {
					alert(`エラーが発生しました - Đã xảy ra lỗi: ${data.message}`);
				}
			})
			.catch(error => {
				console.error('エラーが発生しました:', error);
				alert('エラーが発生しました - Đã xảy ra lỗi. Vui lòng thử lại.');
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
				console.log("Dừng quá trình vì không tìm thấy số điện thoại.");
			}

			rows.forEach((row, index) => {
				if (stopProcessing) return; // Nếu đã dừng, không xử lý các số tiếp theo

				if (row.length > 0 && row[0].trim()) {
					totalRequests++; // Đếm số yêu cầu
					const phoneNumber = row[0].trim(); // Số điện thoại từ file CSV

					// Tra cứu idSim từ số điện thoại (phoneNumber)
					getIdSimByPhoneNumber(phoneNumber, requestType, requestDate, row, totalRequests, () => {
						completedRequests++; // Tăng số lượng hoàn tất
						if (completedRequests === totalRequests) {
							// Hiển thị thông báo khi tất cả hoàn tất
							alert('すべてのデータが正常に保存されました - Tất cả dữ liệu đã được lưu thành công.');
							document.getElementById('popupContent').style.display = 'none'; // Ẩn popup
						}
					}, stopProcessingCallback); // Truyền vào stopProcessingCallback
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

		// Kiểm tra yêu cầu '停止', '再開', '再発行', '解約'
		if (['停止', '再開', '再発行', '解約'].includes(requestType)) {
			// Nếu có dữ liệu khác ngoài số điện thoại thì báo lỗi
			if (row[1] || row[2]) {
				alert('この要求には電話番号のみが必要で、他のデータは必要ありません。');
				stopProcessingCallback(); // Dừng quá trình nếu có dữ liệu khác
				return;
			}
		}

		// Tiến hành gọi API để lấy idSim từ số điện thoại
		fetch(`/get_id_sim_by_phone_number_data?phone_number=${phoneNumber}`)
			.then(response => response.json())
			.then(data => {
				if (data.idSim) {
					const idSim = data.idSim;
					// Lưu dữ liệu vào cơ sở dữ liệu
					saveRequestData(idSim, requestType, requestDate, callback);
				} else {
					// Nếu không tìm thấy số điện thoại
					alert(`電話番号 ${phoneNumber} が表にありません`);
					stopProcessingCallback(); // Dừng quá trình xử lý
				}
			})
			.catch(error => {
				alert('エラーが発生しました。もう一度試してください。');
				stopProcessingCallback(); // Gọi callback để dừng việc xử lý
				return; // Dừng hoàn toàn không tiếp tục xử lý
			});
	}
</script>

@endsection
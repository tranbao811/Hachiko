<?php

namespace App\Http\Controllers;

use App\Models\customer_request_simdata;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\customer_request;
use App\Models\table_wifi;
use App\Models\manager_admin;
use App\Models\sim_call;
use App\Models\sim_data;
use App\Models\delivery_details;
use App\Models\request_simcall;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use SebastianBergmann\Environment\Console;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use PhpParser\Node\Stmt\Return_;
use SebastianBergmann\CodeCoverage\Report\Html\CustomCssFile;
use League\Csv\Reader;

class SimController extends Controller
{
    public function sim_call(Request $request)
    {
        $user = Auth::guard('admin')->user(); // Lấy thông tin người dùng đã đăng nhập
        $adminId = $user->id; // Lấy ID của admin hiện tại
        $level = $user->level; // Lấy giá trị của level

        // Khởi tạo query để lấy dữ liệu từ bảng sim_call
        if (in_array($level, [1, 2, 3, 4, 5, 6])) {
            // Nếu level là 1, 2, 3, 4, 5, 6 thì lấy toàn bộ dữ liệu
            $query = sim_call::query();
        } else {
            // Nếu không, lấy dữ liệu theo id_username
            $query = sim_call::where('id_username', $adminId);
        }

        // Thêm phân trang: giả sử mỗi trang sẽ hiển thị 1000 SIM
        $data = $query->get();

        // Format cancellation_date nếu có
        $data->each(function ($item) {
            if ($item->cancellation_date) {
                $item->cancellation_date = \Carbon\Carbon::parse($item->cancellation_date)->format('Y/m/d');
            }
        });

        // Nhóm 1: service_status = "停止", "再開", "再発行", "データ変更", "かけ放題"
        $group1 = $data->filter(function ($item) {
            return in_array($item->service_status, ['利用中', '停止', '再開', '再発行', 'データ変更', 'かけ放題']);
        });

        // Nhóm 2: service_status = "再開", "再発行", "データ変更", "かけ放題"
        $group2 = $data->filter(function ($item) {
            return in_array($item->service_status, ['利用中', '再開', '再発行', 'データ変更', 'かけ放題']);
        });

        // Nhóm 3: service_status = "解約済"
        $group3 = $data->filter(function ($item) {
            return in_array($item->service_status, ['解約済', '解約']);
        });

        // Nhóm 4: service_status là NULL
        $group4 = $data->filter(function ($item) {
            return in_array($item->plan_name, ['未開通']);
            // return is_null($item->service_status);
        });

        // Tổng số SIM đang sử dụng (Nhóm 1 và Nhóm 2)
        $totalUsingSim = $group1->count() + $group2->count();

        // Thống kê số lượng cho từng nhóm
        $group1Count = $group1->count(); // Tổng số SIM cho nhóm 1
        $group2Count = $group2->count(); // Tổng số SIM cho nhóm 2
        $group3Count = $group3->count(); // Tổng số SIM cho nhóm 3
        $group4Count = $group4->count(); // Tổng số SIM cho nhóm 4

        // Trả về view với các dữ liệu đã tính toán
        return view('sim.sim_call', [
            'data' => $data,
            'group1Count' => $group1Count, // Số lượng nhóm 1
            'group2Count' => $group2Count, // Số lượng nhóm 2
            'group3Count' => $group3Count, // Số lượng nhóm 3
            'group4Count' => $group4Count, // Số lượng nhóm 4
            'totalUsingSim' => $totalUsingSim // Tổng số SIM đang sử dụng
        ]);
    }


    // Sim data
    public function sim_data(Request $request)
    {
        $user = Auth::guard('admin')->user(); // Lấy thông tin người dùng đã đăng nhập
        $adminId = $user->id; // Lấy ID của admin hiện tại
        $level = $user->level; // Lấy giá trị của level

        if (in_array($level, [1, 2, 3, 4, 5, 6])) {
            // Nếu level là 1, 2, 3, hoặc 4, lấy toàn bộ dữ liệu
            $query = sim_data::query();
        } else {
            // Nếu level khác, lấy dữ liệu theo id_username
            $query = sim_data::where('id_username', $adminId);
        }

        // Thêm phân trang: giả sử mỗi trang sẽ hiển thị 1000 SIM
        $data = $query->get();

        // Format cancellation_date nếu có
        $data->each(function ($item) {
            if ($item->cancellation_date) {
                $item->cancellation_date = \Carbon\Carbon::parse($item->cancellation_date)->format('Y/m/d');
            }
        });

        // Nhóm 1: service_status = '利用中', '停止', '利用停止', '再発行', '在庫・不明','不良'
        $group1 = $data->filter(function ($item) {
            return in_array($item->service_status, ['利用中', '停止', '利用停止', '再発行', '在庫', '不明', '不良']);
        });

        // Nhóm 2: service_status = '停止', '利用停止'
        $group2 = $data->filter(function ($item) {
            return in_array($item->service_status, ['停止', '利用停止']);
        });

        // Nhóm 3: service_status = '解約済', '解約'
        $group3 = $data->filter(function ($item) {
            return in_array($item->service_status, ['解約済', '解約']);
        });

        // Nhóm 4: service_status là '在庫・不明'
        $group4 = $data->filter(function ($item) {
            return in_array($item->service_status, ['在庫']);
        });

        // Tổng số SIM đang sử dụng (Nhóm 1 và Nhóm 2)
        $totalUsingSim = $group1->count() + $group2->count();

        // Thống kê số lượng cho từng nhóm
        $group1Count = $group1->count(); // Tổng số SIM cho nhóm 1
        $group2Count = $group2->count(); // Tổng số SIM cho nhóm 2
        $group3Count = $group3->count(); // Tổng số SIM cho nhóm 3
        $group4Count = $group4->count(); // Tổng số SIM cho nhóm 4

        // Trả về view với các dữ liệu đã tính toán
        return view('sim.sim_data', [
            'data' => $data,
            'group1Count' => $group1Count, // Số lượng nhóm 1
            'group2Count' => $group2Count, // Số lượng nhóm 2
            'group3Count' => $group3Count, // Số lượng nhóm 3
            'group4Count' => $group4Count, // Số lượng nhóm 4
            'totalUsingSim' => $totalUsingSim // Tổng số SIM đang sử dụng
        ]);
    }

    public function sim_call_storage(Request $request)
    {
        $user = Auth::guard('admin')->user(); // Lấy thông tin người dùng đã đăng nhập
        $adminId = $user->id; // Lấy ID của admin hiện tại
        $level = $user->level; // Lấy giá trị của level
        $usernameIds = Admin::select('id', 'username')->get(); // Lấy danh sách quản trị viên

        if (in_array($level, [1, 2, 3, 4, 5, 6])) {
            // Nếu level là 1, 2, 3, 4, 5, hoặc 6, lấy toàn bộ dữ liệu với điều kiện plan_name là '未開通'
            $query = sim_call::query();
        } else {
            // Nếu level khác, lấy dữ liệu theo id_username với điều kiện plan_name là '未開通'
            $query = sim_call::where('id_username', $adminId);
        }

        $data = $query->get();

        return view('sim.sim_call_storage', ['data' => $data, 'usernameIds' => $usernameIds]);
    }

    public function sim_call_transfer(Request $request)
    {
        $user = Auth::guard('admin')->user(); // Lấy thông tin người dùng đã đăng nhập
        $adminId = $user->id; // Lấy ID của admin hiện tại
        $level = $user->level; // Lấy giá trị của level
        $usernameIds = Admin::select('id', 'username')->get(); // Lấy danh sách quản trị viên
        $manager_usernameIds = manager_admin::select('id', 'name_manager')->get(); // Lấy danh sách quản trị viên

        if (in_array($level, [1, 2, 3, 4, 5, 6])) {
            // Nếu level là 1, 2, 3, 4, 5, hoặc 6, lấy toàn bộ dữ liệu với điều kiện plan_name là '未開通'
            $query = sim_call::query();
        } else {
            // Nếu level khác, lấy dữ liệu theo id_username với điều kiện plan_name là '未開通'
            $query = sim_call::where('id_username', $adminId);
        }

        $data = $query->get();

        return view('sim.sim_call_transfer', ['data' => $data, 'usernameIds' => $usernameIds, 'manager_usernameIds' => $manager_usernameIds]);
    }
    public function checkSim(Request $request)
    {
        try {
            $simNumbers = $request->input('sim_numbers');

            if (empty($simNumbers)) {
                return response()->json(['success' => false, 'message' => 'Không có số SIM nào được gửi.']);
            }

            // Lấy thông tin các SIM có trong cơ sở dữ liệu
            $simCall = sim_call::whereIn('phone_number', $simNumbers)->get()->keyBy('phone_number');

            // Tạo danh sách phản hồi đầy đủ
            $responseData = collect($simNumbers)->map(function ($simNumber) use ($simCall) {
                if (isset($simCall[$simNumber])) {
                    $sim = $simCall[$simNumber];
                    return [
                        'phone_number' => $sim->phone_number,
                        'shipping_date' => $sim->shipping_date,
                        'serial_number' => $sim->serial_number,
                        'service_status' => $sim->service_status,
                        'manager_name' => $sim->admin_manager->name_manager,
                        'admin_name' => $sim->admin->username,
                    ];
                } else {
                    // SIM không tồn tại
                    return [
                        'phone_number' => $simNumber,
                        'error' => 'Không tồn tại',
                    ];
                }
            });

            return response()->json(['success' => true, 'data' => $responseData]);
        } catch (\Exception $e) {
            Log::error('Error processing checkSim request: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Đã xảy ra lỗi khi xử lý yêu cầu.']);
        }
    }

    public function checkSim_data(Request $request)
    {
        try {
            $simNumbers = $request->input('sim_numbers');

            if (empty($simNumbers)) {
                return response()->json(['success' => false, 'message' => 'Không có số SIM nào được gửi.']);
            }

            // Lấy thông tin các SIM có trong cơ sở dữ liệu
            $simData = sim_data::whereIn('phone_number', $simNumbers)->get()->keyBy('phone_number');

            // Tạo danh sách phản hồi đầy đủ
            $responseData = collect($simNumbers)->map(function ($simNumber) use ($simData) {
                if (isset($simData[$simNumber])) {
                    $sim_data = $simData[$simNumber];
                    return [
                        'phone_number' => $sim_data->phone_number,
                        'shipping_date' => $sim_data->shipping_date,
                        'serial_number' => $sim_data->serial_number,
                        'provider' => $sim_data->provider,
                        'service_status' => $sim_data->service_status,
                        'manager_name' => $sim_data->admin_manager->name_manager,
                        'admin_name' => $sim_data->admin->username,
                    ];
                } else {
                    // SIM không tồn tại
                    return [
                        'phone_number' => $simNumber,
                        'error' => 'Không tồn tại',
                    ];
                }
            });

            return response()->json(['success' => true, 'data' => $responseData]);
        } catch (\Exception $e) {
            Log::error('Error processing checkSim request: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Đã xảy ra lỗi khi xử lý yêu cầu.']);
        }
    }

    public function updateManager(Request $request)
    {
        try {
            $simCall = $request->input('sim_call');

            foreach ($simCall as $sim) {
                $simRecord = sim_call::where('phone_number', $sim['phone_number'])->first();

                if ($simRecord) {
                    $simRecord->id_username = $sim['username_id'];
                    $simRecord->id_manager_admin = $sim['manager_username_id'];
                    $simRecord->save();
                }
            }

            return response()->json(['success' => true, 'message' => 'Cập nhật thành công!']);
        } catch (\Exception $e) {
            Log::error('Error updating manager: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Đã xảy ra lỗi khi cập nhật.']);
        }
    }

    public function updateManager_data(Request $request)
    {
        try {
            $simData = $request->input('sim_data');

            foreach ($simData as $sim) {
                $simDataRecord = sim_data::where('phone_number', $sim['phone_number'])->first();

                if ($simDataRecord) {
                    $simDataRecord->id_username = $sim['username_id'];
                    $simDataRecord->id_manager_admin = $sim['manager_username_id'];
                    $simDataRecord->save();
                }
            }

            return response()->json(['success' => true, 'message' => 'Cập nhật thành công!']);
        } catch (\Exception $e) {
            Log::error('Error updating manager: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Đã xảy ra lỗi khi cập nhật.']);
        }
    }


    public function sim_call_customer_request(Request $request)
    {
        // Lấy ID của admin đang đăng nhập
        $adminId = Auth::id();
        $adminLevel = Auth::user()->level;  // Lấy level của admin hiện tại
        $idManager = Auth::user()->id_manager;  // Lấy id_manager của admin

        // Lấy danh sách các admin (để sử dụng trong view nếu cần)
        $usernameIds = Admin::select('id', 'username')->get();

        // Tạo query cơ bản để lọc dữ liệu từ bảng customer_request
        $query = customer_request::select('customer_request.*', 'sim_call.id_username')
            // Join bảng sim_call để lấy thông tin id_username
            ->join('sim_call', 'customer_request.id_sim', '=', 'sim_call.id');



        // Kiểm tra nếu level của admin là 1, 2, 3, 4, 5, 6 thì hiển thị toàn bộ dữ liệu
        if (in_array($adminLevel, [1, 2, 3, 4, 5, 6])) {
            // Admin có level từ 1 đến 6, lấy toàn bộ dữ liệu
            $data = $query->orderBy('customer_request.created_at', 'desc')->get();
        } else {
            // Admin khác chỉ lấy dữ liệu theo id_username của admin hiện tại
            $data = $query->where('sim_call.id_username', $adminId)
                ->orderBy('customer_request.created_at', 'desc') // Sắp xếp theo ngày
                ->get();
        }
        // Format cancellation_date nếu có
        $data->each(function ($item) {
            if ($item->cancelled_at) {
                $item->cancelled_at = \Carbon\Carbon::parse($item->cancelled_at)->format('Y/m/d');
            }
        });

        // Thống kê các yêu cầu
        $processedCount = $data->where('confirmed_at')->count(); // Đếm các yêu cầu đã xử lý
        $pendingCount = $data->whereNull('confirmed_at')->whereNull('cancelled_at')->count(); // Đếm các yêu cầu chưa xử lý (cả confirmed_at và cancelled_at đều là null)
        $rejectedCount = $data->where('cancelled_at')->count(); // Đếm các yêu cầu bị từ chối
        $totalCount = $data->count(); // Tổng số yêu cầu

        // Trả về view với dữ liệu và thống kê
        return view('sim.sim_call_customer_request', [
            'data' => $data,
            'usernameIds' => $usernameIds,
            'processedCount' => $processedCount,
            'pendingCount' => $pendingCount,
            'rejectedCount' => $rejectedCount,
            'totalCount' => $totalCount,
            'adminLevel' => $adminLevel,  // Truyền adminLevel vào view
            'idManager' => $idManager     // Truyền id_manager vào view
        ]);
    }


    public function sim_data_customer_request(Request $request)
    {
        // Lấy ID của admin đang đăng nhập
        $adminId = Auth::id();
        $adminLevel = Auth::user()->level;  // Lấy level của admin hiện tại
        $idManager = Auth::user()->id_manager;  // Lấy id_manager của admin

        // Lấy danh sách các admin (để sử dụng trong view nếu cần)
        $usernameIds = Admin::select('id', 'username')->get();

        // Tạo query cơ bản để lọc dữ liệu từ bảng customer_request_simdata
        $query = customer_request_simdata::select('customer_request_simdata.*', 'sim_data.id_username')
            // Join bảng sim_data để lấy thông tin id_username
            ->join('sim_data', 'customer_request_simdata.id_sim', '=', 'sim_data.id');

        // Kiểm tra nếu level của admin là 1, 2, 3, 4, 5, 6 thì hiển thị toàn bộ dữ liệu
        if (in_array($adminLevel, [1, 2, 3, 4, 5, 6])) {
            // Admin có level từ 1 đến 6, lấy toàn bộ dữ liệu
            $data = $query->orderBy('customer_request_simdata.created_at', 'desc')->get();
        } else {
            // Admin khác chỉ lấy dữ liệu theo id_username của admin hiện tại
            $data = $query->where('sim_data.id_username', $adminId)
                ->orderBy('customer_request_simdata.created_at', 'desc') // Sắp xếp theo ngày
                ->get();
        }

        // Format cancellation_date nếu có
        $data->each(function ($item) {
            if ($item->cancelled_at) {
                $item->cancelled_at = \Carbon\Carbon::parse($item->cancelled_at)->format('Y/m/d');
            }
        });

        // Thống kê các yêu cầu
        $processedCount = $data->where('confirmed_at')->count(); // Đếm các yêu cầu đã xử lý
        $pendingCount = $data->whereNull('confirmed_at')->whereNull('cancelled_at')->count(); // Đếm các yêu cầu chưa xử lý (cả confirmed_at và cancelled_at đều là null)
        $rejectedCount = $data->where('cancelled_at')->count(); // Đếm các yêu cầu bị từ chối
        $totalCount = $data->count(); // Tổng số yêu cầu

        // Trả về view với dữ liệu và thống kê
        return view('sim.sim_data_customer_request', [
            'data' => $data,
            'usernameIds' => $usernameIds,
            'processedCount' => $processedCount,
            'pendingCount' => $pendingCount,
            'rejectedCount' => $rejectedCount,
            'totalCount' => $totalCount,
            'adminLevel' => $adminLevel,  // Truyền adminLevel vào view
            'idManager' => $idManager     // Truyền id_manager vào view
        ]);
    }

    public function sim_data_storage(Request $request)
    {
        $user = Auth::guard('admin')->user(); // Lấy thông tin người dùng đã đăng nhập
        $adminId = $user->id; // Lấy ID của admin hiện tại
        $level = $user->level; // Lấy giá trị của level
        $usernameIds = Admin::select('id', 'username')->get(); // Lấy danh sách quản trị viên

        if (in_array($level, [1, 2, 3, 4, 5, 6])) {
            // Nếu level là 1, 2, 3, 4, 5, hoặc 6, lấy toàn bộ dữ liệu với điều kiện plan_name là '未開通'
            $query = sim_data::query();
        } else {
            // Nếu level khác, lấy dữ liệu theo id_username với điều kiện plan_name là '未開通'
            $query = sim_data::where('id_username', $adminId);
        }

        $data = $query->get();

        return view('sim.sim_data_storage', ['data' => $data, 'usernameIds' => $usernameIds]);
    }
    public function sim_data_transfer(Request $request)
    {
        $user = Auth::guard('admin')->user(); // Lấy thông tin người dùng đã đăng nhập
        $adminId = $user->id; // Lấy ID của admin hiện tại
        $level = $user->level; // Lấy giá trị của level
        $usernameIds = Admin::select('id', 'username')->get(); // Lấy danh sách quản trị viên
        $manager_usernameIds = manager_admin::select('id', 'name_manager')->get(); // Lấy danh sách quản trị viên

        if (in_array($level, [1, 2, 3, 4, 5, 6])) {
            // Nếu level là 1, 2, 3, 4, 5, hoặc 6, lấy toàn bộ dữ liệu với điều kiện plan_name là '未開通'
            $query = sim_data::query();
        } else {
            // Nếu level khác, lấy dữ liệu theo id_username với điều kiện plan_name là '未開通'
            $query = sim_data::where('id_username', $adminId);
        }

        $data = $query->get();

        return view('sim.sim_data_transfer', ['data' => $data, 'usernameIds' => $usernameIds, 'manager_usernameIds' => $manager_usernameIds]);
    }


    // Hiển thị form upload CSV

    public function save_CsvSimCall(Request $request)
    {
        try {
            $data = $request->input('data');

            // Lưu từng dòng dữ liệu vào database
            foreach ($data as $row) {
                DB::table('sim_call')->insert([
                    'shipping_date' => $row['shipping_date'],
                    'phone_number' => $row['phone_number'],
                    'serial_number' => $row['serial_number'],
                    'plan_name' => $row['plan_name'] ?? '未開通', // Gán giá trị mặc định nếu null
                    'service_status' => $row['service_status'] ?? '在庫', // Gán giá trị mặc định nếu null
                    'id_manager_admin' => $row['id_manager_admin'],        // Lưu ID người quản lý
                    'id_username' => $row['id_username'],        // Lưu ID người quản lý
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function save_CsvSimData(Request $request)
    {
        try {
            $data = $request->input('data');

            // Lưu từng dòng dữ liệu vào database
            foreach ($data as $row) {
                DB::table('sim_data')->insert([
                    'shipping_date' => $row['shipping_date'],
                    'phone_number' => $row['phone_number'],
                    'serial_number' => $row['serial_number'],
                    'provider' => $row['provider'],
                    'plan_name' => $row['plan_name'],
                    'service_status' => $row['service_status'] ?? '在庫', // Gán giá trị mặc định nếu null
                    'id_manager_admin' => $row['id_manager_admin'],        // Lưu ID người quản lý
                    'id_username' => $row['id_username'],        // Lưu ID người quản lý
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function saveRequestSimCall(Request $request)
    {
        // Lấy dữ liệu từ request
        $idSim = $request->input('id_sim');
        $requestName = $request->input('request_name');
        $dataSimcall = $request->input('data_simcall');
        $timeSimcall = $request->input('time_simcall');
        $memo = $request->input('memo', '');  // Giá trị mặc định là chuỗi rỗng nếu không có
        $createdAt = $request->input('created_at');
        $confirmedAt = $request->input('confirmed_at', '');  // Giá trị mặc định là chuỗi rỗng nếu không có

        // Kiểm tra dữ liệu đầu vào cần thiết
        if (!$idSim || !$requestName || !$createdAt) {
            return response()->json(['message' => 'Thiếu thông tin bắt buộc: id_sim, request_name, created_at'], 400);
        }

        // Kiểm tra loại yêu cầu và xử lý tương ứng
        if (in_array($requestName, ['停止', '再開', '再発行', '解約'])) {
            $customerRequest = new customer_request();
            $customerRequest->id_sim = $idSim;
            $customerRequest->request_name = $requestName;
            $customerRequest->created_at = $createdAt;
        } elseif (in_array($requestName, ['データ変更'])) {
            if (!$dataSimcall) {
                return response()->json(['message' => 'Thiếu thông tin: data_simcall hoặc timeSimcall'], 400);
            }

            $customerRequest = new customer_request();
            $customerRequest->id_sim = $idSim;
            $customerRequest->request_name = $requestName;
            $customerRequest->data_simcall = $dataSimcall;
            $customerRequest->memo = $memo;
            $customerRequest->confirmed_at = $confirmedAt;
            $customerRequest->created_at = $createdAt;
        } elseif (in_array($requestName, ['かけ放題'])) {
            if (!$timeSimcall) {
                return response()->json(['message' => 'Thiếu thông tin: data_simcall hoặc timeSimcall'], 400);
            }

            $customerRequest = new customer_request();
            $customerRequest->id_sim = $idSim;
            $customerRequest->request_name = $requestName;
            $customerRequest->time_simcall = $timeSimcall;
            $customerRequest->memo = $memo;
            $customerRequest->confirmed_at = $confirmedAt;
            $customerRequest->created_at = $createdAt;
        } elseif (in_array($requestName, ['開通'])) {

            $customerRequest = new customer_request();
            $customerRequest->id_sim = $idSim;
            $customerRequest->request_name = $requestName;
            $customerRequest->data_simcall = $dataSimcall;
            $customerRequest->time_simcall = $timeSimcall;
            $customerRequest->memo = $memo;
            $customerRequest->confirmed_at = $confirmedAt;
            $customerRequest->created_at = $createdAt;
        } else {
            return response()->json(['message' => 'Yêu cầu không được hỗ trợ!'], 400);
        }

        // Lưu bản ghi mới vào cơ sở dữ liệu
        $customerRequest->save();

        // Log dữ liệu lưu được
        Log::info('CustomerRequest saved:', ['data' => $customerRequest]);

        return response()->json(['message' => 'Dữ liệu đã được lưu thành công!', 'data' => $customerRequest], 200);
    }

    public function saveRequestSimData(Request $request)
    {
        // Lấy dữ liệu từ request
        $idSim = $request->input('id_sim');
        $requestName = $request->input('request_name');
        $createdAt = $request->input('created_at');

        // Kiểm tra dữ liệu đầu vào cần thiết
        if (!$idSim || !$requestName || !$createdAt) {
            return response()->json(['message' => 'Thiếu thông tin bắt buộc: id_sim, request_name, created_at'], 400);
        }

        // Kiểm tra loại yêu cầu và xử lý tương ứng
        if (in_array($requestName, ['停止', '再開', '再発行', '解約'])) {
            $customerRequest = new customer_request_simdata();
            $customerRequest->id_sim = $idSim;
            $customerRequest->request_name = $requestName;
            $customerRequest->created_at = $createdAt;
        } else {
            return response()->json(['message' => 'Yêu cầu không được hỗ trợ!'], 400);
        }

        // Lưu bản ghi mới vào cơ sở dữ liệu
        $customerRequest->save();

        // Log dữ liệu lưu được
        Log::info('CustomerRequest saved:', ['data' => $customerRequest]);

        return response()->json(['message' => 'Dữ liệu đã được lưu thành công!', 'data' => $customerRequest], 200);
    }

    public function index()
    {
        // Lấy tất cả customer_request với các quan hệ sim_call và admin
        $data = customer_request::with(['simCall.admin'])  // Eager load quan hệ sim_call và admin
            ->get();

        return view('sim.sim_call', compact('data'));  // Truyền dữ liệu sang view
    }
    public function index_data()
    {
        // Lấy tất cả customer_request với các quan hệ sim_data và admin
        $data = customer_request_simdata::with(['simData.admin'])  // Eager load quan hệ sim_data và admin
            ->get();

        return view('sim.sim_data', compact('data'));  // Truyền dữ liệu sang view
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_username');  // Liên kết với bảng admins thông qua trường id_username
    }
    public function manager_admin()
    {
        return $this->belongsTo(manager_admin::class, 'id_manager_admin');  // Liên kết với bảng admins thông qua trường id_manager_admin
    }
    // Xử lý xác nhận
    public function confirm($id)
    {
        // Tìm customer_request theo ID
        $customerRequest = customer_request::findOrFail($id);

        // Kiểm tra xem id_sim có tồn tại trong bảng customer_request không
        if (!$customerRequest->id_sim) {
            return response()->json(['success' => false, 'message' => 'Không tìm thấy sim trong yêu cầu.']);
        }

        // Lấy thông tin sim từ bảng sim_call dựa trên id_sim
        $sim = sim_call::find($customerRequest->id_sim);

        // Nếu không tìm thấy sim, trả về thông báo lỗi
        if (!$sim) {
            return response()->json(['success' => false, 'message' => 'Không tìm thấy sim trong bảng sim_call.']);
        }

        // Cập nhật trường confirmed_at nếu chưa có
        if (!$customerRequest->confirmed_at) {
            $customerRequest->confirmed_at = now();  // Lưu thời gian hiện tại
            $customerRequest->save();
        }

        // Kiểm tra nếu request_name là 開通
        if ($customerRequest->request_name === '開通') {
            // Cập nhật unlimited_calls thành 普通
            $sim->plan_name = $customerRequest->data_simcall;
            $sim->unlimited_calls = $customerRequest->time_simcall;

            // Cập nhật service_start_date thành giá trị confirmed_at từ customer_request
            $sim->service_start_date = $customerRequest->confirmed_at;

            // Cập nhật service_status thành 利用中
            $sim->service_status = '利用中';

            $sim->save();
        }

        // Kiểm tra nếu request_name là 解約
        else if ($customerRequest->request_name === 'データ変更') {
            // Cập nhật customerRequest thành time_simcall
            $sim->plan_name = $customerRequest->data_simcall;
            $sim->service_start_date = $customerRequest->confirmed_at;
            $sim->service_status = '利用中';
            $sim->save();
        }

        // Kiểm tra nếu request_name là 解約
        else if ($customerRequest->request_name === 'かけ放題') {
            // Cập nhật unlimited_calls thành 普通
            $sim->unlimited_calls = $customerRequest->time_simcall;
            $sim->service_start_date = $customerRequest->confirmed_at;
            $sim->service_status = '利用中';
            $sim->save();
        }
        else if ($customerRequest->request_name === '再発行') {
            // Cập nhật service_status thành 解約済
            $sim->service_status = '再発行';
            $sim->save();
        }
        // Kiểm tra nếu request_name là 解約
        else if ($customerRequest->request_name === '解約') {
            // Cập nhật service_status thành 解約済
            $sim->service_status = '解約済';
            $sim->cancellation_date = $customerRequest->confirmed_at;
            $sim->save();
        } else if ($customerRequest->request_name === '停止') {
            // Cập nhật service_status thành 解約済
            $sim->service_status = '停止';
            $sim->save();
        } else if ($customerRequest->request_name === '再開') {
            // Cập nhật service_status thành 解約済
            $sim->service_status = '利用中';
            $sim->save();
        }
        // Trả về JSON thông báo thành công và thông tin yêu cầu + thông tin sim
        return response()->json([
            'success' => true,
            'customerRequest' => $customerRequest,  // Thông tin yêu cầu
            'sim' => $sim  // Thông tin sim từ bảng sim_call
        ]);
    }

    // Xử lý xác nhận
    public function confirm_simdata($id)
    {
        // Tìm customer_request theo ID
        $customerRequest = customer_request_simdata::findOrFail($id);

        // Kiểm tra xem id_sim có tồn tại trong bảng customer_request không
        if (!$customerRequest->id_sim) {
            return response()->json(['success' => false, 'message' => 'Không tìm thấy sim trong yêu cầu.']);
        }

        // Lấy thông tin sim từ bảng sim_call dựa trên id_sim
        $sim = sim_data::find($customerRequest->id_sim);

        // Nếu không tìm thấy sim, trả về thông báo lỗi
        if (!$sim) {
            return response()->json(['success' => false, 'message' => 'Không tìm thấy sim trong bảng sim_call.']);
        }

        // Cập nhật trường confirmed_at nếu chưa có
        if (!$customerRequest->confirmed_at) {
            $customerRequest->confirmed_at = now();  // Lưu thời gian hiện tại
            $customerRequest->save();
        }

        if ($customerRequest->request_name === '解約') {
            // Cập nhật service_status thành 解約済
            $sim->service_status = '解約済';
            $sim->cancellation_date = $customerRequest->confirmed_at;
            $sim->save();
        } else if ($customerRequest->request_name === '停止') {
            // Cập nhật service_status thành 解約済
            $sim->service_status = '停止';
            $sim->save();
        } else if ($customerRequest->request_name === '再開' || $customerRequest->request_name === '再発行') {
            // Cập nhật service_status thành 解約済
            $sim->service_status = '利用中';
            $sim->save();
        } else {
            // Xử lý trường hợp không phải 開通 hay 解約
            $columnName = $customerRequest->column_name; // Cột cần kiểm tra
            $value = $customerRequest->value; // Giá trị cần cập nhật

            if (empty($columnName)) {
                // Nếu column_name trống, sử dụng request_name để cập nhật service_status
                $sim->service_status = $customerRequest->request_name;
                $sim->save();
            } else {
                // Kiểm tra xem column_name có tồn tại trong bảng sim_call
                if (Schema::hasColumn('sim_data', $columnName)) {
                    // Cập nhật giá trị của cột tương ứng
                    $sim->$columnName = $value;
                    $sim->save();
                } else {
                    return response()->json(['success' => false, 'message' => 'Cột không tồn tại trong bảng sim_call.']);
                }
            }
        }
        // Trả về JSON thông báo thành công và thông tin yêu cầu + thông tin sim
        return response()->json([
            'success' => true,
            'customerRequest' => $customerRequest,  // Thông tin yêu cầu
            'sim' => $sim  // Thông tin sim từ bảng sim_call
        ]);
    }

    // Xử lý huỷ yêu cầu
    public function cancelRequest($id)
    {
        $customerRequest = customer_request::findOrFail($id);

        // Kiểm tra nếu đã xác nhận thì không thể hủy
        if ($customerRequest->confirmed_at) {
            return response()->json(['success' => false, 'message' => 'Yêu cầu đã được xác nhận, không thể hủy.']);
        }

        // Cập nhật trường cancelled_at khi huỷ yêu cầu
        $customerRequest->cancelled_at = now();  // Lưu thời gian huỷ
        $customerRequest->save();

        return response()->json([
            'success' => true,
            'message' => 'Yêu cầu đã được hủy bỏ.',
        ]);
    }

    // Xử lý huỷ yêu cầu
    public function cancelRequest_Simdata($id)
    {
        $customerRequest = customer_request_simdata::findOrFail($id);

        // Kiểm tra nếu đã xác nhận thì không thể hủy
        if ($customerRequest->confirmed_at) {
            return response()->json(['success' => false, 'message' => 'Yêu cầu đã được xác nhận, không thể hủy.']);
        }

        // Cập nhật trường cancelled_at khi huỷ yêu cầu
        $customerRequest->cancelled_at = now();  // Lưu thời gian huỷ
        $customerRequest->save();

        return response()->json([
            'success' => true,
            'message' => 'Yêu cầu đã được hủy bỏ.',
        ]);
    }

    public function updateMemo(Request $request, $id)
    {
        // Tìm item cần cập nhật
        $item = customer_request::find($id);

        if (!$item) {
            return response()->json(['success' => false, 'message' => 'Không tìm thấy item']);
        }

        // Cập nhật giá trị memo
        $item->memo = $request->input('memo');
        $item->save();

        return response()->json(['success' => true]);
    }


    // csv yêu cầu
    public function getIdSimByPhoneNumber(Request $request)
    {
        $phoneNumber = $request->input('phone_number');

        // Tìm số điện thoại trong bảng sim_call
        $sim = sim_call::where('phone_number', $phoneNumber)->first();

        if ($sim) {
            // Trả về idSim nếu tìm thấy
            return response()->json(['idSim' => $sim->id]);
        } else {
            // Nếu không tìm thấy số điện thoại
            return response()->json(['idSim' => null]);
        }
    }

    public function saveRequestCall(Request $request)
    {
        try {
            $data = $request->all();

            // Kiểm tra các trường bắt buộc
            if (!isset($data['id_sim'], $data['request_name'], $data['created_at'])) {
                return response()->json(['status' => 'error', 'message' => 'Missing required fields'], 400);
            }

            // Kiểm tra xem id_sim có tồn tại trong bảng sim_call hay không
            $sim = sim_call::find($data['id_sim']);
            if (!$sim) {
                return response()->json(['status' => 'error', 'message' => 'id_sim not found in sim_call table'], 404);
            }

            // Ghi log dữ liệu nhận được
            Log::info('Received request data:', $data);

            // Lưu dữ liệu vào bảng customer_request
            $customerRequest = customer_request::create([
                'id_sim' => $data['id_sim'],
                'request_name' => $data['request_name'],
                'created_at' => $data['created_at'],
                'data_simcall' => $data['data_simcall'] ?? null,
                'time_simcall' => $data['time_simcall'] ?? null,
                'updated_at' => now(),
            ]);

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            // Ghi log lỗi và trả về lỗi JSON
            Log::error('Error saving request data: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }


    public function getIdSimByPhoneNumberData(Request $request)
    {
        $phoneNumber = $request->query('phone_number');

        // Tìm kiếm sim_call với số điện thoại
        $simdata = sim_data::where('phone_number', $phoneNumber)->first();

        if ($simdata) {
            return response()->json(['idSim' => $simdata->id]);
        } else {
            return response()->json(['idSim' => null], 404);
        }
    }

    public function saveRequestData(Request $request)
    {
        try {
            $data = $request->all();

            // Kiểm tra các trường bắt buộc
            if (!isset($data['id_sim'], $data['request_name'], $data['created_at'])) {
                return response()->json(['status' => 'error', 'message' => 'Missing required fields'], 400);
            }

            // Ghi log dữ liệu nhận được
            Log::info('Received request data:', $data);

            // Lưu dữ liệu bằng Eloquent
            customer_request_simdata::create([
                'id_sim' => $data['id_sim'],
                'request_name' => $data['request_name'],
                'created_at' => $data['created_at'],
                'updated_at' => now(),
            ]);

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            // Ghi log lỗi và trả về lỗi JSON
            Log::error('Error saving request data: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\manager_admin;
use App\Models\delivery_details;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Monolog\Level;
use SebastianBergmann\Environment\Console;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('useraccount', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            // Đăng nhập thành công, lưu thông tin admin vào bộ nhớ phiên
            $request->session()->regenerate();

            // Lưu thông tin admin vào session
            $admin = Auth::guard('admin')->user();
            $request->session()->put('admin', $admin);

            return redirect()->intended(route('admin.dashboard'));
        } else {
            return back()->withErrors(['useraccount' => 'Thông tin đăng nhập không hợp lệ'])->withInput();
        }
    }

    public function admin_accounts()
    {
        $user = Auth::guard('admin')->user();
        $adminId = $user->id;
        $level = $user->level;

        // Thêm điều kiện kiểm tra level
        if ($level == 1 || $level == 2) {
            // Nếu level là 1 hoặc 2, lấy toàn bộ dữ liệu
            $query = Admin::query();
        } else {
            // Nếu level khác 1 hoặc 2, lấy dữ liệu của chính người dùng
            $query = Admin::where('id_username', $adminId);
        }

        // Lấy dữ liệu các đối tác
        $data = $query->get();

        // Tính tổng số đối tác có id_manager = 1 và id_manager = 2
        $totalPartnerManager1 = Admin::where('id_manager', 1)->count();
        $totalPartnerManager2 = Admin::where('id_manager', 2)->count();

        return view('admin.admin_accounts', [
            'data' => $data,
            'totalPartnerManager1' => $totalPartnerManager1,
            'totalPartnerManager2' => $totalPartnerManager2
        ]);
    }
    // AdminController.php
    public function getAdminDetails($id)
    {
        // Tìm admin theo ID
        $admin = Admin::find($id);

        // Nếu không tìm thấy, trả về lỗi
        if (!$admin) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy admin.'
            ]);
        }

        // Trả về thông tin admin dưới dạng JSON
        return response()->json([
            'success' => true,
            'data' => $admin
        ]);
    }


    // AdminController.php
    public function updateAdmin(Request $request, $id)
    {
        // Tìm admin theo ID
        $admin = Admin::find($id);

        // Nếu không tìm thấy admin, trả về lỗi
        if (!$admin) {
            return redirect()->back()->withErrors('Admin không tồn tại.');
        }

        // Cập nhật thông tin admin
        $admin->username = $request->username;
        $admin->useraccount = $request->useraccount;

        // Nếu có mật khẩu, thì cập nhật mật khẩu mới
        if ($request->password) {
            $admin->password = bcrypt($request->password);
        }

        $admin->telephonenumber = $request->telephonenumber;
        $admin->address = $request->address;
        $admin->business = $request->business;
        $admin->emailaddress = $request->emailaddress;
        $admin->tax_number = $request->tax_number;
        $admin->level = $request->level;
        $admin->id_manager = $request->id_manager;

        // Lưu thông tin đã cập nhật
        $admin->save();

        // Chuyển hướng về danh sách admin và thông báo thành công
        return redirect()->route('admin.admin_accounts')->with('success', 'Cập nhật admin thành công.');
    }

    // Trang chủ
    public function dashboard(Request $request)
    {
        $user = Auth::guard('admin')->user();
        $adminId = $user->id;
        $level = $user->level;

        // Giả sử bạn có các biến dữ liệu cần thiết
        $business = $user->business;
        $username = $user->username;
        $telephonenumber = $user->telephonenumber;
        $emailaddress = $user->emailaddress;
        $address = $user->address;
        $tax_number = $user->tax_number;
        $id_manager = $user->id_manager;

        // Thêm điều kiện kiểm tra level
        if ($level == 1 || $level == 2 || $level == 3 || $level == 4 || $level == 5 || $level == 6) {
            // Nếu level là 1 hoặc 2, lấy toàn bộ dữ liệu
            $query = delivery_details::query();
        } else {
            // Nếu level khác 1 hoặc 2, lấy dữ liệu của chính người dùng
            $query = delivery_details::where('id_username', $adminId);
        }

        // Thêm phân trang: giả sử mỗi trang sẽ hiển thị 1000 SIM
        $data = $query->get();

        // Đếm số lượng yêu cầu có approval_status là 承認済 (đã xác nhận)
        $approvedCount = $data->where('approval_status', '承認済')->count();

        // Đếm số lượng yêu cầu có approval_status là キャンセル (đã huỷ bỏ)
        $cancelledCount = $data->where('approval_status', 'キャンセル')->count();

        // Đếm số lượng yêu cầu có shipping_status là 発送済 (đã gửi) hoặc 手渡し (đưa tay)
        $shippedCount = $data->whereIn('shipping_status', ['発送済', '手渡し'])->count();

        // Đếm số lượng yêu cầu có shipping_status là 取消し (hủy bỏ)
        $cancelledShippingCount = $data->where('shipping_status', '取消し')->count();

        return view('admin.dashboard', [
            'data' => $data,
            'level' => $level,
            'business' => $business,
            'username' => $username,
            'telephonenumber' => $telephonenumber,
            'emailaddress' => $emailaddress,
            'address' => $address,
            'tax_number' => $tax_number,
            'id_manager' => $id_manager,
            'approvedCount' => $approvedCount,
            'cancelledCount' => $cancelledCount,
            'shippedCount' => $shippedCount,
            'cancelledShippingCount' => $cancelledShippingCount
        ]);
    }

    // Đăng xuất
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('success', 'Bạn đã đăng xuất.');
    }

    public function admin_showRegisterForm()
    {
        $managers = manager_admin::all(); // Lấy tất cả các quản lý từ bảng manager_admin
        return view('admin.register', compact('managers')); // Truyền biến managers vào view
    }

    public function register(Request $request)
    {
        // Validate dữ liệu từ form
        $request->validate(
            [
                'useraccount' => 'required|string|max:255|unique:admin,useraccount',
                'password' => 'required|string|min:5',
                'username' => 'required|string|max:255',
                'level' => 'required|integer|between:1,7',
                'business' => 'required|string|max:255',
                'telephonenumber' => 'required|string|max:15',
                'emailaddress' => 'required|string|email|max:255|unique:admin,emailaddress',
                'address' => 'required|string|max:255',
                'tax_number' => 'required|string|max:20',
                'id_manager' => 'required|exists:manager_admin,id',
            ],
            [
                'useraccount.unique' => 'Tài khoản này đã tồn tại. Vui lòng chọn tài khoản khác.',
                'emailaddress.unique' => 'Email này đã được sử dụng. Vui lòng chọn email khác.',
            ]
        );

        // Lưu thông tin admin mới
        Admin::create([
            'useraccount' => $request->useraccount,
            'password' => bcrypt($request->password),
            'username' => $request->username,
            'level' => $request->level,
            'business' => $request->business,
            'telephonenumber' => $request->telephonenumber,
            'emailaddress' => $request->emailaddress,
            'address' => $request->address,
            'tax_number' => $request->tax_number,
            'id_manager' => $request->id_manager,
        ]);

        // Chuyển hướng kèm thông báo thành công
        return redirect()->route('admin.admin_accounts')->with('success', 'Quản trị viên đã đăng ký thành công');
    }

    public function create_order_sim(Request $request)
    {
        // Lấy ID người dùng hiện tại
        $userId = Auth::id();

        // Validate dữ liệu từ form
        $validated = $request->validate([
            'delivery_date' => 'required|date|after_or_equal:today',
            'delivery_type' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'plan' => 'required|string|max:255',
            'desired_delivery_date' => 'required|date|after_or_equal:delivery_date',
            'postal_code' => 'required|string|max:10',
            'delivery_address' => 'required|string|max:255',
            'delivery_time' => 'required|string|max:255',
            'shipping_type' => 'required|string|max:255',
            'notes' => 'nullable|string|max:255'
        ]);
        $validated['id_username'] = $userId;

        // Lưu dữ liệu vào cơ sở dữ liệu
        delivery_details::create($validated);

        return redirect()->back()->with('success', 'Đơn hàng đã được tạo thành công.');
    }
    // Hàm để cập nhật đơn hàng
    public function update_order_sim(Request $request)
    {
        $id = $request->input('order_id');
        $item = delivery_details::findOrFail($id);

        // Validate dữ liệu từ request
        $request->validate([
            'delivery_date' => 'required|date',
            'delivery_type' => 'required|string',
            'quantity' => 'required|integer',
            'plan' => 'nullable|string',
            'notes' => 'required|string',
            'postal_code' => 'required|string',
            'delivery_address' => 'required|string',
            'shipping_type' => 'required|string',
            'desired_delivery_date' => 'required|date',
            'delivery_time' => 'required|string',
            'approval_status' => 'nullable|string',
            'product_number' => 'nullable|string',
            'inquiry_number' => 'nullable|string',
            'shipping_status' => 'nullable|string',
            'memo' => 'nullable|string',
        ]);

        // Tìm bản ghi theo id và cập nhật
        $item->update([
            'delivery_date' => $request->input('delivery_date'),
            'delivery_type' => $request->input('delivery_type'),
            'quantity' => $request->input('quantity'),
            'plan' => $request->input('plan'),
            'notes' => $request->input('notes'),
            'postal_code' => $request->input('postal_code'),
            'delivery_address' => $request->input('delivery_address'),
            'shipping_type' => $request->input('shipping_type'),
            'desired_delivery_date' => $request->input('desired_delivery_date'),
            'delivery_time' => $request->input('delivery_time'),
            'approval_status' => $request->input('approval_status'),
            'product_number' => $request->input('product_number'),
            'inquiry_number' => $request->input('inquiry_number'),
            'shipping_status' => $request->input('shipping_status'),
            'memo' => $request->input('memo'),
        ]);

        // Redirect with success message
        return redirect()->back()->with('success', 'Dữ liệu đã được cập nhật thành công.');
    }

    public function edit($id)
    {
        // Kiểm tra xem đơn hàng có tồn tại hay không
        $item = delivery_details::find($id);

        if (!$item) {
            return response()->json(['error' => 'Không tìm thấy đơn hàng.'], 404);
        }

        return response()->json($item);
    }
}

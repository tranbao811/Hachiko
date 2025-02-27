<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\application_details;
use App\Models\application_types;
use App\Models\construction_dates;
use App\Models\countries;
use App\Models\campaigns;
use App\Models\manager_admin;
use App\Models\fixed_wifi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Monolog\Level;
use SebastianBergmann\Environment\Console;

class WifiController extends Controller
{
    // WiFi cố định
    public function wifi_codinh(Request $request)
    {
        $user = Auth::guard('admin')->user(); // Lấy thông tin người dùng đã đăng nhập
        $username = $user->username;
        $level = $user->level; // Lấy giá trị của level

        // Lấy tất cả từ cơ sở dữ liệu
        $countries = countries::all();
        $application_details = application_details::all();
        $application_types = application_types::all();
        $construction_dates = construction_dates::all();
        $campaigns = campaigns::all();

        // Kiểm tra quyền truy cập của người dùng
        if (in_array($level, [1, 2, 3, 4])) {
            // Nếu level là 1, 2, 3, hoặc 4, lấy toàn bộ dữ liệu và áp dụng lọc
            $query = fixed_wifi::query(); // Chắc chắn model đã được import
        } else {
            // Nếu level khác, lấy dữ liệu theo username và áp dụng lọc
            $query = fixed_wifi::where('sales_destination', $username);
        }

        // Lấy dữ liệu từ query đã lọc
        $data = $query->get();

        // Truyền các biến vào view
        return view('wifi.wifi_codinh', [
            'data' => $data,
            'username' => $username,
            'countries' => $countries,
            'application_details' => $application_details,
            'application_types' => $application_types,
            'construction_dates' => $construction_dates,
            'campaigns' => $campaigns
        ]);
    }

    public function create_wifi(Request $request)
    {
        // Validation dữ liệu đầu vào
        $validated = $request->validate([
            'sales_destination' => 'required|string|max:100',
            'full_name' => 'required|string|max:100',
            'facebook_url' => 'required|string|max:100',
            'application_date' => 'required|date',
            'application_details' => 'required|string',
            'application_types' => 'required|string|max:100',
            'contractor_name_kanji' => 'required|string|max:100',
            'contractor_name_kana' => 'required|string|max:100',
            'applicant_gender' => 'required|in:女,男,不明',
            'applicant_birthdate' => 'required|string|max:50',
            'contact_number' => 'required|string|max:50',
            'post_confirmation_time' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'nationality' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
            'address' => 'required|string|max:255',
            'estimated_households_count' => 'required|integer',
            'payment_method' => 'required|string|max:100',
            'pre_installation_rental' => 'required|string|max:100',
            'construction_request_date' => 'required|string|max:50',
            'construction_payment_installments' => 'required|string|max:50',
            'campaign' => 'required|string|max:100',
        ]);

        // Nếu validation thành công, thực hiện chèn dữ liệu vào bảng `fixed_wifi`
        $wifi = new fixed_wifi();
        $wifi->sales_destination = $request->sales_destination;
        $wifi->full_name = $request->full_name;
        $wifi->facebook_url = $request->facebook_url;
        $wifi->application_date = $request->application_date;
        $wifi->application_details = $request->application_details;
        $wifi->application_types = $request->application_types;
        $wifi->contractor_name_kanji = $request->contractor_name_kanji;
        $wifi->contractor_name_kana = $request->contractor_name_kana;
        $wifi->applicant_gender = $request->applicant_gender;
        $wifi->applicant_birthdate = $request->applicant_birthdate;
        $wifi->contact_number = $request->contact_number;
        $wifi->post_confirmation_time = $request->post_confirmation_time;
        $wifi->email = $request->email;
        $wifi->nationality = $request->nationality;
        $wifi->postal_code = $request->postal_code;
        $wifi->address = $request->address;
        $wifi->estimated_households_count = $request->estimated_households_count;
        $wifi->payment_method = $request->payment_method;
        $wifi->pre_installation_rental = $request->pre_installation_rental;
        $wifi->construction_request_date = $request->construction_request_date;
        $wifi->construction_payment_installments = $request->construction_payment_installments;
        $wifi->campaign = $request->campaign;

        // Lưu vào cơ sở dữ liệu
        $wifi->save();

        // Chuyển hướng lại trang với thông báo thành công
        return redirect()->back()->with('success', 'Đăng ký WiFi đã được tạo thành công.');
    }

    public function updateField(Request $request)
    {
        // Tìm item theo ID
        $item = fixed_wifi::find($request->id);
        if (!$item) {
            return response()->json(['error' => 'Item not found'], 404);
        }

        // Cập nhật trường dữ liệu
        $item->{$request->field} = $request->value;
        $item->save();

        // Trả về phản hồi thành công
        return response()->json(['success' => 'Updated successfully']);
    }
    // CareerController.php
    public function updateCheckbox(Request $request)
    {
        $validated = $request->validate([
            'item_id' => 'required|integer',
            'field' => 'required|string',
            'value' => 'required|boolean',
        ]);

        // Lấy item từ cơ sở dữ liệu
        $item = fixed_wifi::find($validated['item_id']);
        if ($item) {
            // Cập nhật trường tương ứng dựa trên tên trường (field)
            $item->{$validated['field']} = $validated['value'];
            $item->save();

            return response()->json(['message' => 'Status updated successfully']);
        }

        return response()->json(['message' => 'Item not found'], 404);
    }
}

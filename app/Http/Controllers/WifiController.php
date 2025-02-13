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
        // Xác thực dữ liệu trước khi lưu vào cơ sở dữ liệu (nếu cần)
        $validated = $request->validate([
            'sales_destination' => 'required|string|max:100',
            'full_name' => 'required|string|max:100',
            'facebook_url' => 'nullable|url',
            'application_date' => 'required|date',
            'application_details' => 'required|integer',
            'application_types' => 'required|integer',
            'contractor_name_kanji' => 'required|string|max:100',
            'contractor_name_kana' => 'required|string|max:100',
            'applicant_gender' => 'nullable|string',
            'applicant_birthdate' => 'required|date',
            'contact_number' => 'required|string|max:15',
            'post_confirmation_time' => 'required|date_format:H:i', // Sử dụng date_format thay vì time
            'email' => 'required|email|max:100',
            'nationality' => 'required|integer',
            'postal_code' => 'required|string|max:10',
            'address' => 'required|string|max:100',
            'estimated_households_count' => 'nullable|integer',
            'payment_method' => 'required|string|max:50',
            'pre_installation_rental' => 'required|string|max:10',
            'construction_request_date' => 'required|integer',
            'construction_payment_installments' => 'required|string|max:50',
            'campaign' => 'required|integer',
        ]);

        // Lưu dữ liệu vào cơ sở dữ liệu
        $wifi = fixed_wifi::create([
            'sales_destination' => $request->sales_destination,
            'full_name' => $request->full_name,
            'facebook_url' => $request->facebook_url,
            'application_date' => $request->application_date,
            'application_details' => $request->application_details,
            'application_types' => $request->application_types,
            'contractor_name_kanji' => $request->contractor_name_kanji,
            'contractor_name_kana' => $request->contractor_name_kana,
            'applicant_gender' => $request->applicant_gender,
            'applicant_birthdate' => $request->applicant_birthdate,
            'contact_number' => $request->contact_number,
            'post_confirmation_time' => $request->post_confirmation_time,
            'email' => $request->email,
            'nationality' => $request->nationality,
            'postal_code' => $request->postal_code,
            'address' => $request->address,
            'estimated_households_count' => $request->estimated_households_count,
            'payment_method' => $request->payment_method,
            'pre_installation_rental' => $request->pre_installation_rental,
            'construction_request_date' => $request->construction_request_date,
            'construction_payment_installments' => $request->construction_payment_installments,
            'campaign' => $request->campaign,
        ]);

        dd($wifi);

        // Nếu lưu thành công, bạn có thể phản hồi thành công
        return redirect()->route('wifi.create_wificodinh')->with('success', 'Thông tin đã được gửi thành công!');
    }
}

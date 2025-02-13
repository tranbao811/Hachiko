<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Closure;
use Illuminate\Http\Request;

class CheckAdminLevel
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user(); // Lấy thông tin admin hiện tại
    
        // Kiểm tra nếu request có id_username
        if ($request->has('id_username')) {
            // Lấy dữ liệu liên quan đến người dùng có id_username
            $relatedData = $this->getDataForUser($request->id_username);
    
            // Kiểm tra nếu id_username trùng với ID của người dùng hiện tại hoặc không có dữ liệu tương ứng
            if ($request->id_username == $user->id || is_null($relatedData)) {
                $request->merge(['relatedData' => $relatedData]);
            } else {
                // Gắn null vào relatedData nếu id_username không trùng với ID của người dùng hiện tại và có dữ liệu tương ứng
                $request->merge(['relatedData' => null]);
            }
        }
    
        return $next($request);
    }
    
    // Hàm để lấy dữ liệu liên quan đến người dùng
    protected function getDataForUser($id)
    {
        // Truy vấn dữ liệu liên quan đến người dùng có ID là $id
        // Thay thế bằng logic lấy dữ liệu của bạn, ví dụ:
        return Admin::find($id);
    }
    
    
}

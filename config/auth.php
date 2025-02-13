<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | Tùy chọn này kiểm soát "bảo vệ" xác thực mặc định và mật khẩu
    | tùy chọn đặt lại cho ứng dụng của bạn. Bạn có thể thay đổi các mặc định này
    | khi cần, nhưng chúng là khởi đầu hoàn hảo cho hầu hết các ứng dụng.
    |
    */

    'defaults' => [
        'guard' => 'admin',
        'passwords' => 'admin',
    ],

    /*
    |--------------------------------------------------------------------------
    | Bảo vệ xác thực
    |--------------------------------------------------------------------------
    |
    | Tiếp theo, bạn có thể định nghĩa mọi bảo vệ xác thực cho ứng dụng của mình.
    | Tất nhiên, một cấu hình mặc định tuyệt vời đã được định nghĩa cho bạn
    | tại đây sử dụng bộ lưu trữ phiên và nhà cung cấp người dùng Eloquent.
    |
    | Tất cả trình điều khiển xác thực đều có một nhà cung cấp người dùng. Điều này định nghĩa cách thức
    | người dùng thực sự được truy xuất ra khỏi cơ sở dữ liệu hoặc bộ lưu trữ khác
    | các cơ chế mà ứng dụng này sử dụng để lưu trữ dữ liệu của người dùng.
    |
    | Được hỗ trợ: "phiên"
    |
    */

    'guards' => [
        'admin' => [
            'driver' => 'session',
            'provider' => 'admin',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Nhà cung cấp người dùng
    |-----------------------------------------------------------------------------
    |
    | Tất cả trình điều khiển xác thực đều có nhà cung cấp người dùng. Điều này xác định cách thức
    | người dùng thực sự được truy xuất từ ​​cơ sở dữ liệu hoặc bộ lưu trữ khác
    | cơ chế được ứng dụng này sử dụng để lưu trữ dữ liệu của người dùng.
    |
    | Nếu bạn có nhiều bảng hoặc mô hình người dùng, bạn có thể cấu hình nhiều
    | nguồn đại diện cho từng mô hình/bảng. Sau đó, các nguồn này có thể
    | được chỉ định cho bất kỳ bảo vệ xác thực bổ sung nào mà bạn đã xác định.
    |
    | Được hỗ trợ: "cơ sở dữ liệu", "trôi chảy"
    |
    */

    'providers' => [
        'admin' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Đặt lại mật khẩu
    |-----------------------------------------------------------------------------
    |
    | Bạn có thể chỉ định nhiều cấu hình đặt lại mật khẩu nếu bạn có nhiều hơn một bảng hoặc mô hình người dùng trong ứng dụng và bạn muốn có các thiết lập đặt lại mật khẩu riêng biệt dựa trên các loại người dùng cụ thể.
    |
    | Thời gian hết hạn là số phút mà mỗi mã thông báo đặt lại sẽ được
    | coi là hợp lệ. Tính năng bảo mật này giữ cho các mã thông báo tồn tại trong thời gian ngắn để
    | chúng có ít thời gian để đoán hơn. Bạn có thể thay đổi tùy theo nhu cầu.
    |
    | Cài đặt điều tiết là số giây mà người dùng phải đợi trước khi
    | tạo thêm mã thông báo đặt lại mật khẩu. Điều này ngăn người dùng
    | nhanh chóng tạo ra một lượng lớn mã thông báo đặt lại mật khẩu.
    |
    */

    'passwords' => [
        'admin' => [
            'provider' => 'admin',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Thời gian chờ xác nhận mật khẩu
    |-----------------------------------------------------------------------------
    |
    | Tại đây, bạn có thể xác định số giây trước khi thời gian chờ xác nhận mật khẩu
    | hết hạn và người dùng được nhắc nhập lại mật khẩu của họ qua
    | màn hình xác nhận. Theo mặc định, thời gian chờ kéo dài trong ba giờ.
    |
    */

    'password_timeout' => 10800,

];

<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admin'; // Tên bảng trong cơ sở dữ liệu
    protected $fillable = ['useraccount', 'password', 'username', 'level', 'business', 'telephonenumber', 'emailaddress', 'address', 'tax_number', 'id_manager']; // Các trường có thể gán
    protected $hidden = ['password']; // Ẩn trường password khi trả về kết quả
}

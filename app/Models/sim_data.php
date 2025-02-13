<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sim_data extends Model
{
    use HasFactory;
    protected $table = 'sim_data';  // Tên bảng trong cơ sở dữ liệu

    // Quan hệ với bảng admin thông qua trường id_username
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_username');  // Liên kết với bảng admin qua id_username
    }
    public function admin_manager()
    {
        return $this->belongsTo(manager_admin::class, 'id_manager_admin');  // Liên kết với bảng admin qua id_username
    }
}

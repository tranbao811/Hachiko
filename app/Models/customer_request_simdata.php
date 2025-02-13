<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer_request_simdata extends Model
{
    use HasFactory;

    protected $table = 'customer_request_simdata';  // Tên bảng trong cơ sở dữ liệu
    protected $fillable = [
        'id_sim',
        'request_name',
        'memo',
        'confirmed_at',
        'created_at',
        'cancelled_at'
    ];

    // Quan hệ với bảng sim_call
    public function simData()
    {
        return $this->belongsTo(sim_data::class, 'id_sim', 'id');  // Liên kết với bảng sim_call qua id_sim
    }

    // Quan hệ với bảng admin thông qua bảng sim_call (id_username trong bảng sim_call trỏ tới id trong bảng admin)
    public function admin()
    {
        return $this->hasOneThrough(Admin::class, sim_data::class, 'id_sim', 'id', 'id_sim', 'id_username');
    }

    // Quan hệ với bảng manager_admin thông qua bảng sim_call (id_manager_admin trong bảng sim_call trỏ tới id trong bảng admin)
    public function manager_admin()
    {
        return $this->hasOneThrough(manager_admin::class, sim_data::class, 'id_sim', 'id', 'id_sim', 'id_manager_admin');
    }
}

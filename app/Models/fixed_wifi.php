<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fixed_wifi extends Model
{
    use HasFactory;
    protected $table = 'fixed_wifi';  // Tên bảng trong cơ sở dữ liệu

    // Đảm bảo khai báo các trường cần lưu
    protected $fillable = [
        'sales_destination',
        'full_name',
        'facebook_url',
        'application_date',
        'application_details',
        'application_type',
        'contractor_name_kanji',
        'contractor_name_kana',
        'applicant_gender',
        'applicant_birthdate',
        'contact_number',
        'post_confirmation_time',
        'email',
        'nationality',
        'postal_code',
        'address',
        'estimated_households_count',
        'payment_method',
        'pre_installation_rental',
        'construction_request_date',
        'construction_payment_installments',
        'campaign',
        'created_at',
        'updated_at'
    ];

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

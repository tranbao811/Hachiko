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
        'career_confirmed',
        'payment_status',
        'application_number',
        'remarks',
        'crew_code',
        'person_in_charge',
        'fee_amount',
        'payment_status_detail',
        'fiscal_year',
        'receipt_status_at_time',
        'sales_destination',
        'full_name',
        'facebook_url',
        'profile',
        'sim',
        'router',
        'application_status',
        'confirmation_call_status',
        'application_date',
        'application_details',
        'application_type',
        'contractor_name_kanji',
        'contractor_name_kana',
        'applicant_gender',
        'applicant_birthdate',
        'contact_number',
        'post_confirmation_person',
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
        'entry_status',
        'installation_status',
        'construction_type',
        'construction_date',
        'opening_date',
        'month_number',
        'fiscal_year_again',
        'tp_link',
        'registration_url',
        'registration_status',
        'account_registration_status',
        'residence_card_number',
        'qualification_status',
        'residence_card_shared_with',
        'remarks_detail',
        'processing_status',
        'status',
        'month_number_again',
        'confirmation_field',
        'login_url',
        'mypage_id',
        'password',
        'payment_confirmation_status_1',
        'payment_confirmation_status_2',
        'payment_confirmation_status_3',
        'payment_status_detail_final',
        'payment_memo',
        'first_month',
        'second_month',
        'third_month',
        'fee',
        'total'
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

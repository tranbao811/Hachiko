<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class delivery_details extends Model
{
    // Các thuộc tính và phương thức khác của mô hình

    protected $table = 'delivery_details';  // Tên bảng trong cơ sở dữ liệu
    protected $fillable = [
        'delivery_date',
        'delivery_type',
        'quantity',
        'plan',
        'postal_code',
        'delivery_address',
        'shipping_type',
        'desired_delivery_date',
        'delivery_time',
        'approval_status',
        'product_number',
        'inquiry_number',
        'shipping_status',
        'notes',
        'memo',
        'id_username' // Thêm id_username vào $fillable
    ];
}
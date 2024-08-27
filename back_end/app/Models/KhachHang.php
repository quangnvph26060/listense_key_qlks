<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhachHang extends Model
{
    use HasFactory;
    protected $table = 'khach_hang';
    protected $fillable = [
        'email',
        'ten_khach_hang',
        'so_dien_thoai',
        'dia_chi',
        'hinh_anh',
        'ngay_sinh',
        'gioi_tinh',
        'gplx_nguoi_dung',
        'ma_nguoi_dung'
    ];
}

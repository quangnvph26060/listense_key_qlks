<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhanVien extends Model
{
    use HasFactory;
    protected $table = 'nhan_vien';
    protected $fillable = [
        'email',
        'ten_nhan_vien',
        'so_dien_thoai',
        'dia_chi',
        'hinh_anh',
        'ngay_sinh',
        'gioi_tinh',
        'gplx_nguoi_dung',
        'ma_nguoi_dung'
    ];
}

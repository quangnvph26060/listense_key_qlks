<?php

namespace Database\Seeders;

use App\Models\KhachHang;
use App\Models\NhanVien;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'full name',
                'email' => 'quang3011003@gmail.com',
                'password' => Hash::make('123456'),
                'ma_phan_quyen' => 1,
            ],
            [
                'name' => 'full name',
                'email' => 'quang30112003@gmail.com',
                'password' => Hash::make('123456'),
                'ma_phan_quyen' => 2,
            ],
        ];

        foreach ($data as $user) {
            User::create($user);
        }
        $dataNhanVien = [
            'email' => 'quang3011003@gmail.com',
            'ten_nhan_vien'=>'demo 1',
            'so_dien_thoai'=>'09877677643',
            'dia_chi'=>'ha noi',
            'hinh_anh'=>'',
            'ngay_sinh'=>date('Y-m-d', strtotime('03/02/2024')),
            'gioi_tinh'=>1,
            'gplx_nguoi_dung'=>'2222',
            'ma_nguoi_dung'=>1,
        ];
        NhanVien::create($dataNhanVien);
        $dataKhachHang = [
            'email' => 'quang3011003@gmail.com',
            'ten_khach_hang'=>'name khach hang',
            'so_dien_thoai'=>'0987767777',
            'dia_chi'=>'ha noi',
            'hinh_anh'=>'',
            'ngay_sinh'=>date('Y-m-d', strtotime('03/02/2024')),
            'gioi_tinh'=>1,
            'gplx_nguoi_dung'=>'4444',
            'ma_nguoi_dung'=>2,
        ];
        KhachHang::create($dataKhachHang);
    }
}

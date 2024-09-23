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
            ],
            [
                'name' => 'full name',
                'email' => 'quang30112003@gmail.com',
                'password' => Hash::make('123456'),
            ],
        ];

        foreach ($data as $user) {
            User::create($user);
        }
    }
}

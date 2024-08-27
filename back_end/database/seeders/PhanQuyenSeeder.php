<?php

namespace Database\Seeders;

use App\Models\PhanQuyen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PhanQuyenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $data = [
        "khach hang",
        "nhan vien"
       ];
       foreach ($data as $key => $value) {

            PhanQuyen::create([
                'phan_quyen' => $value
            ]);
        }
    }
}

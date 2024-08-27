<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('danh_gia', function (Blueprint $table) {
            $table->id();
            $table->string('diem_so');
            $table->string('noi_dung');
            $table->unsignedBigInteger('ma_khach_hang');
            $table->foreign('ma_khach_hang')->references('id')->on('khach_hang');
            $table->unsignedBigInteger('ma_phuong_tien');
            $table->foreign('ma_phuong_tien')->references('id')->on('xe');
            $table->boolean('trang_thai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('danh_gia');
    }
};

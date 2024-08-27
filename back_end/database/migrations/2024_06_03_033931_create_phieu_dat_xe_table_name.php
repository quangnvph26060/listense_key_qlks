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
        Schema::create('phieu_dat_xe', function (Blueprint $table) {
            $table->id();
            $table->string('gplx_khach_hang');
            $table->integer('cccd_khach_hang');
            $table->date('ngay_bat_dau');
            $table->date('ngay_ket_thuc');
            $table->string('gia_tien');
            $table->date('ngay_duyet');
            $table->boolean('trang_thai');
            $table->unsignedBigInteger('ma_xe');
            $table->foreign('ma_xe')->references('id')->on('xe');
            $table->unsignedBigInteger('ma_khach_hang');
            $table->foreign('ma_khach_hang')->references('id')->on('khach_hang');
            $table->unsignedBigInteger('ma_hoa_don');
            $table->foreign('ma_hoa_don')->references('id')->on('hoa_don');
            $table->unsignedBigInteger('ma_nhan_vien');
            $table->foreign('ma_nhan_vien')->references('id')->on('nhan_vien');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phieu_dat_xe');
    }
};

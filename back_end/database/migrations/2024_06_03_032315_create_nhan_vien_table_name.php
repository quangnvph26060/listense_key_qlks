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
        Schema::create('nhan_vien', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('ten_nhan_vien')->nullable();
            $table->string('so_dien_thoai')->nullable();
            $table->string('dia_chi')->nullable();
            $table->string('hinh_anh')->nullable();
            $table->date('ngay_sinh')->nullable();
            $table->boolean('gioi_tinh')->nullable()->default(false);
            $table->string('gplx_nguoi_dung')->nullable();
            $table->unsignedBigInteger('ma_nguoi_dung')->nullable();
            $table->foreign('ma_nguoi_dung')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nhan_vien');
    }
};

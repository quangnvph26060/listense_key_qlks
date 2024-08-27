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
        Schema::create('hoa_don', function (Blueprint $table) {
            $table->id();
            $table->date('ngay_tao');
            $table->unsignedBigInteger('ma_thanh_toan')->nullable();
            $table->foreign('ma_thanh_toan')->references('id')->on('thanh_toan');
            $table->unsignedBigInteger('ma_nhan_vien')->nullable();
            $table->foreign('ma_nhan_vien')->references('id')->on('nhan_vien');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hoa_don');
    }
};

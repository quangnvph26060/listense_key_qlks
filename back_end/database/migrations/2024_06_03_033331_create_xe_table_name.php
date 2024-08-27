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
        Schema::create('xe', function (Blueprint $table) {
            $table->id();
            $table->string('ten_xe');
            $table->string('kieu_xe');
            $table->integer('gia_thue_ngay');
            $table->string('dia_chi');
            $table->string('hinh_anh');
            $table->string('mo_ta')->nullable();
            $table->string('bien_so_xe');
            $table->string('ngay_dk_xe');
            $table->boolean('trang_thai');
            $table->unsignedBigInteger('ma_hang_xe');
            $table->foreign('ma_hang_xe')->references('id')->on('hang_xe');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('xe');
    }
};

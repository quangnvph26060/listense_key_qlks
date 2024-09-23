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
        Schema::create('listense_keys', function (Blueprint $table) {
            $table->id();
            $table->string('code', 36)->unique();
            $table->string('url', 255)->nullable();
            $table->string('user')->nullable();
            $table->string('email')->nullable();
            $table->string('product')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listense_keys');
    }
};

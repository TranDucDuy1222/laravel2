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
        Schema::create('maGiamGia', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Mã giảm giá
            $table->decimal('phan_tram', 5, 2); // Phần trăm giảm giá
            $table->string('mo_ta')->nullable();
            $table->unsignedBigInteger('id_kh')->nullable(); // mã dùng 1 lần cho 1 khách hàng
            $table->unsignedInteger('ma_gioi_han')->nullable(); // Số lần sử dụng còn lại của mã dùng nhiều lần
            $table->boolean('mot_nhieu')->default(false);// dùng 1 lần hay nhiều lần
            $table->date('ngay_het_han')->nullable(); // Ngày hết hạn
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maGiamGia');
    }
};

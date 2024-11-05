<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('danh_muc', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ten_dm', 100);
            $table->string('slug', 100)->nullable();
            $table->integer('thu_tu')->default(0);
            $table->integer('id_loai')->nullable();
            $table->boolean('an_hien')->default(0);
            $table->timestamps();
        });

        Schema::create('san_pham', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ten_sp', 200)->unique();
            $table->string('slug');
            $table->integer('gia');
            $table->integer('gia_km')->nullable();
            $table->unsignedBigInteger('id_dm'); // Đảm bảo cột này là unsigned
            $table->foreign('id_dm')->references('id')->on('danh_muc')->onDelete('cascade');
            $table->string('hinh', 255)->nullable();
            $table->text('mo_ta_ct')->nullable();
            $table->text('mo_ta_ngan')->nullable();
            $table->boolean('trang_thai')->default(0);
            $table->integer('luot_xem')->default(0);
            $table->boolean('tinh_chat'); // 0 bình thường, 1 giá rẻ, 2 giảm sốc, 3 cao cấp
            $table->string('color', 50)->nullable();
            $table->date('ngay');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
        Schema::create('sizes', function (Blueprint $table) {
            $table->id();
            $table->string('size_product', 50);
            $table->integer('so_luong');
            $table->integer('id_product');
            $table->timestamps();
        });
        Schema::create('don_hang', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->datetime('thoi_diem_mua_hang')->comment('Thời điểm mua hàng');
            $table->integer('id_dc');
            $table->integer('tong_dh')->comment('Tổng tiền sản phẩm');
            $table->string('pttt');
            $table->boolean('trang_thai')->default(0)->comment('Trạng thái đơn hàng');
            $table->timestamps();
        });
        Schema::create('chi_tiet_don_hang', function (Blueprint $table) {
            $table->id();
            $table->integer('id_dh')->comment('Mã đơn hàng');
            $table->integer('id_sp')->comment('Mã sản phẩm');
            $table->integer('so_luong')->default(1)->comment('Số lượng mua');
            $table->string('size')->nullable();
            $table->integer('gia')->comment('Giá mua sản phẩm');
            $table->timestamps();
        });
        Schema::create('danh_gia', function (Blueprint $table) {
            $table->id();
            $table->integer('id_sp')->comment('Mã sản phẩm');
            $table->integer('id_user')->comment('Người bình luận');
            $table->text('noi_dung')->comment('Nội dung bình luận');
            $table->string('quality_product')->nullable();
            $table->datetime('thoi_diem')->comment('Thời điểm bình luận');
            $table->string('hinh_dg', 255)->nullable();
            $table->string('feedback')->nullable();
            $table->boolean('an_hien')->default(0)->comment('0 là ẩn 1 là hiện');
            $table->timestamps();
        });
        Schema::create('dia_chi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_user')->unsigned()->comment('Người bình luận');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->string('phone', 15);
            $table->string('ho_ten');
            $table->string('dc_chi_tiet', 150)->nullable();
            $table->string('qh', 50)->nullable();
            $table->string('thanh_pho', 50)->nullable();
            $table->boolean('an_hien')->default(0)->comment('0 là ẩn 1 là hiện');
            $table->timestamps();
        });
        Schema::create('loai', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ten_loai', 100);
            $table->string('slug', 100)->nullable();
            $table->integer('thu_tu')->default(0);
            $table->boolean('an_hien')->default(0);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('danh_muc');
        Schema::dropIfExists('san_pham');
        Schema::dropIfExists('sizes');
        Schema::dropIfExists('don_hang');
        Schema::dropIfExists('chi_tiet_don_hang');
        Schema::dropIfExists('danh_gia');
        Schema::dropIfExists('dia_chi');
        Schema::dropIfExists('loai');
    }
};

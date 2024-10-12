<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('landing_page', function (Blueprint $table) {
            $table->id();
            $table->string('anh_bieu_ngu_1');
            $table->string('tieu_de_chinh_1');
            $table->string('mau_tieu_de_chinh_1');
            $table->string('tieu_de_phu_1');
            
            $table->string('anh_bieu_ngu_2');
            $table->string('tieu_de_chinh_2');
            $table->string('mau_tieu_de_chinh_2');
            $table->string('tieu_de_phu_2');
            
            $table->string('slogan_chinh');
            $table->string('slogan_phu');

            $table->string('tieu_de_gioi_thieu_san_pham');
            $table->string('anh_chinh_gioi_thieu_san_pham');
            $table->string('anh_phu_gioi_thieu_san_pham');

            $table->string('tieu_de_chinh_xu_huong');
            $table->string('tieu_de_phu_xu_huong');

            $table->string('anh_danh_muc_1');
            $table->string('tieu_de_danh_muc_1');
            $table->string('anh_danh_muc_2');
            $table->string('tieu_de_danh_muc_2');
            $table->string('anh_danh_muc_3');
            $table->string('tieu_de_danh_muc_3');

            $table->string('tieu_de_khuyen_mai_chinh');
            $table->string('tieu_de_khuyen_mai_phu');

            $table->string('tieu_de_san_pham_moi_chinh');
            $table->string('tieu_de_san_pham_moi_phu');

            $table->string('anh_bieu_ngu_phu');
            $table->string('tieu_de_chinh_bieu_ngu_phu');
            $table->string('mau_tieu_de_chinh_bieu_ngu_phu');
            $table->string('tieu_de_phu_bieu_ngu_phu');
            $table->text('mo_ta_bieu_ngu_phu');

            $table->string('tieu_de_san_pham_sap_ve');
            $table->string('tieu_de_phu_san_pham_sap_ve');

            $table->string('tieu_de_thanh_vien');
            $table->string('tieu_de_phu_thanh_vien');
            $table->string('anh_loi_ich_thanh_vien_1');
            $table->string('tieu_de_loi_ich_thanh_vien_1');
            $table->string('noi_dung_nut_1');
            $table->string('anh_loi_ich_thanh_vien_2');
            $table->string('tieu_de_loi_ich_thanh_vien_2');
            $table->string('noi_dung_nut_2');
            $table->string('anh_loi_ich_thanh_vien_3');
            $table->string('tieu_de_loi_ich_thanh_vien_3');
            $table->string('noi_dung_nut_3');
            
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('landing_page');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUuDaiToDonHang extends Migration
{
    public function up()
    {
        Schema::table('don_hang', function (Blueprint $table) {
            $table->integer('uu_dai')->nullable()->after('trang_thai');
        });
    }

    public function down()
    {
        Schema::table('don_hang', function (Blueprint $table) {
            $table->dropColumn('uu_dai');
        });
    }
}

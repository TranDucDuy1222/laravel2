<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameSizeToIdSizeInChiTietDonHangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chi_tiet_don_hang', function (Blueprint $table) {
            $table->renameColumn('size', 'id_size');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chi_tiet_don_hang', function (Blueprint $table) {
            $table->renameColumn('id_size', 'size');
        });
    }
}

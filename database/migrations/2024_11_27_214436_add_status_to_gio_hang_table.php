<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToGioHangTable extends Migration
{
    public function up()
    {
        Schema::table('gio_hang', function (Blueprint $table) {
            $table->integer('status')->after('so_luong')->default(0); 
        });
    }
    public function down()
    {
        Schema::table('gio_hang', function (Blueprint $table) {
            $table->dropColumn('status'); 
        });
    }
}

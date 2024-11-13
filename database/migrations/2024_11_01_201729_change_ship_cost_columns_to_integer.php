<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeShipCostColumnsToInteger extends Migration
{
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            // Chuyển đổi cột về dạng số nguyên
            $table->integer('ship_cost_inner_city')->change();
            $table->integer('ship_cost_nationwide')->change();
        });
    }

    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            // Phục hồi lại cột về dạng số thập phân
            $table->decimal('ship_cost_inner_city', 8, 2)->change();
            $table->decimal('ship_cost_nationwide', 8, 2)->change();
        });
    }
}

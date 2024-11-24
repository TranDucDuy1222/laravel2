<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFacebookToSettingsTable extends Migration
{
    
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('facebook')->nullable()->after('phone');
        });
    }

    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('facebook');
        });
    }
}

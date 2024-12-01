<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameOldTableToNewTable extends Migration
{
    public function up()
    {
        Schema::rename('landing_page', 'home_layout');
    }
    public function down()
    {
        Schema::rename('home_layout', 'landing_page');
    }
}


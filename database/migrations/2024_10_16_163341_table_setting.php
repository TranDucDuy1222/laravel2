<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo_light')->nullable();
            $table->string('logo_dark')->nullable();
            $table->string('logo_icon')->nullable();
            $table->string('site_name')->nullable();
            $table->string('support_email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->decimal('ship_cost_inner_city', 8, 2)->nullable();
            $table->decimal('ship_cost_nationwide', 8, 2)->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('settings');
    }
    
};

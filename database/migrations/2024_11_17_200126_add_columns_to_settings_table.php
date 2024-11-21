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
        Schema::table('settings', function (Blueprint $table) { 
            $table->string('banner_dung_sale')->nullable(); 
            $table->string('banner_dung_cms')->nullable(); 
            $table->string('logo_sale')->nullable(); 
            $table->string('logo_cms')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('banner_dung_sale'); 
            $table->dropColumn('banner_dung_cms'); 
            $table->dropColumn('logo_sale'); 
            $table->dropColumn('logo_cms');
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('gio_hang', function (Blueprint $table) { 
            $table->boolean('an_hien')->default(0)->after('status'); 
        });    
    }
    public function down(): void
    {
        Schema::table('gio_hang', function (Blueprint $table) {
            $table->dropColumn('an_hien');
        });
    }
};

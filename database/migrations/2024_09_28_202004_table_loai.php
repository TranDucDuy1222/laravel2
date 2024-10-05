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
        Schema::create('loai', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ten_loai', 100);
            $table->string('slug', 100)->nullable();
            $table->integer('thu_tu')->default(0);
            $table->boolean('an_hien')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loai');
    }
};

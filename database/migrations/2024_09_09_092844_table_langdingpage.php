<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('langdingpage', function (Blueprint $table) {
            $table->id();
            $table->string('content_header', 255);
            $table->text('imgheader');
            $table->string('content_1', 255);
            $table->string('content_2', 255);
            $table->string('content_3', 255);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('langdingpage');
    }
};

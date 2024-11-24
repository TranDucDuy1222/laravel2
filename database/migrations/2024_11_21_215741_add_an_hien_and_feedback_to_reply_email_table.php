<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAnHienAndFeedbackToReplyEmailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reply_email', function (Blueprint $table) {
            $table->boolean('an_hien')->default(true)->after('noi_dung'); // Thêm cột an_hien sau cột noi_dung
            $table->text('feedback')->nullable()->after('an_hien'); // Thêm cột feedback sau cột an_hien
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reply_email', function (Blueprint $table) {
            $table->dropColumn('an_hien');
            $table->dropColumn('feedback');
        });
    }
}

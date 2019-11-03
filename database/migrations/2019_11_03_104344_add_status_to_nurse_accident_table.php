<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToNurseAccidentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nurse_accident_response', function (Blueprint $table) {
            $table->enum('status',['incomplete','complete'])->default('incomplete');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nurse_accident_response', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFirstAidNurseResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('first_aid_nurse_responses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('patient')->nullable();
            $table->string('nurse')->nullable();
            $table->string('doctor')->nullable();
            $table->enum('status',['initiated','complete'])->default('initiated');
            $table->text('comments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('first_aid_nurse_responses');
    }
}

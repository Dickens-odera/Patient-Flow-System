<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNurseMatrenityResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nurse_maternity_responses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('patient');
            $table->string('nurse');
            $table->string('doctor');
            $table->enum('status',['initiated','complete'])->default('initiated');
            $table->text('comments');
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
        Schema::dropIfExists('nurse_matrenity_responses');
    }
}

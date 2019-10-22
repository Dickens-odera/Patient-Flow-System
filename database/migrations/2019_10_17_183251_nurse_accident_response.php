<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NurseAccidentResponse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nurse_accident_response', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('patient')->nullable();
            $table->string('nurse')->nullable();
            $table->string('doctor')->nullable();
            $table->text('comments')->nullable();
            $table->enum('accident_type',['burns','car','mortorcycle','other'])->default('other');
            $table->enum('damage_type',['savere','other'])->default('other');
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
        Schema::dropIfExists('nurse_accident_response');
    }
}

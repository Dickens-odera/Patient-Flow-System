<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('patient');
            $table->string('doctor')->nullable();
            $table->string('nurse')->nullable();
            $table->string('department')->nullable();
            $table->text('comment')->nullable();
            $table->date('date')->nullable();
            $table->string('time')->nullable();
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
        Schema::dropIfExists('patient_bookings');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmergenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emergencies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('patient_name');
            $table->enum('type',['accident','maternity','first_aid'])->default('first_aid');
            $table->enum('status',['pending','complete'])->default('pending');
            $table->string('location')->nullable();
            $table->string('address')->nullable();
            $table->string('street')->nullable();
            $table->string('phone')->nullable();
            $table->string('gender')->nullable();
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
        Schema::dropIfExists('emergencies');
    }
}

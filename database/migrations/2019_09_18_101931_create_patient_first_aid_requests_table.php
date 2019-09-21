<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientFirstAidRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('first_aid_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('patient')->nullable();
            $table->string('location')->nullable();
            $table->string('street')->nullable();
            $table->text('description')->nullable();
            $table->enum('status',['pending','complete'])->default('pending');
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
        Schema::dropIfExists('first_aid_requests');
    }
}

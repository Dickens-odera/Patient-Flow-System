<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaternityRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maternity_request', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('patient')->nullable();
            $table->string('location')->nullble();
            $table->string('street')->nullbale();
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
        Schema::dropIfExists('maternity_request');
    }
}

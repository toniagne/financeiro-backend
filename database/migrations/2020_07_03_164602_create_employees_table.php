<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{

    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('cpf');
            $table->string('email');
            $table->boolean('blocked');
            $table->unsignedInteger('occupattion_id');

            $table->foreign('occupattion_id')->references('id')->on('occupations')->onDelete('cascade');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('employees');
    }
}

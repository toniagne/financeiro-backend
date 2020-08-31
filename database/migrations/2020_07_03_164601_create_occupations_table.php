<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOccupationsTable extends Migration
{

    public function up()
    {
        Schema::create('occupations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });
    }


    public function down()
    {
        Schema::dropIfExists('occupations');
    }
}

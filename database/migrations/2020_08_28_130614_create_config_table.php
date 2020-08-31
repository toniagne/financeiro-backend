<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigTable extends Migration
{

    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('value');

            $table->softDeletes();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('config');
    }
}

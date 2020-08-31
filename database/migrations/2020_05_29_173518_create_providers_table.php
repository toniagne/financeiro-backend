<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvidersTable extends Migration
{

    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['PF', 'PJ']);
            $table->string('function', 191)->nullable();
            $table->string('description', 191)->nullable();
            $table->boolean('active')->default(1);

            $table->softDeletes();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('providers');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRecurrencesTable extends Migration
{

    public function up()
    {
        Schema::create('recurrences', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 191)->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('recurrences');
    }
}

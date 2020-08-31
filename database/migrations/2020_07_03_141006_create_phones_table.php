<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhonesTable extends Migration
{

    public function up()
    {
        Schema::create('phones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->morphs('phonable');
            $table->mediumText('phone');
            $table->mediumText('contact');
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('phones');
    }
}

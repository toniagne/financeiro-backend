<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{

    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->morphs('addressable');
            $table->mediumText('address');
            $table->integer('city_id');
            $table->string('number');
            $table->string('neighborhood');
            $table->string('complement');
            $table->string('category');
            $table->string('zipcode');
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductDetailsTable extends Migration
{

    public function up()
    {
        Schema::create('product_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->morphs('productable');
            $table->mediumText('key');
            $table->mediumText('value');

            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('product_details');
    }
}

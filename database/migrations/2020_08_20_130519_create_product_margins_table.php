<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductMarginsTable extends Migration
{

    public function up()
    {
        Schema::create('product_margins', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('name');
            $table->decimal('dolar_value');
            $table->decimal('fixed_margin');
            $table->integer('margin');
            $table->integer('custom_margin');

            $table->softDeletes();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('product_margins');
    }
}

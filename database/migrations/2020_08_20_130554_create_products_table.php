<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{

    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('product_category_id');
            $table->unsignedInteger('product_margin_id')->nullable();
            $table->mediumText('name');
            $table->decimal('value');
            $table->text('observation')->nullable();
            $table->boolean('status');

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('product_category_id')->references('id')->on('product_categories');
            $table->foreign('product_margin_id')->references('id')->on('product_margins');
        });
    }


    public function down()
    {
        Schema::dropIfExists('products');
    }
}

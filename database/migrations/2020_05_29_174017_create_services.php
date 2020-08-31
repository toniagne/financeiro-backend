<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServices extends Migration
{

    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('service_type_id');
            $table->unsignedInteger('service_category_id');
            $table->string('name', 191);
            $table->decimal('price', 10,2)->nullable();
            $table->string('observation', 500);

            $table->foreign('service_type_id')->references('id')->on('service_types')->onDelete('cascade');
            $table->foreign('service_category_id')->references('id')->on('service_categories')->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('services');
    }
}

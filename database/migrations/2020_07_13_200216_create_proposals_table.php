<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProposalsTable extends Migration
{

    public function up()
    {
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('client_id');
            $table->bigInteger('category_id');
            $table->date('validity');
            $table->string('pdf')->nullable();
            $table->decimal('value');
            $table->enum('situation', ['created', 'unsuccessful', 'canceled']);

            $table->softDeletes();
            $table->timestamps();

            /*
            $table->foreign('clients_id')->references('id')->on('clients');
            $table->foreign('category_id')->references('id')->on('categories');
            */

        });
    }


    public function down()
    {
        Schema::dropIfExists('proposals');
    }
}

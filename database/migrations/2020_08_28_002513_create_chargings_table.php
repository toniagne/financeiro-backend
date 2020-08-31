<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChargingsTable extends Migration
{

    public function up()
    {
        Schema::create('chargings', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('client_id');
            $table->unsignedInteger('bill_entry_id');
            $table->unsignedInteger('user_id');

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('bill_entry_id')->references('id')->on('bill_entries');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }


    public function down()
    {
        Schema::dropIfExists('chargings');
    }
}

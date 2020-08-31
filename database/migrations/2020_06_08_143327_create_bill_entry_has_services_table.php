<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillEntryHasServicesTable extends Migration
{

    public function up()
    {
        Schema::create('bill_entry_has_services', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('bill_entry_id');
            $table->unsignedInteger('service_id');

            $table->foreign('bill_entry_id')->references('id')->on('bill_entries')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');

            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('bill_entry_has_services');
    }
}

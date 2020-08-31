<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsDetailsTable extends Migration
{

    public function up()
    {
        Schema::create('bills_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('service_id');
            $table->unsignedInteger('day');
            $table->enum('weekly_due', ['mo', 'tu', 'we', 'th', 'fr']);
            $table->unsignedInteger('first_bi_weekly_due');
            $table->unsignedInteger('second_bi_weekly_due');
            $table->string('yearly_due');

            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('bills_details');
    }
}

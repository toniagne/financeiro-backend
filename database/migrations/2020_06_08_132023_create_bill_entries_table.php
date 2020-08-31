<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillEntriesTable extends Migration
{

    public function up()
    {
        Schema::create('bill_entries', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('bill_id');
            $table->date('due');
            $table->decimal('amount', 15,2);
            $table->string('description', 255);
            $table->enum('status', ['payed', 'pendent', 'parcial', 'overdue']);

            $table->foreign('bill_id')->references('id')->on('bills')->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('bill_entries');
    }
}

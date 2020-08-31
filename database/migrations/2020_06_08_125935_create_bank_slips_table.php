<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankSlipsTable extends Migration
{

    public function up()
    {
        Schema::create('bank_slips', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order', 10);
            $table->string('number', 10);
            $table->string('digitable', 255);
            $table->date('due');
            $table->decimal('amount', 15,2);
            $table->decimal('interest', 15,2);
            $table->decimal('mulct', 15,2);
            $table->decimal('discount', 15,2);
            $table->string('link', 255);
            $table->string('demonstrative', 500);
            $table->enum('status', ['pendent', 'overdue', 'payed', 'manually', 'canceled']);


            $table->softDeletes();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('bank_slips');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{

    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('client_id');
            $table->integer('payment_category_id');
            $table->integer('recurrence_id');
            $table->integer('negociation_type_id');
            $table->decimal('amount');
            $table->text('description');
            $table->date('due');
            $table->date('issue');
            $table->enum('category', ['pay', 'receive']);

            /*
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('payment_category_id')->references('id')->on('payment_categories');
            $table->foreign('recurrence_id')->references('id')->on('recurrences');
            $table->foreign('negociation_type_id')->references('id')->on('negociation_types');
             */

            $table->softDeletes();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('bills');
    }
}

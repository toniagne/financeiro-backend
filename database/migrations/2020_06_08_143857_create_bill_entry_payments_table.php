<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillEntryPaymentsTable extends Migration
{

    public function up()
    {
        Schema::create('bill_entry_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('bill_entry_id');
            $table->unsignedInteger('bank_slip_id');
            $table->date('date');
            $table->decimal('amount', 15,2);
            $table->string('description', 255);

            $table->foreign('bill_entry_id')->references('id')->on('bill_entries')->onDelete('cascade');
            $table->foreign('bank_slip_id')->references('id')->on('bank_slips')->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('bill_entry_payments');
    }
}

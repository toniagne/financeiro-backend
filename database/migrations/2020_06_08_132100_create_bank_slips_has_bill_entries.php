<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankSlipsHasBillEntries extends Migration
{

    public function up()
    {
        Schema::create('bank_slips_has_bill_entries', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('bank_slip_id');
            $table->unsignedInteger('bill_entry_id');

            $table->foreign('bank_slip_id')->references('id')->on('bank_slips')->onDelete('cascade');
            $table->foreign('bill_entry_id')->references('id')->on('bill_entries')->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('bank_slips_has_bill_entries');
    }
}

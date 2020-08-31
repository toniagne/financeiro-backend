<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{

    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('employee_id')->nullable();
            $table->bigInteger('provider_id')->nullable();
            $table->text('observation');
            $table->boolean('active');
            $table->date('date_start');
            $table->date('date_end');
            $table->boolean('permanent');
            $table->enum('type', ['employee', 'provider']);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contracts');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{

    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->bigInteger('user_id');
            $table->string('clients', 10)->default('0.0.0.0');
            $table->string('providers', 10)->default('0.0.0.0');
            $table->string('services', 10)->default('0.0.0.0');
            $table->string('proposals', 10)->default('0.0.0.0');
            $table->string('banck_slips', 10)->default('0.0.0.0');
            $table->string('fiscal_notes', 10)->default('0.0.0.0');
            $table->string('bills_to_pay', 10)->default('0.0.0.0');
            $table->string('bills_to_receive', 10)->default('0.0.0.0');
            $table->string('contracts', 10)->default('0.0.0.0');
            $table->string('configs', 10)->default('0.0.0.0');
            $table->string('employees', 10)->default('0.0.0.0');


            $table->softDeletes();
            $table->timestamps();

        });
    }


    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}

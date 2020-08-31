<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class EnableForeingKeyChecks extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }

}

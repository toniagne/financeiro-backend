<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRecurrenceIdServiceTable extends Migration
{

    public function up()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->integer('recurrence_id')->nullable()->after('service_category_id');
        });

    }


    public function down()
    {
        Schema::dropIfExists('recurrence_id');
    }
}

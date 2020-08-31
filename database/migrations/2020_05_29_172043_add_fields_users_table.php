<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsUsersTable extends Migration
{

    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('cpf', 191)->after('name')->nullable();
            $table->string('phone', 191)->after('cpf')->nullable();
            $table->boolean('blocked')->after('phone')->default(1);
        });
    }


    public function down()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->dropColumn('cpf');
            $table->dropColumn('phone');
            $table->dropColumn('blocked');
        });
    }
}

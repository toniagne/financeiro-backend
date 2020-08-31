<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFantasyContactCpfCnpjClientsTable extends Migration
{

    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->bigInteger('cnpj')->nullable()->after('type');
            $table->bigInteger('cpf')->nullable()->after('cnpj');
            $table->string('name', 45)->after('cpf');
            $table->string('fantasy', 60)->after('name');
            $table->string('contact', 60)->after('fantasy');
            $table->bigInteger('ie')->nullable()->after('cnpj');
            $table->bigInteger('im')->nullable()->after('ie');
        });
    }


    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn('cnpj');
            $table->dropColumn('cpf');
            $table->dropColumn('name');
            $table->dropColumn('fantasy');
            $table->dropColumn('contact');
            $table->dropColumn('ie');
            $table->dropColumn('im');
        });
    }
}

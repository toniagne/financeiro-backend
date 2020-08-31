<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSeveralFieldsEmployeesTable extends Migration
{

    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->string('cnpj')->nullable()->after('blocked');
            $table->bigInteger('contract_type')->after('cnpj');
            $table->text('gratuation_details')->nullable()->after('contract_type');
            $table->string('img_address')->nullable()->after('gratuation_details');
            $table->string('img_document')->nullable()->after('img_address');
            $table->string('img_graduation')->nullable()->after('img_document');
            $table->string('img_profile')->nullable()->after('img_graduation');
            $table->text('observation')->nullable()->after('img_profile');
            $table->bigInteger('pay_day')->after('observation');
            $table->enum('pay_type',['outsourced', 'fixed'])->after('pay_day');
            $table->decimal('salary')->after('pay_type');
            $table->boolean('status')->after('salary');
            $table->enum('workflow', ['homeoffice', 'fullstack'])->after('status');
        });
    }


    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn('cnpj');
            $table->dropColumn('contract_type');
            $table->dropColumn('gratuation_details');
            $table->dropColumn('img_address');
            $table->dropColumn('img_document');
            $table->dropColumn('img_graduation');
            $table->dropColumn('img_profile');
            $table->dropColumn('observation');
            $table->dropColumn('pay_day');
            $table->dropColumn('pay_type');
            $table->dropColumn('salary');
            $table->dropColumn('status');
            $table->dropColumn('workflow');
        });
    }
}

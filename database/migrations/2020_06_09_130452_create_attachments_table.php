<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttachmentsTable extends Migration
{


    public function up()
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('publication_id');
            $table->string('name');
            $table->integer('size');
            $table->string('mime');
            $table->string('path');
            $table->boolean('parsed');

            $table->softDeletes();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('attachments');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SYSTM.MSG_QUEUE', function (Blueprint $table) {
            $table->bigIncrements('QUEUE_ID');
            $table->dateTime('DATE_QUEUE');
            $table->integer('QUEUE_SEQ')->nullable();
            $table->tinyInteger('QUEUE_SUB_SEQ')->nullable();
            $table->string('MSG_MODULE',1);
            $table->string('MSG_TYPE',1);
            $table->string('MSG_PRIORITY',1)->nullable();
            $table->string('CUST_EMAIL')->nullable();
            $table->string('CUST_PHONE_NO',20)->nullable();
            $table->string('MSG_PURPOSE',50)->nullable();
            $table->string('MSG_EMAIL_SUBJECT',200)->nullable();
            $table->string('MSG_TEXT',2000);
            $table->string('MSG_STATUS',2);
            $table->dateTime('DATE_LAST_SENT')->nullable();
            $table->dateTime('DATE_REQUEUE')->nullable();
            $table->string('MSG_FAILURE',500)->nullable();
            $table->integer('CIF_NO')->nullable();
            $table->string('GENERIC_KEY',20)->nullable();
            $table->string('CUST_NAME',255)->nullable();
            $table->string('CUST_ID_NO',20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('SYSTM.MSG_QUEUE');
    }
}

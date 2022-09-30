<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('FMS.Account_Guarantor', function (Blueprint $table) {
            $table->id();

            $table->string('mbr_no')->nullable();
            $table->bigInteger('cust_id');
            $table->bigInteger('coop_id');

            $table->bigInteger('account_id')->nullable();
            $table->string('account_no')->nullable();
            $table->string('guarantor_no',3)->default('1');
            $table->string('status',1)->default('1');

            $table->timestamp('created_at')->useCurrent();
            $table->string('created_by')->nullable()->default('SYSTEM');
            $table->timestamp('deleted_at')->nullable();
            $table->string('deleted_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('FMS.Account_Guarantor');
    }
};

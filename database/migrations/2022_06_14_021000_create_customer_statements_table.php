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
        Schema::create('CIF.customer_statements', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cust_id')->nullable();
            $table->bigInteger('coop_id')->nullable();
            $table->string('mbr_no')->nullable();

            $table->string('trn_code')->nullable();
            $table->string('bank_code')->nullable();
            $table->string('gl_code')->nullable();

            $table->unsignedDecimal('amount',8,2)->nullable();
            $table->unsignedDecimal('total_amt',8,2)->nullable();
            $table->string('remarks')->nullable();

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
        Schema::dropIfExists('CIF.customer_statements');
    }
};

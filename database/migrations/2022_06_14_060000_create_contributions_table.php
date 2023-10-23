<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('siskop.contribution', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->default(DB::raw('newid()'));

            $table->bigInteger('client_id');
            $table->bigInteger('cust_id');

            $table->string('direction',10)->default('buy');
            $table->string('method')->default('online');
            $table->unsignedDecimal('amt_before',8,2);
            $table->unsignedDecimal('apply_amt',8,2);
            $table->unsignedDecimal('approved_amt',8,2)->nullable();
            $table->date('start_apply')->nullable();
            $table->date('start_approved')->nullable();

            $table->string('flag',2)->default('0');
            $table->string('step',2)->default('0');

            $table->string('bank_code')->nullable();
            $table->string('bank_account')->nullable();
            $table->string('cheque_no')->nullable();
            $table->date('cheque_date')->nullable();
            $table->date('cheque_clear')->nullable();
            $table->date('cdm_date')->nullable();
            $table->date('online_date')->nullable();

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
        Schema::dropIfExists('siskop.contribution');
    }
};

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
        Schema::create('FMS.Account_Disbursement_Deductions', function (Blueprint $table) {
            $table->id();

            $table->string('mbr_no')->nullable();
            $table->bigInteger('account_id');
            $table->string('account_no');
            $table->tinyInteger('overlap_id')->default('1');
            $table->string('overlap_type',1)->default('I');

            $table->string('institute_name')->default('Internal');
            $table->string('institute_num');
            $table->date('expiry_date')->nullable();
            $table->decimal('monthly_pymt',16,2)->default(0);
            $table->decimal('settlement_amt',16,2)->default(0);
            $table->decimal('principal_amt',16,2)->default(0);
            $table->decimal('profit_amt',16,2)->default(0);
            $table->decimal('rebate_amt',16,2)->default(0);

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
        Schema::dropIfExists('FMS.Account_Positions');
    }
};

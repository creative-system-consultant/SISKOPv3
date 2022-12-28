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

            $table->decimal('contribution',16,2)->default(0);
            $table->decimal('duty_stamp',16,2)->default(0);
            $table->decimal('process_fee',16,2)->default(0);
            $table->decimal('insurance',16,2)->default(0);
            $table->decimal('advance_payment',16,2)->default(0);
            $table->decimal('total_overlap',16,2)->default(0);
            $table->decimal('total_deduction',16,2)->default(0);
            $table->decimal('balance',16,2)->default(0);

            $table->timestamp('created_at')->useCurrent();
            $table->string('created_by')->nullable()->default('SYSTEM');
            $table->timestamp('deleted_at')->nullable();
            $table->string('deleted_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('updated_by')->nullable();
        });

        DB::statement("DBCC CHECKIDENT ('FMS.Account_Disbursement_Deductions',RESEED,101)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('FMS.Account_Disbursement_Deductions');
    }
};

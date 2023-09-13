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
        Schema::create('FMS.Account_Masters', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->default(DB::raw('newid()'));

            $table->string('mbr_no')->nullable();
            $table->bigInteger('agent_id')->nullable();
            $table->bigInteger('officer_id')->nullable();
            $table->bigInteger('cust_id');
            $table->bigInteger('coop_id');

            $table->string('account_no')->nullable();
            $table->string('product_id');
            $table->bigInteger('account_status')->default('15');

            $table->decimal('apply_step',2,0)->default('0');

            $table->decimal('purchase_price',16,2)->default(0);
            $table->decimal('selling_price',16,2)->nullable();
            $table->decimal('approved_limit',16,2)->nullable();

            $table->decimal('profit_rate',8,4)->default(0);
            $table->decimal('instal_amount',18,4)->nullable();
            $table->decimal('instal_SI',18,4)->nullable();
            $table->decimal('instal_Autopay',18,4)->nullable();
            $table->decimal('total_instal_amount',18,4)->nullable();
            $table->decimal('duration',3,0)->default('12');
            $table->decimal('approved_duration',2,0)->default('1');

            $table->string('cancel_tag')->nullable();
            $table->string('cancel_desc')->nullable();
            $table->timestamp('cancel_at')->nullable();
            $table->string('cancel_by')->nullable();

            $table->biginteger('referer_id')->nullable();
            $table->decimal('referer_pay',16,2)->nullable();
            $table->decimal('referer_pay_percent',5,2)->nullable();

            $table->string('last_action',10)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->string('created_by')->nullable()->default('SYSTEM');
            $table->timestamp('deleted_at')->nullable();
            $table->string('deleted_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('updated_by')->nullable();
        });

        DB::statement("DBCC CHECKIDENT ('FMS.Account_Masters',RESEED,101)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('FMS.Account_Masters');
    }
};

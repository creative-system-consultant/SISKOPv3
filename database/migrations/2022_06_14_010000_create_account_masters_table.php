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
        Schema::create('FMS.Account_Masters', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->default(DB::raw('newid()'));

            $table->string('mbr_no');
            $table->bigInteger('agent_id')->nullable();
            $table->bigInteger('cust_id');
            $table->bigInteger('coop_id');

            $table->string('account_no');
            $table->string('product_id');

            $table->decimal('purchase_price',16,2);
            $table->decimal('selling_price',16,2);
            $table->decimal('approved_limit',16,2);

            $table->decimal('profit_rate',4,4);
            $table->decimal('instal_amount',16,4);

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
        Schema::dropIfExists('FMS.Account_Masters');
    }
};

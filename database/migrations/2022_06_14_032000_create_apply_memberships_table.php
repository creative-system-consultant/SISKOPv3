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
        Schema::create('SISKOP.APPLY_MEMBERSHIP', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->default(DB::raw('newid()'));

            $table->string('mbr_no')->nullable();
            $table->bigInteger('agent_id')->nullable();
            $table->bigInteger('cust_id');
            $table->bigInteger('coop_id');
            $table->bigInteger('flag')->default(0);
            $table->bigInteger('step')->default(1);

            $table->decimal('total_fee',12,2)->nullable();
            $table->decimal('register_fee',12,2)->nullable();
            $table->decimal('share_fee',12,2)->nullable();
            $table->decimal('contribution_fee',12,2)->nullable();
            $table->decimal('share_monthly',12,2)->nullable();
            $table->decimal('contribution_monthly',12,2)->nullable();

            $table->timestamp('created_at')->useCurrent();
            $table->string('created_by')->nullable()->default('SYSTEM');
            $table->timestamp('deleted_at')->nullable();
            $table->string('deleted_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('updated_by')->nullable();
        });

        DB::statement("DBCC CHECKIDENT ('SISKOP.APPLY_MEMBERSHIP',RESEED,101)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('SISKOP.APPLY_MEMBERSHIP');
    }
};

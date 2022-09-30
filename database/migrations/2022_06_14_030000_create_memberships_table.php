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
        Schema::create('SISKOP.MEMBERSHIP', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->default(DB::raw('newid()'));

            $table->string('mbr_no')->nullable();
            $table->bigInteger('agent_id')->nullable();
            $table->bigInteger('cust_id');
            $table->bigInteger('coop_id');
            $table->bigInteger('flag')->default(0);
            $table->bigInteger('step')->default(1);

            $table->bigInteger('introducer_id')->nullable();
            $table->string('introducer_mbr_no')->nullable();

            $table->timestamp('created_at')->useCurrent();
            $table->string('created_by')->nullable()->default('SYSTEM');
            $table->timestamp('deleted_at')->nullable();
            $table->string('deleted_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('updated_by')->nullable();
        });

        DB::statement("DBCC CHECKIDENT ('SISKOP.MEMBERSHIP',RESEED,100)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('SISKOP.MEMBERSHIP');
    }
};

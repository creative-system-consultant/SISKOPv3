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
        Schema::create('SISKOP.special_aids', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->default(DB::raw('newid()'));

            $table->string('name');
            $table->bigInteger('coop_id');

            $table->string('apply_amt_enable',1)->default('1');
            $table->unsignedDecimal('default_apply_amt',8,2)->nullable();
            $table->unsignedDecimal('min_apply_amt',8,2)->nullable();
            $table->unsignedDecimal('max_apply_amt',8,2)->nullable();

            $table->string('status',1)->default('0');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

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
        Schema::dropIfExists('SISKOP.special_aids');
    }
};

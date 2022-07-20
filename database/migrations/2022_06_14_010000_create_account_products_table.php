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
        Schema::create('SISKOP.Account_Products', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->default(DB::raw('newid()'));

            $table->string('name');
            $table->bigInteger('coop_id');
            $table->decimal('profit_rate',4,4);
            $table->decimal('amt_default',8,2);
            $table->decimal('amt_min',8,2)->nullable();
            $table->decimal('amt_max',8,2)->nullable();
            $table->smallInteger('term_default');
            $table->smallInteger('term_min')->nullable();
            $table->smallInteger('term_max')->nullable();
            $table->decimal('min_share',8,2)->nullable();
            $table->decimal('max_share',8,2)->nullable();

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

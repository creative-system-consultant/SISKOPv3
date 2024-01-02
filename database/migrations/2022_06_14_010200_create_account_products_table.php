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
        Schema::create('SISKOP.Account_Products', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->default(DB::raw('newid()'));

            $table->string('name');
            $table->bigInteger('client_id');
            $table->bigInteger('fin_type')->default('1');
            $table->bigInteger('product_type');
            $table->smallInteger('apply_limit')->default('1');
            $table->smallInteger('apply_lifetime')->nullable();
            $table->decimal('amt_default',10,2)->nullable();
            $table->decimal('amt_min',10,2)->nullable();
            $table->decimal('amt_max',10,2)->nullable();
            $table->smallInteger('term_default')->nullable()->default('1');
            $table->smallInteger('term_min')->nullable()->default('1');
            $table->smallInteger('term_max')->nullable()->default('10');
            $table->decimal('profit_rate',8,4);
            $table->string('profit_rate_type')->nullable();
            $table->decimal('share_min',10,2)->nullable();
            $table->decimal('share_max',10,2)->nullable();

            $table->timestamp('created_at')->useCurrent();
            $table->string('created_by')->nullable()->default('SYSTEM');
            $table->timestamp('deleted_at')->nullable();
            $table->string('deleted_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('updated_by')->nullable();
        });

        DB::statement("DBCC CHECKIDENT ('SISKOP.Account_Products',RESEED,101)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('SISKOP.Account_Products');
    }
};

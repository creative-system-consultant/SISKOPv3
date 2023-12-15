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
        Schema::create('CIF.CUSTOMERS_EMPLOYMENT', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->default(DB::raw('newid()'));
            $table->bigInteger('cif_id');

            $table->string('name')->nullable();
            $table->string('department')->nullable();
            $table->string('position')->nullable();
            $table->string('office_num')->nullable();
            $table->decimal('salary',8,2)->nullable();
            $table->string('worker_num')->nullable();
            $table->date('work_start')->nullable();
            $table->tinyInteger('work_period')->nullable();
            $table->string('salary_ref')->nullable();
            $table->bigInteger('position_id')->nullable();
            $table->bigInteger('income_group_id')->nullable();
            $table->integer('job_group_id')->nullable();
            $table->integer('job_status_id')->nullable();
            $table->integer('department_id')->nullable();

            $table->timestamp('created_at')->useCurrent();
            $table->string('created_by')->nullable()->default('1');
            $table->timestamp('deleted_at')->nullable();
            $table->string('deleted_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('updated_by')->nullable();
        });

        DB::statement("DBCC CHECKIDENT ('CIF.CUSTOMERS_EMPLOYMENT',RESEED,101)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('CIF.CUSTOMERS_EMPLOYMENT');
    }
};

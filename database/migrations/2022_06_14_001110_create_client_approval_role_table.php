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
        Schema::create('siskop.client_approval_role', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('client_id');
            $table->bigInteger('role_id');
            $table->bigInteger('approval_id');
            $table->bigInteger('product_id')->nullable();
            $table->bigInteger('amount_id')->nullable();
            $table->string('product_range',100)->nullable();

            $table->string('name',50)->nullable();
            $table->decimal('min',10,2)->nullable()->default('0');
            $table->decimal('max',10,2)->nullable()->default('0');
            $table->integer('order')->default('1');
            $table->string('status',1)->default('1');
            $table->string('rules')->default('[]');

            $table->timestamp('created_at')->useCurrent();
            $table->string('created_by')->nullable()->default('SYSTEM');
            $table->timestamp('deleted_at')->nullable();
            $table->string('deleted_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('updated_by')->nullable();
        });

        DB::statement("DBCC CHECKIDENT ('SISKOP.client_approval_role',RESEED,101)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siskop.client_approval_role');
    }
};

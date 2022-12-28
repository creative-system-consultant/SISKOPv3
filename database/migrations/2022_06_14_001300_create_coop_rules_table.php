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
        Schema::create('SISKOP.Coop_Rules', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->default(DB::raw('newid()'));

            $table->string('ruleable_name',100)->nullable();
            $table->string('ruleable_type')->nullable();
            $table->bigInteger('ruleable_id')->nullable();

            $table->string('name')->nullable();
            $table->string('rule')->nullable();
            $table->string('type')->nullable();
            $table->string('value',50)->nullable();
            $table->string('category')->nullable();
            $table->string('group')->nullable();

            $table->timestamp('created_at')->useCurrent();
            $table->string('created_by')->nullable()->default('SYSTEM');
            $table->timestamp('deleted_at')->nullable();
            $table->string('deleted_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('updated_by')->nullable();

        });

        DB::statement("DBCC CHECKIDENT ('SISKOP.Coop',RESEED,101)");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('SISKOP.Coop');
    }
};

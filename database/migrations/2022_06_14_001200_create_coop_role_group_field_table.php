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
        Schema::create('SISKOP.COOP_ROLE_GROUP', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->default(DB::raw('newid()'));

            $table->bigInteger('coop_id')->nullable();
            $table->bigInteger('role_id')->nullable();

            $table->string('name',50);
            $table->string('description')->nullable();
            $table->string('status',1)->default('1');

            $table->timestamp('created_at')->useCurrent();
            $table->string('created_by')->nullable()->default('SYSTEM');
            $table->timestamp('deleted_at')->nullable();
            $table->string('deleted_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('updated_by')->nullable();
        });

        DB::statement("DBCC CHECKIDENT ('SISKOP.COOP_ROLE_GROUP',RESEED,101)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('SISKOP.COOP_ROLE_GROUP');
    }
};

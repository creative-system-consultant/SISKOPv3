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
        Schema::create('SISKOP.MEMBERSHIP_FIELD', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('membership_id');
            $table->bigInteger('coop_id');
            $table->bigInteger('field_id');
            $table->string('status',1)->default(0);

            $table->timestamp('created_at')->useCurrent();
            $table->string('created_by')->nullable()->default('SYSTEM');
            $table->timestamp('deleted_at')->nullable();
            $table->string('deleted_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('updated_by')->nullable();
        });

        //no need start from 100
        //DB::statement("DBCC CHECKIDENT ('SISKOP.MEMBERSHIP_FIELD',RESEED,101)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('SISKOP.MEMBERSHIP_FIELD');
    }
};

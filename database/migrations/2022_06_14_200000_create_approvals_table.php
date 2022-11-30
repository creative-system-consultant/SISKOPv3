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
        Schema::create('SISKOP.APPROVALS', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('approval_id');
            $table->string('approval_type');
            $table->integer('order')->default('1');
            $table->bigInteger('group_id')->nullable();

            $table->bigInteger('user_id')->nullable();
            $table->string('type')->nullable();
            $table->string('note')->nullable();
            $table->string('vote')->nullable();

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
        Schema::dropIfExists('SISKOP.APPROVALS');
    }
};

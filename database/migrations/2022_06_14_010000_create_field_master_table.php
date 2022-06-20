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
        Schema::create('SISKOP.SYS_FIELD_MASTER', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->default(DB::raw('newid()'));

            $table->bigint('group_id')->nullable();
            $table->string('name')->nullable();
            $table->string('name2')->nullable();
            $table->string('value')->nullable();
            $table->string('validation')->nullable();
            $table->string('size')->nullable();
            $table->string('type')->nullable();
            $table->string('pre')->nullable();
            $table->string('post')->nullable();
            $table->string('model')->nullable();

            $table->string('readonly')->default('0');
            $table->string('status')->default('1');

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
        Schema::dropIfExists('SISKOP.SYS_FIELD_MASTER');
    }
};

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
        Schema::create('SISKOP.apply_special_aid_field', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->default(DB::raw('newid()'));

            $table->morphs('fieldable');

            $table->string('name')->nullable();
            $table->string('label')->nullable();
            $table->string('status',1)->default('1');

            $table->string('type',20)->default('string');
            $table->string('string')->nullable();
            $table->unsignedDecimal('decimal',8,2)->nullable();
            $table->unsignedDecimal('decimal4',8,4)->nullable();
            $table->bigInteger('bigint')->nullable();
            $table->date('date')->nullable();
            $table->dateTime('datetime')->nullable();

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
        Schema::dropIfExists('SISKOP.apply_special_aid_field');
    }
};

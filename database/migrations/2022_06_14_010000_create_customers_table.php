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
        Schema::create('CIF.Customers', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->default(DB::raw('newid()'));
            $table->bigint('coop_id')->nullable();

            $table->string('name');
            $table->string('icno');
            $table->string('otheric');
            $table->bigint('ictype')->nullable();

            $table->date('birthdate')->nullable();
            $table->string('birthplace')->nullable();

            $table->bigint('title_id')->nullable();
            $table->bigint('gender_id')->nullable();
            $table->bigint('marital_id')->nullable();
            $table->bigint('race_id')->nullable();
            $table->bigint('language_id')->nullable();
            $table->bigint('country_id')->nullable();

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
        Schema::dropIfExists('CIF.Customers');
    }
};

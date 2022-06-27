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
            $table->bigInteger('coop_id')->nullable();

            $table->string('name');
            $table->string('icno');
            $table->string('otheric')->nullable();
            $table->bigInteger('ictype')->nullable();

            $table->date('birthdate')->nullable();
            $table->string('birthplace')->nullable();

            $table->bigInteger('title_id')->nullable();
            $table->bigInteger('gender_id')->nullable();
            $table->bigInteger('marital_id')->nullable();
            $table->bigInteger('race_id')->nullable();
            $table->bigInteger('language_id')->nullable();
            $table->bigInteger('country_id')->nullable();

            $table->timestamp('created_at')->useCurrent();
            $table->string('created_by')->nullable()->default('SYSTEM');
            $table->timestamp('deleted_at')->nullable();
            $table->string('deleted_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('updated_by')->nullable();
        });

        DB::statement("DBCC CHECKIDENT ('CIF.Customers',RESEED,100)");
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

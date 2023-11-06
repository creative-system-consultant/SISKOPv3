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
        Schema::create('CIF.Address', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->default(DB::raw('newid()'));
            $table->morphs('addressable');

            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('address3')->nullable();
            $table->string('postcode',5)->nullable();
            $table->string('town')->nullable();
            $table->unsignedSmallInteger('def_state_id')->nullable();
            $table->unsignedSmallInteger('def_country_id')->nullable();

            $table->bigInteger('type')->nullable();
            $table->string('phone_1',20)->nullable();
            $table->string('phone_2',20)->nullable();
            $table->string('fax',25)->nullable();
            $table->string('email')->nullable();
            $table->string('mailable',1)->default('1');

            $table->timestamp('created_at')->useCurrent();
            $table->string('created_by')->nullable()->default('SYSTEM');
            $table->timestamp('deleted_at')->nullable();
            $table->string('deleted_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('updated_by')->nullable();
        });

        DB::statement("DBCC CHECKIDENT ('CIF.Address',RESEED,101)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('CIF.Address');
    }
};

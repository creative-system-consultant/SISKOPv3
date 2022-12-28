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
        Schema::create('CIF.Cust_Family', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->default(DB::raw('newid()'));
            $table->bigInteger('family_id')->nullable();                // to who this family is
            $table->bigInteger('cust_id')->nullable();                  // the family data at customer
            $table->bigInteger('relationship_id');

            $table->timestamp('created_at')->useCurrent();
            $table->string('created_by')->nullable()->default('SYSTEM');
            $table->timestamp('deleted_at')->nullable();
            $table->string('deleted_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('updated_by')->nullable();
        });

        DB::statement("DBCC CHECKIDENT ('CIF.Cust_Family',RESEED,101)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('CIF.Cust_Family');
    }
};

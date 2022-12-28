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
        Schema::create('SISKOP.FILE_MASTER', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->default(DB::raw('newid()'));

            $table->morphs('fileable');

            $table->string('filename')->nullable();
            $table->string('filedesc')->nullable();
            $table->string('filetype', 15)->nullable();
            $table->string('filepath')->nullable();

            $table->timestamp('created_at')->useCurrent();
            $table->string('created_by')->nullable()->default('SYSTEM');
            $table->timestamp('deleted_at')->nullable();
            $table->string('deleted_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('updated_by')->nullable();
        });

        DB::statement("DBCC CHECKIDENT ('SISKOP.FILE_MASTER',RESEED,101)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('SISKOP.FILE_MASTER');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class PurgeMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("IF EXISTS ( SELECT * FROM sys.schemas WHERE name = N'SISKOP' ) DROP SCHEMA SISKOP");
        DB::statement("IF EXISTS ( SELECT * FROM sys.schemas WHERE name = N'FMS' ) DROP SCHEMA FMS");
        DB::statement("IF EXISTS ( SELECT * FROM sys.schemas WHERE name = N'CIF' ) DROP SCHEMA CIF");
        DB::statement("IF EXISTS ( SELECT * FROM sys.schemas WHERE name = N'REF' ) DROP SCHEMA REF");
    }
};

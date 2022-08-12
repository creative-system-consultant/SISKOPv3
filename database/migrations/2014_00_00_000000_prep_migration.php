<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class PrepMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("IF NOT EXISTS ( SELECT * FROM sys.schemas WHERE name = N'SISKOP' ) EXEC('CREATE SCHEMA [SISKOP]');");
        DB::statement("IF NOT EXISTS ( SELECT * FROM sys.schemas WHERE name = N'FMS' ) EXEC('CREATE SCHEMA [FMS]');");
        DB::statement("IF NOT EXISTS ( SELECT * FROM sys.schemas WHERE name = N'CIF' ) EXEC('CREATE SCHEMA [CIF]');");
        DB::statement("IF NOT EXISTS ( SELECT * FROM sys.schemas WHERE name = N'REF' ) EXEC('CREATE SCHEMA [REF]');");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};

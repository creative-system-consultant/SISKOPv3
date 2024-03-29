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
        DB::statement("IF NOT EXISTS ( SELECT * FROM sys.schemas WHERE name = N'SYSTM' ) EXEC('CREATE SCHEMA [SYSTM]');");
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
        DB::statement("IF EXISTS ( SELECT * FROM sys.schemas WHERE name = N'SYSTM' ) DROP SCHEMA SYSTM");
    }
};

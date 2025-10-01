<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('DROP VIEW IF EXISTS prestiti_scaduti');
        DB::statement("
            CREATE OR REPLACE VIEW prestiti_scaduti AS
            SELECT * 
            FROM prestito
            WHERE scadenza < CURDATE();
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW prestiti_scaduti');
    }
};

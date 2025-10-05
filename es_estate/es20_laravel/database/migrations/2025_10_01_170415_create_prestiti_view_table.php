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
        DB::statement('DROP VIEW IF EXISTS tutti_prestiti');
        DB::statement("
            CREATE OR REPLACE VIEW tutti_prestiti AS
            SELECT p.idp, l.titolo, l.genere, p.idu, u.name, u.email, p.inizio_prestito, p.scadenza, p.fine_prestito
            FROM prestiti p
            JOIN libri l ON l.idl = p.idl
            JOIN users u ON u.idu = p.idu
        ");

        DB::statement('DROP VIEW IF EXISTS prestiti_scaduti');
        DB::statement("
            CREATE OR REPLACE VIEW prestiti_scaduti AS
            SELECT p.idp, l.titolo, l.genere, p.idu, u.name, u.email, p.inizio_prestito, p.scadenza, p.fine_prestito
            FROM prestiti p
            JOIN libri l ON l.idl = p.idl
            JOIN users u ON u.idu = p.idu
            WHERE scadenza < CURDATE() AND fine_prestito IS NULL;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS tutti_prestiti');
        DB::statement('DROP VIEW prestiti_scaduti');
    }
};

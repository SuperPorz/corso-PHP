<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prestito', function (Blueprint $table) {
            $table->id('idp');
            $table->foreignId('libro_idl');
            $table->foreignId('users_idu');
            $table->datetime('inizio_prestito');
            $table->datetime('scadenza')->stored()
                ->virtualAs(DB::raw("DATE_ADD(inizio_prestito, INTERVAL 30 DAY)"));
            $table->datetime('fine_prestito')->nullable();
        });

        DB::statement("
            CREATE VIEW prestiti_ritardo AS
            SELECT * 
            FROM prestito
            WHERE DATEDIFF(CURDATE(), scadenza) > 0;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestito');
        DB::statement("DROP VIEW IF EXISTS prestiti_scaduti");
    }
};

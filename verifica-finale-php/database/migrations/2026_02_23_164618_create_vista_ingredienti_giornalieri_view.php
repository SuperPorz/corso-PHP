<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            CREATE VIEW vista_ingredienti_giornalieri AS
            SELECT 
                pr.data_prenotazione AS data_selezionata,
                i.nome_ingrediente AS ingrediente,
                COUNT(pr.id_prenotazione) AS quantita_totale
            FROM prenotazioni pr
            JOIN menu m 
                ON pr.data_prenotazione BETWEEN m.data_inizio AND m.data_fine
            JOIN menu_piatti mp 
                ON mp.id_menu = m.idm
            JOIN piatti p 
                ON p.idp = mp.id_piatto
            JOIN piatto_ingrediente pi 
                ON pi.id_piatto = p.idp
            JOIN ingredienti i 
                ON i.idi = pi.id_ingrediente
            GROUP BY pr.data_prenotazione, i.nome_ingrediente
        ");
    }

    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS vista_ingredienti_giornalieri");
    }
};
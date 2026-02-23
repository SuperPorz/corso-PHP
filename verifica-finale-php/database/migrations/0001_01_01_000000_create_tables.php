<?php

use Illuminate\Container\Attributes\DB;
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
        Schema::create('ingredienti', function (Blueprint $table) {
            $table->id('idi');
            $table->string('nome_ingrediente');
        });

        Schema::create('piatti', function (Blueprint $table) {
            $table->id('idp');
            $table->string('nome_piatto');
            $table->enum('tipo', ['primo', 'secondo', 'dolce']);
        });

        //ci serve una tabella di partenza dei menu
        Schema::create('menu', function (Blueprint $table) {
            $table->id('idm');
            $table->string('nome_menu');
            $table->date('data_inizio');
            $table->date('data_fine');
        });

        //questa tabella fa da ponte tra piatto e ingrediente (rel. molti-molti)
        Schema::create('piatto_ingrediente', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_ingrediente')->constrained('ingredienti', 'idi')->onDelete('cascade');
            $table->foreignId('id_piatto')->constrained('piatti', 'idp')->onDelete('cascade');
        });

        //poi ci serve una tabella PIVOT che leghi un menu ad un piatto 
        //(a cui va aggiunto il constraint di 1 solo piatto per tipo)
        Schema::create('menu_piatti', function (Blueprint $table) {
            $table->foreignId('id_menu')->constrained('menu', 'idm')->onDelete('cascade');
            $table->foreignId('id_piatto')->constrained('piatti', 'idp')->onDelete('cascade');
            $table->primary(['id_menu', 'id_piatto']);//check sull'unicità piatto-menu
            //andrebbe inserito anche il check sull'associazione menu-tipo, 
            //ma "tipo" è una colonna del piatto che non è una primary key, sistemo questo aspetto in un secondo momento
        });

        //tabella prenotazioni
        Schema::create('prenotazioni', function (Blueprint $table) {
            $table->id('id_prenotazione');
            $table->date('data_prenotazione');
            $table->string('nominativo');
            $table->unique(['data_prenotazione', 'nominativo']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredienti');
        Schema::dropIfExists('piatti');
        Schema::dropIfExists('menu');
        Schema::dropIfExists('piatto_ingrediente');
        Schema::dropIfExists('menu_piatti');
        Schema::dropIfExists('prenotazioni');
    }
};

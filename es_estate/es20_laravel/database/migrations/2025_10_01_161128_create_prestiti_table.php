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
        Schema::create('prestiti', function (Blueprint $table) {
            $table->id('idp');
            $table->datetime('inizio_prestito');
            $table->datetime('scadenza')->storedAs(DB::raw("DATE_ADD(inizio_prestito, INTERVAL 30 DAY)"));
            $table->datetime('fine_prestito')->nullable();

            // Aggiungi le colonne per le foreign keys
            $table->unsignedBigInteger('idl');
            $table->unsignedBigInteger('idu');

            // Foreign keys corrette:
            $table->foreign('idl')
                ->references('idl')  // riferimento alla PK di 'libro'
                ->on('libri')
                ->onDelete('cascade')
                ->onUpdate('cascade');
                
            $table->foreign('idu')
                ->references('idu')  // riferimento alla PK di 'users'
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestiti');
    }
};

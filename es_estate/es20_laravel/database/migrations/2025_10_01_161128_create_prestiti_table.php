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
            $table->unsignedBigInteger('idl'); //FK
            $table->unsignedBigInteger('idu'); //FK
            $table->date('inizio_prestito')->default(DB::raw('CURRENT_DATE'));
            $table->date('scadenza')->storedAs(DB::raw("DATE_ADD(inizio_prestito, INTERVAL 30 DAY)"));
            $table->date('fine_prestito')->nullable();

            // Foreign keys:
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

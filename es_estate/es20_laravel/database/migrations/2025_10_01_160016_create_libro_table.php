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
        Schema::create('libri', function (Blueprint $table) {
            $table->id('idl');
            $table->string('titolo');
            $table->string('autore');
            $table->string('genere');
            $table->string('dewey');
            $table->string('collocazione');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libri');
    }
};

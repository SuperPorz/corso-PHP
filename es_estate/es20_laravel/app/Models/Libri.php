<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libri extends Model
{
    use HasFactory;

    protected $table = "libri"; // PORCODDIO ISTRUZIONE FONDAMENTALE DIOCANE
    public $timestamps = false; // ANCHE QUESTA DIOMMERDA
    protected $primaryKey = 'idl'; // MAIALE DIOSCHIFOSO PURE QUESTA

    protected $fillable = [
        'titolo',
        'autore',
        'genere',
        'dewey',
        'collocazione',
    ];

    // Verifica se il libro è disponibile (non in prestito)
    public function isDisponibile()
    {
        return !Prestiti::where('idl', $this->idl)
            ->whereNull('fine_prestito')
            ->exists();
    }
}

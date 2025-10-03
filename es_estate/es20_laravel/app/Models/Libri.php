<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Libri extends Model
{
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
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{

    protected $fillable = [
        'titolo',
        'autore',
        'genere',
        'dewey',
        'collocazione',
    ];

}

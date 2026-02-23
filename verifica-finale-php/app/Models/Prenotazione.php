<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prenotazione extends Model
{
    use HasFactory;

    protected $table = "prenotazioni";
    public $timestamps = false;
    protected $primaryKey = 'id_prenotazioni';

    protected $fillable = [
        'data_prenotazione',
        'nominativo'
    ];

    // METODI STATICI
    public static function all_prenotazioni()
    {
        //
    }
}

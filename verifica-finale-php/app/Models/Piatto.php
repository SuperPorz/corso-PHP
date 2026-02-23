<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piatto extends Model
{
    use HasFactory;

    protected $table = "piatti";
    public $timestamps = false;
    protected $primaryKey = 'idp';

    protected $fillable = [
        'nome_piatto',
        'tipo'
    ];

    // METODI STATICI
    public static function all_piatti()
    {
        //
    }
}

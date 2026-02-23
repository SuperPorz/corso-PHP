<?php

namespace App\Models;

use Illuminate\Container\Attributes\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingrediente extends Model
{
    use HasFactory;

    protected $table = "ingredienti";
    public $timestamps = false;
    protected $primaryKey = 'idi';

    protected $fillable = [
        'nome_ingrediente'
    ];

    // METODI STATICI
    public static function all_ingredienti()
    {
        //
    }

}

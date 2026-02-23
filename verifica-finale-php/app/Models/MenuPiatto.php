<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuPiatto extends Model
{
    use HasFactory;

    protected $table = "menu_piatti";
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_ingrediente',
        'id_piatto'
    ];
}

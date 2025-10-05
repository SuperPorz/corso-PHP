<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestiti extends Model
{
    use HasFactory;

    protected $table = "prestiti"; // PORCODDIO ISTRUZIONE FONDAMENTALE DIOCANE
    public $timestamps = false; // ANCHE QUESTA DIOMMERDA
    protected $primaryKey = 'idp'; // MAIALE DIOSCHIFOSO PURE QUESTA

    protected $fillable = [
        'idl',
        'idu',
        'inizio_prestito',
        'fine_prestito'
    ];

    public static function all_prestiti() {
        $data = \DB::table('tutti_prestiti')->get();
		return $data;
    }

    public static function prestiti_scaduti() {
        $data = \DB::table('prestiti_scaduti')->get();
		return $data;
    }
}

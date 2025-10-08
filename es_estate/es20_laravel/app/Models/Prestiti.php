<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Prestiti extends Model
{
    use HasFactory;

    protected $table = "prestiti";
    public $timestamps = false;
    protected $primaryKey = 'idp';

    protected $fillable = [
        'idl',
        'idu',
        'inizio_prestito',
        'fine_prestito'
    ];

    // RELAZIONI
    public function libro()
    {
        return $this->belongsTo(Libri::class, 'idl', 'idl');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'idu', 'idu');
    }

    // METODI STATICI
    public static function all_prestiti()
    {
        return \DB::table('tutti_prestiti')->get();
    }

    public static function prestiti_scaduti()
    {
        return \DB::table('prestiti_scaduti')->get();
    }

    public static function user_books()
    {
        return self::with('libro')
            ->where('idu', Auth::id())
            ->whereNull('fine_prestito')
            ->get()
            ->map(function ($prestito) {
                return (object) [
                    'idp' => $prestito->idp,
                    'idl' => $prestito->libro->idl,
                    'titolo' => $prestito->libro->titolo,
                    'autore' => $prestito->libro->autore,
                    'genere' => $prestito->libro->genere,
                    'dewey' => $prestito->libro->dewey,
                    'collocazione' => $prestito->libro->collocazione,
                ];
            });
    }
}
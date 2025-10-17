<?php

namespace App\Http\Controllers;

use App\Mail\SollecitoPrestito;
use App\Models\Libri;
use App\Models\Prestiti;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PrestitiController extends Controller
{
    // METODI ADMIN
    public static function index()
    {
        return Prestiti::all_prestiti();
    }

    public static function scaduti() {
        return Prestiti::prestiti_scaduti();
    }

    public static function delete_loan(Request $request) {
        Prestiti::destroy($request->idp);
        return redirect()->route('adhome')
            ->with('Prestito eliminato!');
    }

    public static function send_insult(Request $request) {
        $user = User::find($request->idu);
        $prestito = Prestiti::find($request->idp);
        Mail::to($user->email)->send(new SollecitoPrestito($prestito, $user));
        return redirect()->route('adhome');
    }

    // METODI USERS
    public function book_loan(Request $request) {
        $request->validate([
            'idl' => 'required|integer',
            'idu' => 'required|integer',
        ]);

        $libro = Libri::findOrFail($request->idl);
        if (!$libro->isDisponibile()) {
            return redirect()->route('ushome')
                ->withErrors('Libro non disponibile: è già in prestito!');
        }
        Prestiti::create([
            'idl' => $request->idl,
            'idu' => $request->idu,
        ]);
        
        return redirect()->route('ushome')
            ->with('success', 'Prestito registrato!');
    }

    public function return_book(Request $request) {
        $request->validate([
            'idp' => 'required|integer',
        ]);
        
        $prestito = Prestiti::findOrFail($request->idp);
        $prestito->fine_prestito = now()->toDateString();
        $prestito->save();
        
        return redirect()->route('ushome')
            ->with('success', 'Prestito terminato con successo!');
    }

    // PAGINE POST-AUTENTICAZIONE
    public function prestiti_utente() {
        return view('users.loans', [
            'libri_user' => Prestiti::user_books(),
            'azione' => 'visualizza',
            'type' => 'users',
            'pagina' => 'users/loans'
        ]);
    }
}

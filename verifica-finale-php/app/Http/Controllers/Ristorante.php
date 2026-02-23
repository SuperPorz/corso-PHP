<?php

namespace App\Http\Controllers;

use App\Models\Prenotazione;
use Illuminate\Http\Request;
use App\Models\VistaIngredientiGiornalieri;

class Ristorante extends Controller
{
    //pagina HOME
    public function homepage() {
        return view('homepage', [
            'prenotazioni' => Prenotazione::all()
        ]);
    }

    //invio PRENOTAZIONE
    public function invia_prenotazione(Request $request) {

        //validazione
        $request->validate ([
            'data_prenotazione' => 'required|date',
            'nominativo' => 'required|string|max:50'
        ]);

        // Inserimento
        Prenotazione::create($request->all());
        
        return redirect()->route('homepage')
            ->with('Prenotazione registrata con successo!');
    }

    // controllo ingredienti per data
    public function controlla_ingredienti(Request $request)
    {
        $request->validate([
            'data_prenotazione' => 'required|date'
        ]);

        $data = $request->data_prenotazione;

        $ingredienti = VistaIngredientiGiornalieri::where('data_selezionata', $data)->get();

        return view('homepage', [
            'prenotazioni' => Prenotazione::all(),
            'ingredienti' => $ingredienti,
            'data_selezionata' => $data
        ]);
    }
}

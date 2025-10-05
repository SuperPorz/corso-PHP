<?php

namespace App\Http\Controllers;

use App\Models\Libri;
use Illuminate\Http\Request;

class LibriController extends Controller
{
    // FUNZIONI DESTINATE ALL'AMMINISTRAZIONE BIBLIOTECA
    public function dati_libro(Request $request) {
        $libri = Libri::all();
        if (isset($request->idl) && $request->azione == 'modifica') {
            $libro_mod = Libri::find($request->idl);
        }
        else {
            $libro_mod = [];
        }
        return view('admin.edit', [
            'libri' => $libri,
            'libro_mod' => $libro_mod
        ]);
    }

    public function insert_libro(Request $request) {
        $request->validate([
            'titolo' => 'required|string|max:255',
            'autore' => 'required|string|max:255',
            'genere' => 'required|string|max:255',
            'dewey' => 'required|string|max:10',
            'collocazione' => 'required|string|max:50'
        ]);
        
        // Se c'è idl -> modifica libro
        if ($request->has('idl') && $request->idl) {
            $request->validate(['idl' => 'required|integer']);
            
            $libro = Libri::findOrFail($request->idl);
            $libro->update($request->all());
            
            return redirect()->route('adhome')
                ->with('Libro modificato con successo!');
        } else {
            // Inserimento nuovo libro
            Libri::create($request->all());
            
            return redirect()->route('adhome')
                ->with('Libro inserito con successo!');
        }
    }

    public function delete_libro(Request $request) {
        $request->validate([
            'idl' => 'required|integer'
        ]);
        Libri::destroy($request->idl);
        return redirect()->route('adhome')
            ->with('Libro eliminato con successo!');
    }

    // FUNZIONI PER GLI USERS
    public function find_book(Request $request) {
        $query = Libri::query();
        
        if ($request->filled('titolo')) {
            $query->where('titolo', 'LIKE', '%' . $request->titolo . '%');
        }
        if ($request->filled('autore')) {
            $query->where('autore', 'LIKE', '%' . $request->autore . '%');
        }
        if ($request->filled('genere')) {
            $query->where('genere', 'LIKE', '%' . $request->genere . '%');
        }
        if ($request->filled('dewey')) {
            $query->where('dewey', 'LIKE', '%' . $request->dewey . '%');
        }
        if ($request->filled('collocazione')) {
            $query->where('collocazione', 'LIKE', '%' . $request->collocazione . '%');
        }
        
        $libri_match = $query->get();
        
        return view('users.homepage', [
            'libri' => Libri::all(),
            'libri_match' => $libri_match,
            'pagina' => 'user/homepage'
        ]);
    }
}
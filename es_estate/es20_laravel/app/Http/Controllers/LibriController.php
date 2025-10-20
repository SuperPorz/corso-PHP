<?php

namespace App\Http\Controllers;

use App\Models\Libri;
use App\Models\Prestiti;
use Illuminate\Http\Request;

class LibriController extends Controller
{
    // FUNZIONI DESTINATE ALL'AMMINISTRAZIONE BIBLIOTECA

    public function pagina_db() {
        return view('admin.database', [
            'metaTitle' => 'Database biblioteca',
            'pageTitle' => 'Database',
            'libri' => Libri::all(),
            'pagina' => 'admin/database'
        ]);
    }

    public function dati_libro(Request $request) {
        $libri = Libri::all();
        if (isset($request->idl) && $request->azione == 'modifica') {
            $libro_mod = Libri::find($request->idl);
        }
        else {
            $libro_mod = [];
        }
        return view('admin.edit', [
            'pagina' => 'admin/database',
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
            
            return redirect()->route('adDB')
                ->with('Libro modificato con successo!');
        } else {
            // Inserimento nuovo libro
            Libri::create($request->all());
            
            return redirect()->route('adDB')
                ->with('Libro inserito con successo!');
        }
    }

    public function delete_libro(Request $request) {
        $request->validate([
            'idl' => 'required|integer'
        ]);
        Libri::destroy($request->idl);
        return redirect()->route('adDB')
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
        
        return view('users.search', [
            'libri_match' => $libri_match,
            'pagina' => 'users/search'
        ]);
    }

    public static function libri_per_genere() {
        return Libri::orderBy('genere', 'asc')->get();
    }

    public static function libri_per_autore() {
        return Libri::orderBy('autore', 'asc')->get();
    }

    // PAGINE POST-AUTENTICAZIONE
    public function cerca_libri() {
        return view('users.search', [
            'azione' => 'cerca',
            'type' => 'users',
            'pagina' => 'users/search'
        ]);
    }

    public function elenco_libri() {
        return view('users.stored-books', [
            'libri_genere' => $this->libri_per_genere(),
            'libri_autore' => $this->libri_per_autore(),
            'type' => 'users',
            'pagina' => 'users/stored-books'
        ]);
    }
}
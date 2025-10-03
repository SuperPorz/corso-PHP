<?php

namespace App\Http\Controllers;

use App\Models\Libri;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function login() {
        return view('admin.access', [
            'pageTitle' => 'Admin',
            'metaTitle' => 'Accesso Admin',
            'azione' => 'login',
            'user_type' => 'admin',
            'pagina' => 'admin/homepage'
        ]);
    }

    public function homepage() {
        $libri = Libri::all();
        return view('admin.homepage', ['libri' => $libri]);
    }

    public function edit_libro(Request $request) {
        $libri = Libri::all();
        if (isset($request->idl) && $request->azione == 'modifica') {
            $libro_mod = Libri::find($request->idl);
        }
        else {
            $libro_mod = [];
        }
        return view('admin.homepage', [
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
                ->with('success', 'Libro modificato con successo!');
        } else {
            // Inserimento nuovo libro
            Libri::create($request->all());
            
            return redirect()->route('adhome')
                ->with('success', 'Libro inserito con successo!');
        }
    }

    public function delete_libro(Request $request) {
        $request->validate([
            'idl' => 'required|integer'
        ]);
        Libri::destroy($request->all());
        return redirect()->route('adhome')
            ->with('success', 'Libro eliminato con successo!');
    }
}
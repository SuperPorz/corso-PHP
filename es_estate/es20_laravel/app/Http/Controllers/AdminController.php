<?php

namespace App\Http\Controllers;

use App\Models\Admins;
use App\Models\Libri;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //FUNZIONI PER ROTTE STANDARD DELLA SEZIONE ADMIN
    public function admin_homepage() {
        return view('admin.homepage', [
            'metaTitle' => 'Homepage Admin',
            'pageTitle' => 'Admin',
            'libri' => Libri::all(),
            'users' => User::all(),
            'prestiti' => PrestitiController::index(),
            'prestiti_scaduti' => PrestitiController::scaduti(),
            'pagina' => 'admin/homepage'
        ]);
    }

    // FUNZIONI LEGATE ALLE ATTIVITA' DI ADMIN
    public function promote_user(Request $request) {
        Admins::give_admin($request->idu);
        return redirect()->route('adhome')
            ->with('success', 'Utente promosso con successo!');
    }

    public function delete_user(Request $request) {
        Admins::delete_user($request->idu);
        return redirect()->route('adhome')
            ->with('success', 'Utente eliminato con successo!');
    }
}
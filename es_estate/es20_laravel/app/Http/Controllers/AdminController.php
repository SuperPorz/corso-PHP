<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function paginaAdmin() {
        return 5 + 5;
    }

    public function inserisci_libro(Request $request) {
        return 'Dati ricevuti: ' . $request->input('data');
    }
}

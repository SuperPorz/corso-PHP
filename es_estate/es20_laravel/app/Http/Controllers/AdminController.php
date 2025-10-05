<?php

namespace App\Http\Controllers;

use App\Models\Admins;
use App\Models\Libri;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //FUNZIONI PER ROTTE STANDARD DELLA SEZIONE ADMIN
    public function login() {
        return view('admin.access', [
            'azione' => 'login',
            'user_type' => 'admin',
            'pagina' => 'admin/homepage'
        ]);
    }

    public function homepage() {
        return view('admin.homepage', [
            'libri' => Libri::all(),
            'users' => User::all(),
            'prestiti' => PrestitiController::index(),
            'prestiti_scaduti' => PrestitiController::scaduti(),
            'pagina' => 'admin/homepage'
        ]);
    }
}
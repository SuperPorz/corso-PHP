<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LettoriController extends Controller
{
    public function benvenuto_cliente() {
        echo "Benvenuto!!!";
    }

    public function cerca_libro(Request $request) {
        //giusto per test:
        return 'Dati ricevuti: ' . $request->input('data');
    }

    public function prenota_libro($libro) {
        return $libro . ' prenotato!';
    }
}
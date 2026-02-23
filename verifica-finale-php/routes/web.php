<?php

use App\Http\Controllers\Ristorante;
use Illuminate\Support\Facades\Route;

//rotta (get) HOMEPAGE
Route::get('/', [Ristorante::class, 'homepage'])->name('homepage');

//rotta (post) INVIO PRENOTAZIONE
Route::post('/', [Ristorante::class, 'invia_prenotazione'])
    ->name('invia_prenotazione');

//rotta (post) RICHIESTA LISTA INGREDIENTI
Route::post('/ingredienti', [Ristorante::class, 'controlla_ingredienti'])
    ->name('controlla_ingredienti');
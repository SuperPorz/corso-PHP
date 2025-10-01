<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LettoriController;
use Illuminate\Support\Facades\Route;


// HOMEPAGE
Route::get('/', function () {
    return view('homepage', [
        'pageTitle' => 'Homepage',
        'metaTitle' => 'Homepage dell\'App'
    ]);
})->name('homepage');

// ADMIN ROUTES
Route::get('/admin', function () {
    return view('admin', [
        'pageTitle' => 'Admin',
        'metaTitle' => 'Accesso Admin'
    ]);
})->name('admin');
Route::post('/admin', [AdminController::class, 'inserisci_libro'])->name('admin-post');


// CLIENTS ROUTES
Route::get('/lettori', function () {
    return view('lettori', [
        'pageTitle' => 'Lettori',
        'metaTitle' => 'Sezione Lettori'
    ]);
})->name('lettori');
Route::post('/lettori', [LettoriController::class, 'cerca_libro'])->name('lettori-cerca');
Route::post('/lettori/prenotazione', [LettoriController::class, 'prenota_libro'])->name('lettori-prenota');
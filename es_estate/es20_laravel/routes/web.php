<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LettoriController;
use App\Http\Controllers\PrestitoController;
use Illuminate\Support\Facades\Route;


// HOMEPAGE
Route::get('/', function () {
    return view('homepage', [
        'pageTitle' => 'Homepage',
        'metaTitle' => 'Homepage dell\'App'
    ]);
});

// ADMIN ROUTES
Route::get('/admin', function () {
    return view('admin', [
        'pageTitle' => 'Admin',
        'metaTitle' => 'Accesso Admin'
    ]);
});
Route::post('/admin', [AdminController::class, 'inserisci_libro']);


// CLIENTS ROUTES
Route::get('/lettori', function () {
    return view('lettori', [
        'pageTitle' => 'Lettori',
        'metaTitle' => 'Sezione Lettori'
    ]);
});
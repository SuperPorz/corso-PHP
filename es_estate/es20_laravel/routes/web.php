<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LettoriController;
use App\Models\Libri;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// HOMEPAGE
Route::get('/', function () {
    return view('welcome', [
        'pageTitle' => 'Homepage',
        'metaTitle' => 'Homepage dell\'App'
    ]);})->name('welcome');

// ADMIN ROUTES
Route::get('admin', [AdminController::class, 'login'])
    ->name('adlogin');

Route::get('admin/homepage', [AdminController::class, 'homepage'])
    ->name('adhome');

Route::post('admin/homepage', [AdminController::class, 'edit_libro'])
    ->name('edit-libro');

Route::post('admin/insert', [AdminController::class, 'insert_libro'])
    ->name('insert-libro');

Route::post('admin/delete', [AdminController::class, 'delete_libro'])
    ->name('delete-libro');



// CLIENTS ROUTES
Route::prefix('lettori')->group(function () {

    // Rotta pubblica di accesso
    Route::get('/lettori', function () {
        $libri = Libri::all();
        return view('lettori.login', [
            'pageTitle' => 'Lettori',
            'metaTitle' => 'Sezione Lettori',
            'libri' => $libri
        ]);
    })->name('lettori');

    // Rotte protette
    Route::middleware(['auth'])->group(function () {
        Route::get('/homepage', function () {
            return view('lettori.homepage')->name('lettori-homepage');
        });
        
        Route::post('/cerca', function () {
            //codice di riferimento al controller per cercare libri
            return view('lettori.homepage')->name('lettori-cerca');
        });

        Route::post('/prestito', function () {
            //Libro::findOrFail();
            //codice di riferimento al controller per il prestito
            return view('lettori.homepage')->name('lettori-prestito');
        });
    });

});


Route::post('/lettori/cerca', [LettoriController::class, 'cerca_libro'])->name('lettori-cerca');
Route::post('/lettori/prenotazione', [LettoriController::class, 'prenota_libro'])->name('lettori-prenota');
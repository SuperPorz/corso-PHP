<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LettoriController;
use App\Models\Libro;
use Illuminate\Support\Facades\Route;


// HOMEPAGE
Route::get('/', function () {
    return view('welcome', [
        'pageTitle' => 'Homepage',
        'metaTitle' => 'Homepage dell\'App'
    ]);
})->name('welcome');

// ADMIN ROUTES
Route::prefix('admin')->group(function () {

    // Rotta pubblica di accesso
    Route::get('/', function () {
        return view('admin.access', [
            'pageTitle' => 'Admin',
            'metaTitle' => 'Accesso Admin'
        ]);
    })->name('admin');

    // Rotte protette
    Route::middleware(['auth'])->group(function () {
        Route::get('/homepage', function () {
            $libri = Libro::all();
            return view('admin.homepage', ['libri' => $libri]);
        })->name('admin-homepage');

        Route::post('/insert', function (Request $request) {
            $request->validate([
                'titolo' => 'required|string|max:255',
                'autore' => 'required|string|max:255',
                'genere' => 'required|string|max:255',
                'dewey' => 'required|string|max:10',
                'collocazione' => 'required|string|max:50'
            ]);
            
            Libro::create($request->all());
            return redirect()->route('admin-homepage')
                ->with('success', 'Libro inserito con successo!');
        })->name('admin-insert');
    });
});


// CLIENTS ROUTES
Route::prefix('lettori')->group(function () {

    // Rotta pubblica di accesso
    Route::get('/lettori', function () {
        $libri = Libro::all();
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
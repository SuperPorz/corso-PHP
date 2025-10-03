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
    ]);
})->name('welcome');

// ADMIN ROUTES
Route::get('admin', function () {
    return view('admin.access', [
        'pageTitle' => 'Admin',
        'metaTitle' => 'Accesso Admin',
        'azione' => 'login',
        'user_type' => 'admin',
        'pagina' => 'admin/homepage'
    ]);
})->name('admin');

Route::get('admin/homepage', function () {
    $libri = Libri::all();
    return view('admin.homepage', ['libri' => $libri]);
})->name('admin-homepage');

Route::post('admin/homepage', function (Request $request) {
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
});

Route::post('admin/insert', function (Request $request) {
    $request->validate([
        'titolo' => 'required|string|max:255',
        'autore' => 'required|string|max:255',
        'genere' => 'required|string|max:255',
        'dewey' => 'required|string|max:10',
        'collocazione' => 'required|string|max:50'
    ]);
    
    // Se c'è idl -> modifica, altrimenti inserimento
    if ($request->has('idl') && $request->idl) {
        $request->validate(['idl' => 'required|integer']);
        
        $libro = Libri::findOrFail($request->idl);
        $libro->update($request->all());
        
        return redirect()->route('admin-homepage')
            ->with('success', 'Libro modificato con successo!');
    } else {
        // Inserimento nuovo libro
        Libri::create($request->all());
        
        return redirect()->route('admin-homepage')
            ->with('success', 'Libro inserito con successo!');
    }
});

Route::post('admin/delete', function (Request $request) {
    $request->validate([
        'idl' => 'required|integer'
    ]);
    Libri::destroy($request->all());
    return redirect()->route('admin-homepage')
        ->with('success', 'Libro eliminato con successo!');
});




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
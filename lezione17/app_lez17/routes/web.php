<?php

use Illuminate\Support\Facades\Route;

// HOMEPAGE
Route::get('/', function () {
    return view('homepage');
});


// ROUTES DI LISTA PERSONE E PAGINE BIOGRAFIE
Route::get('/lista', function () {
    return view('lista', [
        'lista' => [
            'mario',
            'sandra',
            'giovanna',
            'piero',
            'carlotta'
        ]
    ]);
});

Route::get('/lista/{name}', function ($name) {
    return view('biografia', [
        'name' => $name,
        'biografie' => [
            'mario' => 'MARIO ipsum dolor sit amet, consectetuer adipiscing elit.',
            'sandra' => 'SANDRA ipsum dolor sit amet, consectetuer adipiscing elit.',
            'giovanna' => 'GIOVANNA ipsum dolor sit amet, consectetuer adipiscing elit.',
            'piero' => 'PIERO ipsum dolor sit amet, consectetuer adipiscing elit.',
            'carlotta' => 'CARLOTTA ipsum dolor sit amet, consectetuer adipiscing elit.'
        ]
    ]);
});

// FORM BIOGRAFIE
Route::get('/form', function () {
    return view('form');
});

Route::post('/submitted-form', function (\Illuminate\Http\Request $request) {
    $name = $request->input('name');
    $bio = $request->input('bio');
    return view('submitted-form', ['name' => $name, 'bio' => $bio]);
});


// FORM SOMMA NUMERI
Route::get('/form-numeri', function () {
    return view('form-numeri');
});

Route::post('/risultato', function (\Illuminate\Http\Request $request) {
    $num1 = $request->input('num1');
    $num2 = $request->input('num2');
    return view('risultato', [
        'num1' => $num1, 
        'num2' => $num2,
        'somma' => $num1 + $num2
    ]);
});



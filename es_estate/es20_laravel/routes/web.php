<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LibriController;
use App\Http\Controllers\PrestitiController;
use App\Http\Controllers\UsersController;


// HOMEPAGE APP
Route::get('/', function () {return view('welcome');})->name('welcome');


////////////////////////////////////////////////////////////////////////////////
// CREATION ROUTES (popola DB con fatories & seeders)
Route::get('/populate',function(){ 
    Artisan::call('db:seed', ['--class' => 'DatabaseSeeder']);
    return view('welcome', ['data' => 'Database popolato!']);
});


////////////////////////////////////////////////////////////////////////////////
// USERS ROUTES - PUBBLICHE (senza middleware auth)
Route::prefix('users')->controller(UsersController::class)->group(function () {

    //login (users & admins)
    Route::get('login', 'login_page')->defaults('type', 'user')->name('login');
    Route::post('login', 'login');

    //registrazione (users & admins)
    Route::get('register', 'register_page')->name('usreg');
    Route::post('register', 'register');
});


////////////////////////////////////////////////////////////////////////////////
// USERS ROUTES - PROTETTE (con middleware auth)
Route::prefix('users')->middleware('auth')->group(function () {

    // Rotte UsersController
    Route::controller(UsersController::class)->group(function () {
        //logout (users & admins)
        Route::post('logout', 'logout')->name('uslogout');

        //homepage users
        Route::get('homepage', 'user_homepage')->name('ushome');
    });

    // Rotte LibriController
    Route::controller(LibriController::class)->group(function () {
        //cerca libro
        Route::get('search', 'search_homepage');
        Route::post('search', 'find_book');
    });

    // Rotte PrestitiController
    Route::controller(PrestitiController::class)->group(function () {
        //prenota libro
        Route::post('loan', 'book_loan');
        Route::post('return-book','return_book')->name('return.book');
    });
});


////////////////////////////////////////////////////////////////////////////////
// ADMIN ROUTES - PROTETTE (con middleware auth)
Route::prefix('admin')->middleware('auth')->group(function () {

    // AdminController
    Route::controller(AdminController::class)->group(function () {

        //homepage
        Route::get('homepage', 'admin_homepage')->name('adhome');
        Route::post('homepage', 'homepage');

        //modifica/elimina users
        Route::post('promote-user', 'promote_user');
        Route::post('delete-user', 'delete_user');
    });
    
    // LibriController
    Route::controller(LibriController::class)->group(function () {

        //modifica/elimina libro
        Route::post('edit-book', 'dati_libro');
        Route::post('insert-book', 'insert_libro');
        Route::post('delete-book', 'delete_libro');
    });
    
    // PrestitiController
    Route::controller(PrestitiController::class)->group(function () {

        //cancella prestito
        Route::post('delete-loan', 'delete_loan');

        //invia mail sollecito
        Route::post('send-insult', 'send_insult');
    });
});
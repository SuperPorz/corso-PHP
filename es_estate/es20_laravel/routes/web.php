<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LibriController;
use App\Http\Controllers\PrestitiController;
use App\Http\Controllers\UsersController;

// HOMEPAGE APP
Route::get('/', function () {return view('welcome');})->name('welcome');

// CREATION ROUTES (popola DB con fatories & seeders)
Route::get('/populate',function(){ 
    Artisan::call('db:seed', ['--class' => 'DatabaseSeeder']);
    return view('welcome', ['data' => 'Database popolato!']);
});

// ADMIN ROUTES
//login admins
Route::get('admin', [AdminController::class, 'login'])->name('adlogin');

//homepage admins
Route::get('admin/homepage', [AdminController::class, 'homepage'])->name('adhome');
Route::post('admin/homepage', [AdminController::class, 'homepage']);

//post-libro
Route::post('admin/edit-book', [LibriController::class, 'dati_libro']);
Route::post('admin/insert-book', [LibriController::class, 'insert_libro']);
Route::post('admin/delete-book', [LibriController::class, 'delete_libro']);

//post-users
Route::post('admin/promote-user', [UsersController::class, 'promote_user']);
Route::post('admin/delete-user', [UsersController::class, 'delete_user']);

//post-prestiti
Route::post('admin/delete-loan', [PrestitiController::class, 'delete_loan']);
Route::post('admin/send-insult', [PrestitiController::class, 'send_insult']);


// USERS ROUTES
//login
Route::get('users', [UsersController::class, 'login_page'])->name('uslogin');

//registrazione
Route::get('users/register', [UsersController::class, 'register_page'])->name('usreg');
Route::post('users/register', [UsersController::class, 'register']);

//homepage users
Route::get('users/homepage', [UsersController::class, 'homepage'])->name('ushome');

//cerca libro
Route::post('users/search', [LibriController::class, 'find_book']);

//prenota libro
Route::post('users/loan', [PrestitiController::class, 'book_loan']);
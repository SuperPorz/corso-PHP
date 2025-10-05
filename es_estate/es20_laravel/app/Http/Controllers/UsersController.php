<?php

namespace App\Http\Controllers;

use App\Models\Libri;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    // FUNZIONI PER ROTTE CHE AMMINISTRANO GLI USERS
    public function promote_user(Request $request) {
        Admins::give_admin($request->idu);
        return redirect()->route('adhome')
            ->with('success', 'Utente promosso con successo!');
    }

    public function delete_user(Request $request) {
        Admins::delete_user($request->idu);
        return redirect()->route('adhome')
            ->with('success', 'Utente eliminato con successo!');
    }

    // FUNZIONI PER ROTTE PUBBLICHE (users)
    public function login_page() {
        return view('users.login', [
            'azione' => 'login',
            'user_type' => 'users',
            'pagina' => 'users/homepage'
        ]);
    }

    public function register_page() {
        return view('users.register', [
            'azione' => 'registra',
            'user_type' => 'users',
            'pagina' => 'users/register'
        ]);
    }

    public function homepage() {
        return view('users.homepage', [
            'libri' => Libri::all(),
            'azione' => 'cerca',
            'user_type' => 'users',
            'pagina' => 'users/search'
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect('users')->with('success', 'Utente registrato!');
    }
}

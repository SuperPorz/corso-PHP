<?php

namespace App\Http\Controllers;

use App\Models\Prestiti;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    // CARICAMENTO PAGINE
    public function login_page() {
        return view('users.login', [
            'metaTitle' => 'Accesso Users',
            'pageTitle' => 'Users',
            'h1' => 'LOGIN UTENTI',
            'h3' => 'Accedi all\'area riservata utenti/admin:',
            'azione' => 'login',
            'pagina' => 'users/login'
        ]);
    }

    public function register_page() {
        return view('users.register', [
            'h1' => 'REGISTRAZIONE UTENTI',
            'h3' => 'Registrati per poter usufruire dei servizi bibliotecari',
            'azione' => 'registra',
            'type' => 'users',
            'pagina' => 'users/register'
        ]);
    }

    public function user_homepage() {
        return view('users.homepage', [
            'libri_user' => Prestiti::user_books(),
            'libri_genere' => LibriController::libri_per_genere(),
            'libri_autore' => LibriController::libri_per_autore(),
            'azione' => 'cerca',
            'type' => 'users',
            'pagina' => 'users/search'
        ]);
    }

    // REGISTRAZIONE/LOGIN/LOGUT
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        Auth::login($user);
        return redirect()->route('login')->with('success', 'Utente registrato!');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Verifica se l'utente è admin
            if (Auth::user()->is_admin) {
                return redirect()->route('adhome')
                    ->with('success', 'Benvenuto Admin!');
            } else {
                return redirect()->route('ushome')
                    ->with('success', 'Login effettuato con successo');
            }
        }
        else {
            return redirect()->route('login')->withErrors('Credenziali errate!');
        }
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->with('success', 'Logout effettuato con successo');
    }

    // FUNZIONI POST-AUTENTICAZIONE
}
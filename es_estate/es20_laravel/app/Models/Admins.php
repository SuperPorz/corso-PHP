<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Admins extends Model
{
    public function give_admin_rights($idu) {
        $user = User::findOrFail($idu);
        if ($user) {
            $user->is_admin = true;
            echo 'Utente promosso Admin!';
        }
        else {
            echo 'Utente non presente nel Database';
        }
    }
}

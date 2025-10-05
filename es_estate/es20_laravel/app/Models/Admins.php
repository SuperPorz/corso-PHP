<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Admins extends Model
{
    public static function give_admin($idu) {
        $user = User::find($idu);
        $user->is_admin = true;
        $user->save();
    }

    public static function delete_user($idu) {
        User::destroy($idu);
    }
}


/* public static function delete_user($idu) {
        $user = User::find($idu);
        $user->delete();
    } */
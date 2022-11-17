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
        if (Auth::check() && currentUser()->isSuperAdmin()) {
            $user = User::where("email", $email)->first();
            // dd($user);
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

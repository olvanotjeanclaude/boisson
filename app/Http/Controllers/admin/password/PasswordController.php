<?php

namespace App\Http\Controllers\admin\password;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function index()
    {

        return view("admin.password.index");
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $password = $request->password;
        $re_password = $request->re_password;

        if ($password == $re_password) {

            $user = $request->user();
            // dd($user);
            $updated = $user->update([
                "password" => Hash::make($password)
            ]);

            if ($updated) {
                return back()->with("success", "Mot de passe modifie avec success");
            }

            return back()->with("error", "Erreur inconnu");
        }

        return back()->with("error", "Le mot de passe ne correspond pas");
    }
}

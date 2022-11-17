<?php

namespace App\Http\Controllers;

use App\helper\Access;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DisableAccountController extends Controller
{
    public function index()
    {
        if (Auth::check() && currentUser()->isSuperAdmin()) {
            $users = User::where("permission_access", "!=", Access::ROLES["super admin"])->get();
            return view("disable-account-form", compact("users"));
        }

        abort(403);
    }

    public function store(Request $request)
    {
        $expiredDate = $request->expiration_date;
        $users = User::where("permission_access", "!=", Access::ROLES["super admin"]);

        if($expiredDate && $request->status=="1"){
            $message = "Tous les comptes seront désactivés après " . format_date_time($expiredDate);
        }
        else{
            $expiredDate = null;
            $message = "Date d'expiration de tout utilisateur supprimée";
        }

        $users->update(["expiration_date" => $expiredDate]);

        return back()->with("message", $message);
    }

    public function stoe(Request $request)
    {
        $expiredDate = $request->expiration_date;
        $message = "";
        $users = User::where("permission_access", "!=", Access::ROLES["super admin"]);


        $request->validate([
            "expiration_date" => isset($request->deactivate) ? "required" : ""
        ], [
            "expiration_date.required" => "Entrer la date d'expiration"
        ]);


        if ($request->user_id != "tout") {
            $users =  User::findOrFail($request->user_id);
        }

        if (isset($request->deactivate)) {
        }

        if ((!$expiredDate && !$request->user_id && !isset($request->deactivate)) ||
            (!$expiredDate && !$request->user_id && isset($request->deactivate))
        ) {
            $message = "Entrer ou supprimer la date s'expiration";
        } elseif (isset($request->deactivate)) {
            if ($expiredDate) {
                if ($request->user_id) {
                    $message = "Date d'expiration pour " . Str::title($users->full_name) . " sera " . format_date_time($expiredDate);
                } else {
                    $message = "Tous les comptes seront désactivés après " . format_date_time($expiredDate);
                }
            }
        } else {
            $expiredDate = null;

            if ($request->user_id) {
                $message = "Date d'expiration pour $users->full_name est supprimée";
            } else {
                $message = "Date d'expiration de tout utilisateur supprimée";
            }
        }

        $users->update(["expiration_date" => $expiredDate]);

        return back()->with("message", $message);
    }
}

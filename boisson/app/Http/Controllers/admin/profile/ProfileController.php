<?php

namespace App\Http\Controllers\admin\profile;

use App\Models\User;
use App\helper\UploadFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view("admin.profile.index", compact("user"));
    }

    public function edit()
    {
        $user = Auth::user();
        $provinces = [];
        return view("admin.profile.edit", compact("user","provinces"));
    }

    public function update(Request $request)
    {
        $user = $request->user();
        $allEmails = User::pluck("email")->toArray();
        $data = $request->except('_token');

        if ($user->email !== $data["email"] && in_array($data["email"], $allEmails)) {
            return back()->with("errorEmail", "L'e-mail existe déjà dans le système. Veuillez saisir une autre adresse e-mail.");
        }

        if (isset($data['image'])) {
            deleteFile($user->image);
            $data["image"] =  UploadFile::save(rand(1111, 9999), "users", $request->file("image"));
        }

        $update = $user->update($data);

        if ($update) {
            return redirect("/admin/profile")->with('success', 'Votre profil a été mis à jour avec succès.');
        }

        return redirect("/admin/profile")->with('error', 'Un problème est survenu lors de la mise à jour du profil. Réessayez plus tard!');
    }
}

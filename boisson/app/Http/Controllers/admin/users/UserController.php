<?php

namespace App\Http\Controllers\admin\users;

use App\helper\Access;
use App\Models\User;
use App\helper\UploadFile;
use Illuminate\Http\Request;
use App\Message\CustomMessage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function __construct()
    {
        // $this->authorizeResource(User::class, "utilisateur");
    }

    public function index()
    {
        $users = User::where("id", "!=", auth()->user()->id)
            ->where("permission_access", "!=", 1)
            ->orderBy("id", "desc")->paginate(8);
        return view("admin.utilisateur.index", compact("users"));
    }

    public function create()
    {
        abort_if(!currentUser()->isSuperAdmin() && currentUser()->expiration_date, 403);

        return view("admin.utilisateur.create");
    }

    private function rules($update = false, $id = null)
    {
        return [
            "name" => "required",
            "surname" => "required",
            "identity_number" => "required",
            "birth_date" => "required",
            "email" => ["required", Rule::unique("users")->ignore($id)],
            "phone" => "required",
            "password" => $update ? '' : "required"
        ];
    }

    private function message()
    {
        return [
            "required" => "Le champ :attribute est obligatoire!",
            "email.unique" => "L'email existe déjà. Veuillez saisir un nouvel e-mail"
        ];
    }

    public function store(Request $request)
    {
        $request->validate($this->rules(), $this->message());
        //Pa$$w0rd!

        // dd($request->all());
        $data = $request->except("_token");

        if ($request->file("image")) {
            $data["image"] =  UploadFile::save(rand(1111, 9999), "users", $request->file("image"));
        }

        $data["password"] = Hash::make($request->password);

        $saved = User::create($data);
        Access::syncRolePermission($saved);

        if ($saved) {
            return redirect("/admin/utilisateurs")->with("success", CustomMessage::Success("L'utlisateur"));
        }

        return back()->with("error", CustomMessage::DEFAULT_ERROR);
    }

    public function update(User $user, Request $request)
    {
        $request->validate($this->rules(true, $user->id), $this->message());

        //dd($request->all());
        $data = $request->except("_token");

        if ($request->file("image")) {
            $data["image"] =  UploadFile::save(rand(1111, 9999), "users", $request->file("image"));
        }
        Access::syncRolePermission($user);
        $saved = $user->update($data);
        if ($saved) {
            return redirect("/admin/utilisateurs")->with("success", CustomMessage::Success("L'utlisateur"));
        }

        return back()->with("error", CustomMessage::DEFAULT_ERROR);
    }

    public function edit(User $user)
    {
        // $user = User::findOrFail($id);

        return view("admin.utilisateur.edit", compact("user"));
    }

    public function destroy(User $user)
    {
        User::with('roles')->where("id", $user->id)->delete();
        deleteFile($user->image);
        $delete = $user->delete();
        //$delete =true;
        $result = [];

        if ($delete) {
            $result["success"] = CustomMessage::Delete("L'utilisateur");
            $result["type"] = "success";
            $result["reload"] = true;
        } else {
            $result["type"] = "error";
            $result["error"] = CustomMessage::DEFAULT_ERROR;
        }

        return response()->json($result);
    }
}

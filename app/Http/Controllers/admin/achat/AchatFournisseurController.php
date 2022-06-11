<?php

namespace App\Http\Controllers\admin\achat;

use Illuminate\Http\Request;
use App\Message\CustomMessage;
use App\Http\Controllers\Controller;

class AchatFournisseurController extends Controller
{
    public function index()
    {
        $users = [];
        return view("admin.achat-supplier.index", compact("users"));
    }

    public function create()
    {
        return view("admin.achat-supplier.create");
    }

    private function rules($update = false)
    {
        return [
            "name" => "required",
            "surname" => "required",
            "identity_number" => "required",
            "birth_date" => "required",
            "email" => "required",
            "phone" => "required",
            "password" => $update ? '' : "required"
        ];
    }

    private function message()
    {
        return [
            "required" => "Le champ :attribute est obligatoire!"
        ];
    }

    public function store(Request $request)
    {
        $request->validate($this->rules(), $this->message());
       
        // dd($request->all());
        $data = $request->except("_token");

        $saved = true;
        if ($saved) {
            return redirect("/admin/utlisateurs")->with("success", CustomMessage::Success("L'utlisateur"));
        }

        return back()->with("error", CustomMessage::DEFAULT_ERROR);
    }

    public function update($userId, Request $request)
    {
       $user ="";

        $request->validate($this->rules(true), $this->message());

        //dd($request->all());
        $data = $request->except("_token");

       

        $saved = true;

        if ($saved) {
            return redirect("/admin/utlisateurs")->with("success", CustomMessage::Success("L'utlisateur"));
        }

        return back()->with("error", CustomMessage::DEFAULT_ERROR);
    }

    public function edit($id)
    {
      $user = [];
        return view("admin.achat-supplier.edit", compact("user"));
    }

    public function destroy($id)
    {
        $user =[];
    
        $delete =true;
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

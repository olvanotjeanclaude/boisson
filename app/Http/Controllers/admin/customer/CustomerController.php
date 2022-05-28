<?php

namespace App\Http\Controllers\admin\customer;

use App\Models\Customers;
use Illuminate\Http\Request;
use App\Message\CustomMessage;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customers::orderBy("id","desc")->get();
        return view("admin.customer.index", compact("customers"));
    }

    public function create()
    {
        return view("admin.customer.create");
    }

    private function rules()
    {
        return [
            "code" => "required",
            "identification" => "required",
            "phone" => "required",
            "address" => "required",
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
        $data["user_id"] = auth()->user()->id;
        $saved = Customers::create($data);

        if ($saved) {
            return redirect("/admin/clients")->with("success", CustomMessage::Success("Le client"));
        }

        return back()->with("error", CustomMessage::DEFAULT_ERROR);
    }

    public function update($userId, Request $request)
    {
        $user = Customers::findOrFail($userId);

        $request->validate($this->rules(true), $this->message());

        //dd($request->all());
        $data = $request->except("_token");


        $saved = $user->update($data);

        if ($saved) {
            return redirect("/admin/utlisateurs")->with("success", CustomMessage::Success("L'utlisateur"));
        }

        return back()->with("error", CustomMessage::DEFAULT_ERROR);
    }

    public function edit($id)
    {
        $customer = Customers::findOrFail($id);
        return view("admin.customer.edit", compact("customer"));
    }

    public function destroy($id)
    {
        $user = Customers::findOrFail($id);
        $delete = $user->delete();
        //$delete =true;
        $result = [];

        if ($delete) {
            $result["success"] = CustomMessage::Delete("Le client");
            $result["type"] = "success";
        } else {
            $result["type"] = "error";
            $result["error"] = CustomMessage::DEFAULT_ERROR;
        }

        return response()->json($result);
    }
}

<?php

namespace App\Http\Controllers\admin\supplier;

use Illuminate\Http\Request;
use App\Message\CustomMessage;
use App\Http\Controllers\Controller;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Supplier::class, "fournisseur");
    }
    public function index()
    {
        $suppliers = Supplier::orderBy("id", "desc")->get();
        return view("admin.supplier.index", compact("suppliers"));
    }

    public function create()
    {
        return view("admin.supplier.create");
    }

    public function edit($supplier)
    {
        return view("admin.supplier.edit", compact("supplier"));
    }

    public function show($supplier)
    {
        return view("admin.supplier.show", compact("supplier"));
    }

    public function store(Request $request)
    {
        $data = $request->except("_token");
        $data["user_id"] = auth()->user()->id;
        $data["code"] = Supplier::generateUniqueId();
       
        $saved = Supplier::create($data);

        if ($saved) {
            return redirect("admin/fournisseurs")->with("success", CustomMessage::Success("Le fournisseur"));
        }

        return back()->with("error", CustomMessage::DEFAULT_ERROR);
    }

    public function update($supplier, Request $request)
    {
        $data = $request->except("_token");

        $saved = $supplier->update($data);

        if ($saved) {
            return redirect("admin/fournisseurs")->with("success", CustomMessage::Success("Le fournisseur"));
        }

        return back()->with("error", CustomMessage::DEFAULT_ERROR);
    }


    public function destroy($id)
    {
        $user = Supplier::findOrFail($id);

        $delete = $user->delete();
        //$delete =true;
        $result = [];

        if ($delete) {
            $result["success"] = CustomMessage::Delete("Le fournisseur");
            $result["type"] = "success";
        } else {
            $result["type"] = "error";
            $result["error"] = CustomMessage::DEFAULT_ERROR;
        }

        return response()->json($result);
    }
}

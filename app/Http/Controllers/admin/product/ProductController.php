<?php

namespace App\Http\Controllers\admin\product;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Message\CustomMessage;
use App\Http\Controllers\Controller;


class ProductController extends Controller
{
    public function index()
    {
        //$products = Product::orderBy("id", "desc")->get();
        $products = [];
        return view("admin.product.index", compact("products"));
    }

    public function create()
    {
        return view("admin.product.create");
    }

    public function edit($supplierId)
    {
        $supplier = Product::findOrFail($supplierId);
        return view("admin.product.edit", compact("supplier"));
    }

    public function show($supplierId)
    {
        $supplier = Product::findOrFail($supplierId);
        return view("admin.product.show", compact("supplier"));
    }

    public function store(Request $request)
    {
        $data = $request->except("_token");
        $data["user_id"] = auth()->user()->id;

        $saved = Product::create($data);

        if ($saved) {
            return redirect("admin/fournisseurs")->with("success", CustomMessage::Success("Le fournisseur"));
        }

        return back()->with("error", CustomMessage::DEFAULT_ERROR);
    }

    public function update($supplierId, Request $request)
    {
        $supplier = Product::findOrFail($supplierId);

        $data = $request->except("_token");

        $saved = $supplier->update($data);

        if ($saved) {
            return redirect("admin/fournisseurs")->with("success", CustomMessage::Success("Le fournisseur"));
        }

        return back()->with("error", CustomMessage::DEFAULT_ERROR);
    }


    public function destroy($id)
    {
        $user = Product::findOrFail($id);

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

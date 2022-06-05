<?php

namespace App\Http\Controllers\admin\approvisionnement;

use App\Models\Category;
use App\Models\Consignation;
use Illuminate\Http\Request;
use App\Message\CustomMessage;
use App\Http\Controllers\Controller;

class ConsignationController extends Controller
{
    public function index()
    {
        $consignations = Consignation::orderBy("id", "desc")->get();
        return view("admin.approvisionnement.consignation.index", compact("consignations"));
    }

    public function create()
    {
        $catArticles = Category::orderBy("name", "asc")->get();
        return view("admin.approvisionnement.consignation.create", compact("catArticles"));
    }

    public function edit($id)
    {
        $consignation = Consignation::findOrFail($id);
        $catArticles = Category::orderBy("name", "asc")->get();
        return view("admin.approvisionnement.consignation.edit", compact("catArticles", "consignation"));
    }

    public function store(Request $request)
    {
        $request->validate([
            "designation" => "required|string",
            "unit_price" => "required|numeric",
            "price" => "required|numeric",
            "category_id" => "required"
        ]);

        $data = $request->except("_token");
        $data["reference"] = (string) random_int(11111, 99999);
        $data["user_id"] = auth()->user()->id;

        $saved = Consignation::create($data);

        if ($saved) {
            return back()->with("success", CustomMessage::Success("Deconsignation d'article"));
        }

        return back()->with("error", CustomMessage::DEFAULT_ERROR);
    }

    public function update($id, Request $request)
    {
        $cosnignation = Consignation::findOrFail($id);

        $request->validate([
            "designation" => "required|string",
            "unit_price" => "required|numeric",
            "price" => "required|numeric",
            "category_id" => "required"
        ]);

        $data = $request->except("_token");

        $data["update_user_id"] = auth()->user()->id;

        $saved = $cosnignation->update($data);

        if ($saved) {
            return back()->with("success", CustomMessage::Success("L'article"));
        }

        return back()->with("error", CustomMessage::DEFAULT_ERROR);
    }

    public function destroy($id)
    {
        $result = [];
        $delete = Consignation::findOrFail($id);

        if ($delete->delete()) {
            $result["success"] = CustomMessage::Delete("L'article");
            $result["type"] = "success";
        } else {
            $result["type"] = "error";
            $result["error"] = CustomMessage::DEFAULT_ERROR;
        }

        return response()->json($result);
    }
}

<?php

namespace App\Http\Controllers\admin\produit;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Message\CustomMessage;
use App\Http\Controllers\Controller;
use App\Models\Emballage;

class EmballageController extends Controller
{
    public function index()
    {
        $consignations = Emballage::orderBy("id", "desc")->get();
        return view("admin.approvisionnement.consignation.index", compact("consignations"));
    }

    public function create()
    {
        $catArticles = Category::orderBy("name", "asc")->get();
        $emballages = Emballage::orderBy("designation")->get();
        return view("admin.approvisionnement.consignation.create", compact("catArticles","emballages"));
    }

    public function edit($id)
    {
        $consignation = Emballage::findOrFail($id);
        $catArticles = Category::orderBy("name", "asc")->get();
        return view("admin.approvisionnement.consignation.edit", compact("catArticles", "consignation"));
    }

    private function rules(){
        return [
            "designation" => "required|string",
            "price" => "required|numeric",
            // "category_id" => "required"
        ];
    }
    
    public function store(Request $request)
    {
        $request->validate($this->rules());

        $data = $request->except("_token");
        $data["reference"] = (string) random_int(11111, 99999);
        $data["user_id"] = auth()->user()->id;
    
        $saved = Emballage::create($data);

        if ($saved) {
            return back()->with("success", CustomMessage::Success("Deconsignation d'article"));
        }

        return back()->with("error", CustomMessage::DEFAULT_ERROR);
    }

    public function update($id, Request $request)
    {
        $cosnignation = Emballage::findOrFail($id);

        $request->validate($this->rules());

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
        $delete = Emballage::findOrFail($id);

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

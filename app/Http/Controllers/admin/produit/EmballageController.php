<?php

namespace App\Http\Controllers\admin\produit;

use App\Models\Stock;
use App\Models\Category;
use App\Models\Emballage;
use App\Models\Consignation;
use Illuminate\Http\Request;
use App\Message\CustomMessage;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Traits\ArticlesAuthorizable;

class EmballageController extends Controller
{
    use ArticlesAuthorizable;

    public function index()
    {
        $consignations = Emballage::orderBy("id", "desc")->get();
        return view("admin.approvisionnement.consignation.index", compact("consignations"));
    }

    public function create()
    {
        $catArticles = Category::orderBy("name", "asc")->get();
        $emballages = Emballage::orderBy("designation")->get();
        return view("admin.approvisionnement.consignation.create", compact("catArticles", "emballages"));
    }

    public function edit($id)
    {
        $consignation = Emballage::findOrFail($id);
        $catArticles = Category::orderBy("name", "asc")->get();
        return view("admin.approvisionnement.consignation.edit", compact("catArticles", "consignation"));
    }

    private function rules($emballage_id = null)
    {
        return [
            "designation" => ["required", "string", Rule::unique("emballages", "designation")->ignore($emballage_id)],
            "price" => "required|numeric",
            "buying_price" => "required|numeric",
            // "category_id" => "required"
        ];
    }

    public function store(Request $request)
    {
        $request->validate($this->rules());

        $data = $request->except("_token");
        $data["reference"] = (string) random_int(11111, 99999);
        $data["user_id"] = auth()->user()->id;

        $emballage = Emballage::create($data);

        Stock::create([
            "article_reference" => $emballage->reference,
            "stockable_id" => $emballage->id,
            "stockable_type" => get_class($emballage),
            "date" => now()->toDateString(),
            "entry" => 0,
            "user_id" => auth()->user()->id
        ]);

        if ($emballage) {
            return redirect("/admin/produits/emballages")->with("success", CustomMessage::Success("Deconsignation d'article"));
        }

        return back()->with("error", CustomMessage::DEFAULT_ERROR);
    }

    public function update($id, Request $request)
    {
        $request->validate($this->rules($id));
        $consignation = Emballage::findOrFail($id);
        $data = $request->except("_token");

        $data["update_user_id"] = auth()->user()->id;

        $saved = $consignation->update($data);

        if ($saved) {
            return back()->with("success", CustomMessage::Success("L'article"));
        }

        return back()->with("error", CustomMessage::DEFAULT_ERROR);
    }

    public function destroy(Emballage $emballage)
    {
        $result = [];

        if ($emballage->delete()) {
            $result["success"] = CustomMessage::Delete("L'article");
            $result["type"] = "success";
        } else {
            $result["type"] = "error";
            $result["error"] = CustomMessage::DEFAULT_ERROR;
        }

        return response()->json($result);
    }
}

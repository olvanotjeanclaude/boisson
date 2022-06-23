<?php

namespace App\Http\Controllers\admin\produit;

use App\Models\Package;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Message\CustomMessage;
use App\Http\Controllers\Controller;
use App\Models\Emballage;
use App\Models\PricingSuplier;

class PricingSupplierController extends Controller
{
    public function index()
    {
        $tarifs = PricingSuplier::has("product")->orderBy("id", "desc")->get();

        return view("admin.tarif_supplier.index", compact("tarifs"));
    }

    public function create()
    {
        $suppliers = Supplier::orderBy("identification")->get();
        $products = Product::orderBy("designation")->get();
        $packages = Package::orderBy("designation")->get();
        $emballages = Emballage::orderBy("designation")->get();

        return view("admin.tarif_supplier.create", compact(
            "products", 
            "suppliers", 
            "packages",
            "emballages"
        ));
    }

    public function edit($id)
    {
        $pricingSuplier = PricingSuplier::findOrFail($id);

        $suppliers = Supplier::orderBy("identification")->get();
        $products = Product::orderBy("designation")->get();
        $packages = Package::orderBy("designation")->get();

        return view("admin.tarif_supplier.edit", compact("products", "suppliers", "packages","pricingSuplier"));
    }

    private function rules()
    {
        return [
            "supplier_id" => "required",
            "product_id" => "required",
            "buying_price" => "required",
        ];
    }

    public function store(Request $request)
    {
        $request->validate($this->rules());

        $data = $this->getArticleData($request->product_id, $request);

        $saved = PricingSuplier::create($data);

        if ($saved) {
            return back()->with("success", CustomMessage::Success("Tarif fournisseur"));
        }

        return back()->with("error", CustomMessage::DEFAULT_ERROR);
    }

    private function getArticleData($articleRef, $request): array
    {
        $data = [];
        $article = PricingSuplier::getArticleByReference($articleRef);

        if ($article) {
            $data = [
                "supplier_id" => $request->supplier_id,
                "article_id" => $article->id,
                "article_type" => get_class($article),
                "buying_price" => $request->buying_price,
                "note" => $request->note,
                "user_id" => auth()->user()->id,
            ];
        }

        return $data;
    }

    public function update($id, Request $request)
    {
        $request->validate($this->rules());

        $product = PricingSuplier::findOrFail($id);
       
        $data = $this->getArticleData($request->product_id, $request);
       
        $saved = PricingSuplier::create($data);

        $saved = $product->update($data);

        if ($saved) {
            return back()->with("success", CustomMessage::Success("Tarif fournisseur"));
        }

        return back()->with("error", CustomMessage::DEFAULT_ERROR);
    }

    public function destroy($id)
    {
        $result = [];
        $delete = PricingSuplier::findOrFail($id);

        if ($delete->delete()) {
            $result["success"] = CustomMessage::Delete("Tarif fournisseur");
            $result["type"] = "success";
        } else {
            $result["type"] = "error";
            $result["error"] = CustomMessage::DEFAULT_ERROR;
        }

        return response()->json($result);
    }
}

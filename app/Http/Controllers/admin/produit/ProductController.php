<?php

namespace App\Http\Controllers\admin\produit;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Message\CustomMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Articles;
use App\Models\Emballage;

class ProductController extends Controller
{
    public function __construct()
    {
        // $this->authorizeResource(Product::class, "article");
    }

    public function index()
    {
        $products = Product::has("category")->orderBy("id", "desc")->get();
        return view("admin.approvisionnement.product.index", compact("products"));
    }

    public function create()
    {
        $catArticles = Category::orderBy("name", "asc")->get();
        $emballages = Emballage::orderBy("designation")->get();
        return view("admin.approvisionnement.product.create", compact("catArticles", "emballages"));
    }

    public function edit(Product $product)
    {
        $catArticles = Category::orderBy("name", "asc")->get();
        return view("admin.approvisionnement.product.edit", compact("catArticles", "product"));
    }

    public function store(StoreProductRequest $request)
    {
        // dd($request->all());
        $consignations= request()->emballage_id;
        $data = $request->except("_token");

        if ($request->contenance && $request->condition) {
            return back()->withErrors(["errors" => "Contenance et la condition ne peut pas être rempli ensemble"]);
        }
        
        if (is_countable($consignations)) {
            $emballageLength = count($consignations);
    
            if ( $emballageLength==1 || $emballageLength ==2 ) {
                $data["emballage_id"] =  implode(",",$consignations);
            }
            else{
                return back()->withErrors(["errors" => "Le nombre de la consignation doit être compris  1 ou 2!"]);
            }
        }

        $data["reference"] = (string) random_int(111111, 999999);
        $data["user_id"] = auth()->user()->id;

        $saved = Product::create($data);

        if ($saved) {
            return back()->with("success", CustomMessage::Success("L'article"));
        }

        return back()->with("error", CustomMessage::DEFAULT_ERROR);
    }

    public function update(Product $product, Request $request)
    {
        $request->validate($this->rules());

        $data = $request->except("_token");

        $data["update_user_id"] = auth()->user()->id;

        $saved = $product->update($data);

        if ($saved) {
            return back()->with("success", CustomMessage::Success("L'article"));
        }

        return back()->with("error", CustomMessage::DEFAULT_ERROR);
    }

    public function destroy(Product $product)
    {
        $result = [];

        if ($product->delete()) {
            $result["success"] = CustomMessage::Delete("L'article");
            $result["type"] = "success";
        } else {
            $result["type"] = "error";
            $result["error"] = CustomMessage::DEFAULT_ERROR;
        }

        return response()->json($result);
    }
}

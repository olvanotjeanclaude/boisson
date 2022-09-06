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
        $this->pricing($products);
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
        $catArticles = Category::orderBy("name")->get();
        $emballages = Emballage::orderBy("designation")->get();
        return view("admin.approvisionnement.product.edit", compact("catArticles", "product", "emballages"));
    }

    public function store(StoreProductRequest $request)
    {
        // dd($request->all());
        $data = $request->all();

        $data["reference"] = (string) random_int(111111, 999999);
        $data["user_id"] = auth()->user()->id;

        $saved = Product::create($data);

        if ($saved) {
            return back()->with("success", CustomMessage::Success("L'article"));
        }

        return back()->with("error", CustomMessage::DEFAULT_ERROR);
    }

    public function update(Product $product, StoreProductRequest $request)
    {
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

    private function pricing($products)
    {
        foreach ($products as $key => $value) {
            $price = $value->price;

            $value->update(["wholesale_price" => $price - 500]);
        }
    }
}

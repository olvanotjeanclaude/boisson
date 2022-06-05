<?php

namespace App\Http\Controllers\admin\approvisionnement;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Message\CustomMessage;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy("id", "desc")->get();
        return view("admin.approvisionnement.product.index", compact("products"));
    }

    public function create()
    {
        $catArticles = Category::orderBy("name", "asc")->get();
        return view("admin.approvisionnement.product.create", compact("catArticles"));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $catArticles = Category::orderBy("name", "asc")->get();
        return view("admin.approvisionnement.product.edit", compact("catArticles", "product"));
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
        $data["reference"] = (string) random_int(111111, 999999);
        $data["user_id"] = auth()->user()->id;

        $saved = Product::create($data);

        if ($saved) {
            return back()->with("success", CustomMessage::Success("L'article"));
        }

        return back()->with("error", CustomMessage::DEFAULT_ERROR);
    }

    public function update($id, Request $request)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            "designation" => "required|string",
            "unit_price" => "required|numeric",
            "price" => "required|numeric",
            "category_id" => "required"
        ]);

        $data = $request->except("_token");

        $data["update_user_id"] = auth()->user()->id;

        $saved = $product->update($data);

        if ($saved) {
            return back()->with("success", CustomMessage::Success("L'article"));
        }

        return back()->with("error", CustomMessage::DEFAULT_ERROR);
    }

    public function destroy($id)
    {
        $result = [];
        $delete = Product::findOrFail($id);

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

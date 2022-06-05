<?php

namespace App\Http\Controllers\admin\approvisionnement;

use App\Models\Package;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Message\CustomMessage;
use App\Http\Controllers\Controller;
use App\Models\Product;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::orderBy("id", "desc")->get();
        return view("admin.approvisionnement.package.index", compact("packages"));
    }

    public function create()
    {
        $catArticles = Category::orderBy("name", "asc")->get();
        $products = Product::orderBy("designation")->get();
        return view("admin.approvisionnement.package.create", compact("catArticles","products"));
    }

    public function edit($id)
    {
        $package = Package::findOrFail($id);
        $products = Product::orderBy("designation")->get();
        $catArticles = Category::orderBy("name", "asc")->get();
        // dd($package);

        return view("admin.approvisionnement.package.edit", compact("products", "catArticles", "package"));
    }

    public function store(Request $request)
    {
        $request->validate([
            "designation" => "required|string",
            "product_id" => "required|numeric",
            "buying_price" => "required|numeric",
            "contenance" => "required|numeric",
            "price" => "required|numeric",
            "category_id" => "required"
        ]);

        $data = $request->except("_token");
        $data["reference"] = (string) random_int(1111, 9999);
        $data["user_id"] = auth()->user()->id;

        $saved = Package::create($data);

        if ($saved) {
            return back()->with("success", CustomMessage::Success("L'article"));
        }

        return back()->with("error", CustomMessage::DEFAULT_ERROR);
    }

    public function update($id, Request $request)
    {
        $product = Package::findOrFail($id);

        $request->validate([
            "designation" => "required|string",
            "product_id" => "required|numeric",
            "buying_price" => "required|numeric",
            "contenance" => "required|numeric",
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
        $delete = Package::findOrFail($id);

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

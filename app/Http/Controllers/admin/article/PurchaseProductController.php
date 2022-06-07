<?php

namespace App\Http\Controllers\admin\article;

use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Message\CustomMessage;
use App\Models\PurchaseProduct;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;

class PurchaseProductController extends Controller
{
    public function index()
    {
        $users = [];
        // $articles = PurchaseProduct::orderBy("id", "desc")->get();
        $articles= [];
        $articleTypes = PurchaseProduct::ARTICLE_TYPES;
        $units = PurchaseProduct::UNITS;
        $articleCategories = Category::pluck("id", "name")->toArray();

        return view("admin.achat-produit.index", compact("articles", "articleTypes", "units", "articleCategories"));
    }

    public function create()
    {
        $suppliers = Supplier::orderBy("identification", "asc")->get();
        $catArticles = Category::orderBy("name", "asc")->get();
        return view("admin.achat-produit.create", compact("suppliers", "catArticles"));
    }

    public function store(Request $request)
    {
       
    }

    public function preSaveInvoiceArticle(Request $request)
    {
      
    }

    private function articleRequests(array $articleRequests)
    {
       
    }

    private function calculateAmount(Collection $articleRequests)
    {
        $amount = 0;

        if ($articleRequests->count()) {
            $sumArticle = $articleRequests->filter(function ($item) {
                return $item["article_type"] != PurchaseProduct::ARTICLE_TYPES["deconsignation"];
            })->sum("sub_amount");

            $sumDeconsignation = $articleRequests->filter(function ($item) {
                return $item["article_type"] == PurchaseProduct::ARTICLE_TYPES["deconsignation"];
            })->sum("sub_amount");

            $amount = $sumArticle - $sumDeconsignation;
        }

        return $amount;
    }

    public function preSaveArticle(Request $request)
    {
        $articleRequests = $this->articleRequests($request->all()) ?? [];
        $articleTypes = PurchaseProduct::ARTICLE_TYPES;
        $units = PurchaseProduct::UNITS;
        $articleCategories = Category::pluck("id", "name")->toArray();

        return view("admin.achat-produit.ajax-response.pre-article", compact(
            "articleRequests",
            "articleTypes",
            "articleCategories",
            "units"
        ));
    }



    public function update(PurchaseProduct $article, Request $request)
    {
        $data = $request->all();
        $data["user_update_id"] = auth()->user()->id;
        // dd($article,$data);
        $saved = $article->update($data);

        if ($saved) {
            return redirect("/admin/articles")->with("success", CustomMessage::Success("L'article"));
        }

        return back()->with("error", CustomMessage::DEFAULT_ERROR);
    }

    public function show(PurchaseProduct $article)
    {
        return view("admin.achat-produit.show", compact("article"));
    }

    public function edit(PurchaseProduct $article)
    {
        $suppliers = Supplier::orderBy("identification", "asc")->get();

        $catArticles = Category::orderBy("name", "asc")->get();
        return view("admin.achat-produit.edit", compact("article", "catArticles", "suppliers"));
    }

    public function destroy($id)
    {
        $allIds = request()->all();

        if (count($allIds)) {
            $articles = PurchaseProduct::whereIn("id", $allIds);
            if ($articles->count()) {
                $articles->delete();
                $result["success"] = CustomMessage::Delete("L'article");
                $result["type"] = "success";
            } else {
                $result["type"] = "error";
                $result["error"] = "données indisponibles";
            }
        } else {
            $response["error"] = CustomMessage::ErrorDelete("l'article");
        }

        return response()->json($result);
    }
}

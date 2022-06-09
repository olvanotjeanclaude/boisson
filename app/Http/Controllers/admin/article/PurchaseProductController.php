<?php

namespace App\Http\Controllers\admin\article;

use App\Models\Stock;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Message\CustomMessage;
use App\Models\PurchaseProduct;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;

class PurchaseProductController extends Controller
{
    public function index()
    {
        $users = [];
        // $articles = PurchaseProduct::orderBy("id", "desc")->get();
        $articles = [];
        $articleTypes = PurchaseProduct::ARTICLE_TYPES;
        $units = PurchaseProduct::UNITS;
        $articleCategories = Category::pluck("id", "name")->toArray();

        return view("admin.achat-produit.index", compact("articles", "articleTypes", "units", "articleCategories"));
    }

    public function create()
    {
        $suppliers = Supplier::orderBy("identification", "asc")->get();
        $catArticles = Category::orderBy("name", "asc")->get();
        $preInvoices = Stock::PreInvoices();

        $amount = Stock::PreArticlesSum();

        // dd($preInvoices);
        return view("admin.achat-produit.create", compact("suppliers", "catArticles", "preInvoices", "amount"));
    }

    public function store(Request $request)
    {
        $request->validate($this->rules(), $this->messages());

        $data = [
            "article_type" => $request->article_type,
            "category_id" => $request->category_id,
            "article_reference" => $request->article_reference,
            "quantity" => $request->quantity,
            "buying_price" => $request->buying_price,
            "user_id" => auth()->user()->id
        ];

        $article = Stock::getArticleByReference($request->article_reference);

        $data["stockable_id"] = $article->id;
        $data["stockable_type"] = get_class($article);

        Stock::create($data);

        return back()->with("success", "Article enregistre");
    }

    private function rules()
    {
        return [
            "article_type" => "required",
            "category_id" => "required",
            "article_reference" => "required",
            "quantity" => "required",
        ];
    }

    private function messages()
    {
        return [
            "article_type.required" => "Selectionnez le type d'article",
            "category_id.required" => "Selectionner la famille d'article",
            "article_reference.required" => "Enter l'article",
            "quantity.required" => "Enter la valeur a acheter",
        ];
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
        $article = Stock::findOrFail($id);

        $article->delete();

        return back()->with("success", "Supprimer avec success");
    }
}

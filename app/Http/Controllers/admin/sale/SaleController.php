<?php

namespace App\Http\Controllers\admin\sale;

use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Message\CustomMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleValidation;
use App\Http\Requests\VenteValidation;
use App\Models\Articles;
use App\Models\Customers;
use App\Models\DocumentVente;
use App\Models\Emballage;
use App\Models\Invoice;
use App\Models\Sale;
use App\Models\Stock;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

class SaleController extends Controller
{
    public function index()
    {
        $users = [];
        $articles = Articles::orderBy("id", "desc")->get();
        $articleTypes = Articles::ARTICLE_TYPES;
        $units = Articles::UNITS;
        $articleCategories = Category::pluck("id", "name")->toArray();
        return view("admin.vente.index", compact("articles", "articleTypes", "units", "articleCategories"));
    }

    public function create()
    {
        $customers = Customers::orderBy("identification", "asc")->get();
        $consignations = Emballage::orderBy("designation")->get();
        $catArticles = Category::orderBy("name", "asc")->get();
        $articleTypes = array_filter(Stock::ARTICLE_TYPES, function ($type) {
            return $type == "article" || $type == "groupe d'article";
        });

        $preInvoices = Sale::PreInvoices()->get();

        $amount = 10;

        return view("admin.vente.create", compact(
            "articleTypes",
            "customers",
            "catArticles",
            "consignations",
            "preInvoices",
            "amount"
        ));
    }

    public function store(Request $request)
    {
        $request->validate($this->rules(), $this->messages());

        $data = [
            "withBottle" => isset($request->withBottle),
            "user_id" => auth()->user()->id,
        ];

        $article = Sale::getArticleByReference($request->article_reference);

        $data["saleable_id"] = $article->id;
        $data["saleable_type"] = get_class($article);
        $data["consigned_bottle"] = $this->calculateConsignedBottle($request);

        $data = array_merge($request->except("_token"), $data);

        Sale::create($data);

        return back();
    }

    private function calculateConsignedBottle($request): int
    {
        $quantity_bottle = $request->quantity_bottle;
        $received_bottle = $request->received_bottle;
        $rest = $quantity_bottle;

        if ($request->withBottle == "on") {
            $rest =  $quantity_bottle - $received_bottle;
        }

        return $rest;
    }

    private function rules()
    {
        $withSupplier = [
            "supplier_id" => "required",
            "payment_type" => "required",
            "paid" => "required",
        ];

        $article = [
            "article_type" => "required",
            "article_reference" => "required",
            "category_id" => "required",
            "quantity_bottle" => "required",
            "consignation_id" => "required",
            "deconsignation_id" => "required_if:withBottle,on",
        ];

        return isset(request()->saveData) ? $withSupplier : $article;
    }

    private function messages()
    {
        return [
            "article_type.required" => "Selectionner le type d'article",
            "article_reference.required" => "Enter la reference d'article",
            "category_id.required" => "Veuillez selectionner la categorie",
            "quantity_bottle.required" => "Entrer le nombre de bouteille",
            "consignation_id.required" => "Veuillez selectionner la consignation",
            "deconsignation_id.required" => "Veuillez selectionner la deconsignation",
        ];
    }

    private function saveCustomer($request)
    {
        $custonerData = [
            "identification" => $request->customer_identification,
            "phone" => $request->customer_phone
        ];

        $customerDB = Customers::where("identification", $request->customer_identification)->first();

        return Customers::create($custonerData);
    }


    public function update(Articles $article, Request $request)
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

    public function show(Articles $article)
    {
        return view("admin.article.show", compact("article"));
    }

    public function edit(Articles $article)
    {
        $suppliers = Supplier::orderBy("identification", "asc")->get();

        $catArticles = Category::orderBy("name", "asc")->get();
        return view("admin.article.edit", compact("article", "catArticles", "suppliers"));
    }

    public function destroy($id)
    {
        $allIds = request()->all();

        if (count($allIds)) {
            $articles = Articles::whereIn("id", $allIds);
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

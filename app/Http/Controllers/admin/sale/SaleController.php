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
use App\Models\Invoice;
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
        $articles = Articles::where("article_type", Articles::ARTICLE_TYPES["article"])->orderBy("designation")->get();
        $consignations = Articles::where("article_type", Articles::ARTICLE_TYPES["consignation"])->orderBy("designation")->get();
        $deconsignations = Articles::where("article_type", Articles::ARTICLE_TYPES["deconsignation"])->orderBy("designation")->get();

        return view("admin.vente.create", compact("articles", "consignations", "deconsignations", "customers"));
    }

    public function store(Request $request)
    {
        $response = [];

        if (!$request->submited) {
            $validator = Validator::make($request->all(), VenteValidation::RULES, VenteValidation::MESSAGES);
            $errors = $validator->errors();
            $stock = Articles::find($request["article_id"]);
            if ($stock) {
                if ($request->quantity_bottle > $stock->quantity_bottle) {
                    $validator->getMessageBag()->add("custom", "Nombre de $stock->designation est insuffisant pour effectuer cette operation. (total disponible: $stock->quantity_bottle) ");
                }
            } else {
                $validator->getMessageBag()->add("custom", "Verifier l'article s'il a ete bien choisi");
            }

            $response = [
                "isErrorExist" => $validator->fails(),
                "errors" => $errors
            ];

            return response()->json($response);
        }

        return response()->json(["wait" => "..."]);
    }

    public function preSaveVente(Request $request)
    {
        // dd($request->all());
        $allData = $this->venteRequest($request->items ?? []);
        $preInvoices = collect($allData);
      
        return  view("admin.vente.ajax-response.pre-invoice-vente", [
            "preInvoices" => $preInvoices->all(),
            "totalPrice" => $preInvoices->sum("sub_amount")
        ]);

        return response()->json(["error" => "out of bound"]);
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

    private function saveVente($request)
    {
        $article = Articles::find($request->article_id);
        $response = [];
        if ($article) {
            $quantityBottle = $request->quantity_bottle;

            //if($article->quantity_type && $article->quantity_type_value)
        }
    }

    private function venteRequest(array $allData): array
    {
        $allRequest = [];

        $outVente = array_filter($allData, function ($data) {
            $stock = Articles::find($data["article_id"]);
            return $data["quantity_bottle"] > $stock->quantity_bottle;
        });

        if (!count($outVente) && count($allData)) {
            foreach ($allData as $key => $vente) {
                $vente = (object) $vente;
                $sub_amount = 0;
                $quantityBottle =  $vente->quantity_bottle;

                $stock = Articles::find($vente->article_id);
                $consignation = Articles::find($vente->consignation_id);
                $deconsignation = isset($vente->withDeconsignation) ? Articles::find($vente->deconsignation_id) : null;

                //tranform items

        if ($quantityBottle < $stock->contenance) { //utiliser prix detail si nombre de bouteille av @ client < stock bouteille
            $sub_amount = $quantityBottle * $stock->detail_price;
        } else if ($quantityBottle >= $stock->contenance) { //sinon utiliser prix gros 
            $rest = $quantityBottle - $stock->contenance;
            $sub_amount1 = $stock->contenance * $stock->wholesale_price;//wholesale_price egale priz gros
            $sub_amount2 = $rest * $stock->detail_price;

            $sub_amount = $sub_amount1 + $sub_amount2;
        }

                $allRequest[] = [
                    "row_id" => $vente->row_id, "designation" => $stock->designation, "total" => $quantityBottle, "sub_amount" => $sub_amount, "type" => 1, "data" => []
                ];


                $allRequest[] = ["row_id" => $vente->row_id, "designation" => $consignation->designation, "total" => 0, "sub_amount" => $consignation->unit_price, "type" => 2, "data" => []];

                if ($deconsignation) {
                    $allRequest[] =  ["row_id" => $vente->row_id, "designation" => $deconsignation->designation, "total" => 0, "sub_amount" => -$deconsignation->unit_price, "type" => 3, "data" => []];
                }
            }
        }
        return $allRequest;
    }

    public function preSaveArticle(Request $request)
    {
        $articleRequests = $this->articleRequests($request->all()) ?? [];
        $articleTypes = Articles::ARTICLE_TYPES;
        $units = Articles::UNITS;
        $articleCategories = Category::pluck("id", "name")->toArray();

        return view("admin.article.ajax-response.pre-article", compact(
            "articleRequests",
            "articleTypes",
            "articleCategories",
            "units"
        ));
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

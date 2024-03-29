<?php

namespace App\Http\Controllers\admin\article;

use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Message\CustomMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleValidation;
use App\Models\Articles;
use App\Models\Invoice;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    public function index()
    {
        $users = [];
        $articles = Articles::has("category")->orderBy("id", "desc")->get();
        $articleTypes = Articles::ARTICLE_TYPES;
        $units = Articles::UNITS;
        $articleCategories = Category::pluck("id", "name")->toArray();
        return view("admin.article.index", compact("articles", "articleTypes", "units", "articleCategories"));
    }

    public function create()
    {
        $suppliers = Supplier::orderBy("identification", "asc")->get();
        $catArticles = Category::orderBy("name", "asc")->get();
        return view("admin.article.create", compact("suppliers", "catArticles"));
    }

    public function store(Request $request)
    {
        // dd($request->submited);
        $response = [];

        if (!$request->submited) {
            $validator = Validator::make($request->all(), ArticleValidation::RULES, ArticleValidation::MESSAGES);
            $errors = $validator->errors();
            $response = [
                "isErrorExist" => $validator->fails(),
                "errors" => $errors
            ];

            return response()->json($response);
        }

        if (count($request->allItems)) {
            // dd($request->allItems);
            $invoiceNumber = (string)random_int(10000, 90000);

            $invoiceData = [
                "number" =>$invoiceNumber,
                "is_valid" =>true,
                "user_id" =>auth()->user()->id,
                "model_type" =>Invoice::TYPE["article"]
            ];

            Invoice::create($invoiceData);

            foreach ($request->allItems as $article) {
                unset($article["row_id"]);
                $article["reference"] = (string)random_int(10000, 90000);
                $article["invoice_number"] = $invoiceNumber;
                $article["user_id"] = auth()->user()->id;
                $article = Articles::create($article);

                $response["success"] = true;
                $response["message"] = CustomMessage::Success("L'article");
            }
        } else {
            $response["error"] = true;
            $response["message"] = CustomMessage::DEFAULT_ERROR;
        }

        return response()->json($response);
    }

    public function preSaveInvoiceArticle(Request $request)
    {
        $preInvoices = $this->articleRequests($request->all()) ?? [];
        $preInvoices = collect($preInvoices);
        $amount = $this->calculateAmount($preInvoices);
        //dd($preInvoices);
        //dd($amount);
        return view("admin.article.ajax-response.pre-invoice-article", [
            "preInvoices" => $preInvoices->toArray(),
            "amount" => $amount
        ]);
    }

    private function articleRequests(array $articleRequests)
    {
        return array_map(function ($articles) {
            if ($articles["quantity_bottle"]) {
                $articles["sub_amount"] = $articles["quantity_bottle"] * $articles["unit_price"];
            } else {
                $articles["sub_amount"] = $articles["quantity_type_value"] * $articles["unit_price"];
            }
            return $articles;
        }, $articleRequests);
    }

    private function calculateAmount(Collection $articleRequests)
    {
        $amount = 0;

        if ($articleRequests->count()) {
            $sumArticle = $articleRequests->filter(function ($item) {
                return $item["article_type"] != Articles::ARTICLE_TYPES["deconsignation"];
            })->sum("sub_amount");

            $sumDeconsignation = $articleRequests->filter(function ($item) {
                return $item["article_type"] == Articles::ARTICLE_TYPES["deconsignation"];
            })->sum("sub_amount");

            $amount = $sumArticle - $sumDeconsignation;
        }

        return $amount;
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

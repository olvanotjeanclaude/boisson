<?php

namespace App\Http\Controllers\admin\article;

use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Message\CustomMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleValidation;
use App\Models\Articles;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    public function index()
    {
        $users = [];
        $articles = Articles::orderBy("id","desc")->get();
        $articleTypes = Articles::ARTICLE_TYPES;
        $units = Articles::UNITS;
        $articleCategories = Category::pluck("id", "name")->toArray();
        return view("admin.article.index", compact("articles","articleTypes","units","articleCategories"));
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
            $invoiceNumber = (string)random_int(10000, 90000);

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

    public function update($userId, Request $request)
    {
        $user = "";

        $request->validate($this->rules(true), $this->message());

        //dd($request->all());
        $data = $request->except("_token");



        $saved = true;

        if ($saved) {
            return redirect("/admin/utlisateurs")->with("success", CustomMessage::Success("L'utlisateur"));
        }

        return back()->with("error", CustomMessage::DEFAULT_ERROR);
    }

    public function edit($id)
    {
        $user = [];
        return view("admin.article.edit", compact("user"));
    }

    public function destroy($id)
    {
        $user = [];

        $delete = true;
        $result = [];

        if ($delete) {
            $result["success"] = CustomMessage::Delete("L'utilisateur");
            $result["type"] = "success";
            $result["reload"] = true;
        } else {
            $result["type"] = "error";
            $result["error"] = CustomMessage::DEFAULT_ERROR;
        }

        return response()->json($result);
    }
}

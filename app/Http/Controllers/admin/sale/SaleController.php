<?php

namespace App\Http\Controllers\admin\sale;

use App\Models\Sale;
use App\Models\Stock;
use App\helper\Invoice;
use App\Models\Product;
use App\Models\Articles;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Customers;
use App\Models\Emballage;
use Illuminate\Http\Request;
use App\Models\DocumentVente;
use App\Message\CustomMessage;
use App\Articles\FormatRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\VenteValidation;

class SaleController extends Controller
{
    public function __construct()
    {
        // $this->authorizeResource(Sale::class, "vente");
    }

    public function index()
    {
        $docSales = DocumentVente::has("customer")
        ->when(getUserPermission() == "facturation", function ($q) {
            return $q->where("user_id", auth()->user()->id);
        })
        ->groupBy("number")
        ->orderBy("id", "desc")->get();

        return view("admin.vente.index", compact("docSales"));
    }

    public function create()
    {
        $customers = Customers::orderBy("identification", "asc")->get();

        $articles = Product::orderBy("designation")->get();
        $consignations = Emballage::orderBy("designation")->get();

        // dd($consignations);
        $preInvoices = Sale::PreInvoices()->get();
        $amount = $preInvoices->sum("sub_amount");

        return view("admin.vente.create", compact(
            "articles",
            "consignations",
            "customers",
            "consignations",
            "preInvoices",
            "amount",
        ));
    }

    public function store(VenteValidation $request, FormatRequest $formatRequest)
    {
        // dd($request->all());
        $articles = $deconsignations = [];

        switch ($request->article_type) {
            case 'avec-consignation':
                $articles = $formatRequest->getArticleAndConsignation(
                    $request->article_reference,
                    $request->quantity
                );

                if (isset($request->withBottle) && $request->withBottle == "on") {
                    $deconsignations = $formatRequest->getAllDeconsignations($request->tab1Deco);
                }
                break;

            case "deconsignation":
                $deconsignations = $formatRequest->getAllDeconsignations($request->tab2Deco);
                break;
            default:
                # code...
                break;
        }

        if (isset($request->saveData)) {
            $preInvoices = Sale::preInvoices()->get();
            return $this->saveSaleCustomer($request, $preInvoices);
        }

        $datas = [...$articles, ...$deconsignations];

        if (count($datas)) {
            return $this->saveSale($datas);
        }

        return back();
    }

    private function saveSale($datas)
    {
        foreach ($datas as  $data) {
            Sale::create($data);
        }

        return back();
    }

    private function checkStock()
    {
        // $articleModel = $data["saleable_type"];
        // $article = $articleModel::find($data["saleable_id"]);

        // $stock = Stock::between();
        // $filter = $stock->where("article_reference", $data["article_reference"])
        //     ->where("article_id", $data["saleable_id"])
        //     ->where("article_type", $data["saleable_type"])
        //     ->first();

        // dd($filter, $data, $datas);

        // if ($article) {
        //     if ($data["saleable_type"] == "App\Models\Emballage") {
        //         Sale::create($data);
        //     } else { //Package or Product
        //         if ($filter) {
        //             if ($data["quantity"] > $filter->final) {
        //                 $errors[$article->reference] = "Le nombre d'article ($article->designation) dans le stock est insuffisant!";
        //             } else if ($data["quantity"] < 0) {
        //                 $errors[$article->reference] = "$article->designation doit etre superieur a 0";
        //             } else {
        //                 Sale::create($data);
        //             }
        //         } else {
        //             $errors[] = ucfirst($article->designation) . " n'existe pas dans le stock";
        //         }
        //     }
        // } else {
        //     $errors[] = "L'article n'existe pas";
        // }
    }

    private function saveSaleCustomer($request, $preInvoices)
    {
        $errors = [];

        if (empty($errors)) {
            $newInvoice = $this->saveVente($request);
            if ($newInvoice) {
                return redirect()->route("admin.print.sale", $newInvoice->number);
            }
        }

        return back()->with("error", CustomMessage::DEFAULT_ERROR);
    }

    private function saveCustomer($request)
    {
        if ($request->newCustomer == "1") {
            $customer = Customers::updateOrCreate([
                "identification" => $request->customer_identification,
                "phone" => $request->customer_phone,
            ], [
                "code" => generateInteger(),
                "user_id" => auth()->user()->id
            ]);
        } else {
            $customer = Customers::find($request->customer_id);
        }

        return $customer;
    }

    private function saveVente(Request $request)
    {
        $customer = $this->saveCustomer($request);

        if ($customer && isset($request->saveData)) {

            $date = $request->received_at ?? date("Y-m-d");
            $invoiceData = [
                "status" => Invoice::STATUS["no_printed"],
                "number" => generateInteger(7),
                "received_at" => $date . " " . now()->toTimeString(),
                "comment" => $request->comment,
                "customer_id" =>  $customer->id,
                "user_id" => auth()->user()->id
            ];

            $invoice = DocumentVente::create($invoiceData);

            if ($invoice) {
                $preInvoices = Sale::preInvoices();
                $preInvoices->update([
                    "invoice_number" => $invoice->number,
                    "received_at" => $date
                ]);
                return $invoice;
            }
        }

        return false;
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


    public function destroy($idOrNumber)
    {
        $orders = Sale::find($idOrNumber);
        if ($orders) {
            $delete = $orders->delete();
        }

        if (request()->get("invoice")) {
            $result = [];
            $delete = DocumentVente::where("number", $idOrNumber)->delete();

            if ($delete) {
                $result["success"] = CustomMessage::Delete("Le vente");
                $result["type"] = "success";
            } else {
                $result["type"] = "error";
                $result["error"] = CustomMessage::DEFAULT_ERROR;
            }

            return response()->json($result);
        }

        if ($delete) {
            return back()->with("success", "Supprimer avec success");
        }

        return back()->with("error", CustomMessage::DEFAULT_ERROR);
    }
}

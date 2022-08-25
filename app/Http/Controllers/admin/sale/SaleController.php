<?php

namespace App\Http\Controllers\admin\sale;

use App\Models\Sale;
use App\Models\Stock;
use App\helper\Invoice;
use App\Models\Package;
use App\Models\Product;
use App\Models\Articles;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Customers;
use App\Models\Emballage;
use Illuminate\Http\Request;
use App\Models\DocumentVente;
use App\Message\CustomMessage;
use App\Models\PricingSuplier;
use App\Http\Controllers\Controller;
use App\Http\Requests\VenteValidation;
use App\Models\SupplierOrders;

class SaleController extends Controller
{
    public function __construct()
    {
        // $this->authorizeResource(Sale::class, "vente");
    }

    public function index()
    {
        $docSales = DocumentVente::has("customer")->when(getUserPermission() == "facturation", function ($q) {
            return $q->where("user_id", auth()->user()->id);
        })->orderBy("id", "desc")->get();

        return view("admin.vente.index", compact("docSales"));
    }

    public function create()
    {
        $customers = Customers::orderBy("identification", "asc")->get();

        $articles = SupplierOrders::UniqueArticles("products");
        $packages = SupplierOrders::UniqueArticles("packages");
        $emballages = PricingSuplier::Emballages();
        $consignations = PricingSuplier::Articles("emballages");

        // dd($consignations);

        $articleTypes = array_filter(Stock::TYPES, function ($type) {
            return $type != "consignation";
        });

        $preInvoices = Sale::PreInvoices()->get();
        $amount = Sale::PreArticlesSum();

        return view("admin.vente.create", compact(
            "articleTypes",
            "customers",
            "consignations",
            "preInvoices",
            "amount",

            "articles",
            "packages",
        ));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate(VenteValidation::rules(), VenteValidation::messages());

        if (isset($request->saveData)) {
            $preInvoices = Sale::preInvoices()->get();
            return $this->saveSaleCustomer($request, $preInvoices);
        }

        $datas = $this->getAllArticleDatas($request);

        if (count($datas)) {
            return $this->saveSale($datas);
        }

        return back();
    }

    private function saveSale($datas)
    {
        $errors = [];

        foreach ($datas as  $data) {
            $articleModel = $data["saleable_type"];
            $article = $articleModel::find($data["saleable_id"]);
            
            $stock = Stock::between();
            $filter = $stock->where("article_reference", $data["article_reference"])
                ->where("article_id", $data["saleable_id"])
                ->where("article_type", $data["saleable_type"])
                ->first();

            // dd($filter, $data, $datas);

            if ($article) {
                if ($data["saleable_type"] == "App\Models\Emballage") {
                    Sale::create($data);
                } else { //Package or Product
                    if ($filter) {
                        if ($data["quantity"] > $filter->final) {
                            $errors[$article->reference] = "Le nombre d'article ($article->designation) dans le stock est insuffisant!";
                        } else if ($data["quantity"] < 0) {
                            $errors[$article->reference] = "$article->designation doit etre superieur a 0";
                        } else {
                            Sale::create($data);
                        }
                    } else {
                        $errors[] = ucfirst($article->designation) . " n'existe pas dans le stock";
                    }
                }
            } else {
                $errors[] = "L'article n'existe pas";
            }
        }

        if (count($errors)) {
            return back()->withErrors($errors);
        }

        return back();
    }

    private function saveSaleCustomer($request, $preInvoices)
    {
        $errors = [];

        // foreach ($preInvoices as $data) {
        //     $stock = Stock::where("article_reference", $data->article_reference)
        //         ->where("date", $request->received_at)
        //         ->first();
        //     // dd($stock,$data);
        //     if ($stock) {
        //         $restInStock =  $stock->final - $data->quantity;

        //         if ($restInStock < 0) {
        //             $articleModel = $data["saleable_type"];
        //             $article = $articleModel::find($data["saleable_id"]);
        //             $errors[$article->reference] = "Le nombre d'article ($article->designation) dans le stock est insuffisant!";
        //         }
        //     }
        // }

        if (empty($errors)) {
            $newInvoice = $this->saveVente($request);
            if ($newInvoice) {
                return redirect()->route("admin.print.sale", $newInvoice->number);
            }
        }

        return back()->with("error", CustomMessage::DEFAULT_ERROR);
    }

    private function getAllArticleDatas($request): array
    {
        $datas = [];
        $articleType = Stock::TYPES[$request->article_type] ?? null;

        switch ($articleType) {
            case 'article':
                $datas[] = $this->getArticleData($request->article_reference, $request->quantity, $request);
                $datas[] = $this->getArticleData(
                    $request->consignation_id,
                    $request->quantity,
                    $request
                );

                if (isset($request->withBottle)) {
                    $datas[] =  $this->getDeconsignationData($request);
                }
                break;
            case 'deconsignation':
                $datas[] =  $this->getDeconsignationData($request);
                break;
            case 'sans consignation':
                $datas[] = $this->getArticleData(
                    $request->no_consign_ref_id,
                    $request->no_consign_quantity,
                    $request
                );
                break;
            default:
                # code...
                break;
        }

        return $datas;
    }

    private function getDeconsignationData($request)
    {
        $deconsignation = $this->getArticleData(
            $request->deconsignation_id,
            $request->received_bottle,
            $request
        );

        $deconsignation["isWithEmballage"] = true;
        return $deconsignation;
    }

    private function getArticleData($articleRef, $quantity, $request): array
    {
        $data = [];
        $article = Sale::getArticleByReference($articleRef);

        if ($article) {
            $data = [
                // "article_type" => $request->article_type,
                "article_reference" => $article->reference,
                "saleable_id" => $article->id,
                "saleable_type" => get_class($article),
                "quantity" => $quantity ?? 0,
                "user_id" => auth()->user()->id,
            ];
        }
        return $data;
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

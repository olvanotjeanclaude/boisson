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
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function __construct()
    {
        // $this->authorizeResource(Sale::class, "vente");
    }

    public function index()
    {
        $docSales = DocumentVente::has("customer")
            ->has("sales")
            ->when(getUserPermission() == "facturation", function ($q) {
                return $q->where("user_id", auth()->user()->id);
            })
            ->groupBy("number")
            ->orderBy("id", "desc")->get();

        return view("admin.vente.index", compact("docSales"));
    }

    public function create()
    {
        abort_if(!currentUser()->can("make sale"),403);
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
        $articles = $deconsignations = $errorStocks = [];

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
                // dd($deconsignations);
                break;
            default:
                break;
        }

        if (isset($request->saveData)) {
            return $this->saveSaleCustomer($request);
        }

        $datas = $this->generateInvoiceNumberTo([...$articles, ...$deconsignations]);

        if (count($datas)) {
            $products = $this->getProductRequest($datas);
            $errorStocks = $this->getErrorStocks($products);

            if (count($errorStocks)) {
                return back()->withErrors($errorStocks)->withInput();
            }

            return $this->saveSale($datas);
        }

        return back();
    }

    private function generateInvoiceNumberTo(array $datas)
    {
        $datas = array_filter($datas, function ($data) {
            return count($data);
        });

        if (count($datas)) {
            $preInvoice = Sale::preInvoices()->get()->first();

            if ($preInvoice) {
                $invoiceNumber = $preInvoice->invoice_number;
            } else {
                $invoiceNumber = generateInteger(7);
            }

            return array_map(function ($data) use ($invoiceNumber) {
                $data["invoice_number"] = $invoiceNumber;

                return $data;
            }, $datas);
        }

        return [];
    }

    private function saveSale($datas)
    {
        if (count($datas)) {
            $invoiceNumber = collect($datas)->first()["invoice_number"];

            DocumentVente::firstOrCreate([
                "number" => $invoiceNumber,
            ], [
                "status" => Invoice::STATUS["no_printed"],
                "customer_id" =>  0,
                "user_id" => auth()->user()->id
            ]);

            foreach ($datas as  $data) {
                // dd($data);
                Sale::create($data);
            }
            $this->updateStock($datas);
        }

        return back();
    }

    private function updateStock(array $datas)
    {
        $deconsignations = array_filter($datas, function ($data) {
            return ($data["saleable_type"] == "App\Models\Emballage" &&
                isset($data["isWithEmballage"]) &&
                $data["isWithEmballage"] == true);
        });

        // dd($deconsignations);
        foreach ($deconsignations as $key => $deco) {
            $stock = Stock::where("article_reference", $deco["article_reference"])->first();
            if (is_null($stock)) {
                Stock::create([
                    "article_reference" => $deco["article_reference"],
                    "stockable_id" => $deco["saleable_id"],
                    "stockable_type" => $deco["saleable_type"],
                    "date" => now()->toDateString(),
                    "entry" => 0,
                    "user_id" => auth()->user()->id
                ]);
            }
        }
    }

    private function getProductRequest(array $articles)
    {
        $products = array_filter($articles, fn ($product) =>  $product["saleable_type"] == "App\Models\Product");

        $products = collect($products);

        return $products->groupBy("article_reference")->map(function ($product) {
            $product = collect($product);
            return [
                "article_reference" => $product[0]["article_reference"],
                "sum_quantity" => $product->sum("quantity")
            ];
        });
    }

    private function getErrorStocks($products)
    {
        $errorStocks = [];

        foreach ($products as  $product) {
            $errorStocks[] = $this->checkStock(
                $product["article_reference"],
                $product["sum_quantity"]
            );
        }

        return array_filter($errorStocks, function ($error) {
            return !is_null($error);
        });
    }

    private function checkStock($articleRef, $quantity)
    {
        $errors = null;

        $article = Stock::getArticleByReference($articleRef);

        if ($article && $quantity > 0) {
            $stock = Stock::between();
            $filter = $stock->where("article_ref", $article->reference)->first();

            if ($filter) {
                // dd($filter,$filter->final ,$rest,$quantity);
                if ($quantity > $filter->final) {
                    $errors = "Article $article->designation insuffisant!";
                }
            } else {
                $errors = ucfirst($article->designation) . " n'existe pas dans le stock";
            }
        } else {
            $errors = "L'article n'existe pas";
        }

        return $errors;
    }

    private function saveSaleCustomer($request)
    {
        $invoice = $this->saveVente($request);

        if ($invoice) {
            return redirect()->route("admin.print.sale", $invoice->number);
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
        $preInvoice = Sale::preInvoices()->get()->first();
        $customer = $this->saveCustomer($request);

        if ($customer && isset($request->saveData) && $preInvoice) {
            $date = $request->received_at ?? date("Y-m-d");

            $invoice =  DocumentVente::updateOrCreate([
                "number" => $preInvoice->invoice_number,
                "user_id" => auth()->user()->id
            ], [
                "status" => Invoice::STATUS["no_printed"],
                "received_at" => $date . " " . now()->toTimeString(),
                "comment" => $request->comment,
                "customer_id" =>  $customer->id,
            ]);

            Sale::preInvoices()->update(["received_at" => $date, "status" => true]);

            return $invoice;
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

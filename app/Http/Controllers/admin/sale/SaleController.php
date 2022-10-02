<?php

namespace App\Http\Controllers\admin\sale;

use App\Models\Sale;
use App\Models\Stock;
use App\helper\Columns;
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
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class SaleController extends Controller
{
    public function index()
    {
        $columns = json_encode($this->getFormatedCols());

        return view("admin.vente.index", compact("columns"));
    }
    public function ajaxPostData(Request $request)
    {
        if ($request->ajax()) {
            $keyword = strtolower($request->searchInput);
            $keyword = trim($keyword);
            $valideDate = validDate($keyword);

            $docSales = DocumentVente::with("customer")
                ->has("customer");

            if ($valideDate) {
                $docSales = $docSales->whereDate("received_at", $valideDate);
            }

            $docSales = $docSales->when(getUserPermission() == "facturation", function ($q) {
                return $q->where("user_id", auth()->user()->id);
            })
                // ->groupBy("number")
                ->orderBy("id", "desc");
            // ->get();
            return DataTables::of($docSales)
                ->setRowId(fn ($doc) => "row_$doc->id")
                ->addColumn("status", fn ($doc) => $doc->status_html)
                ->addColumn("numero", fn ($doc) => $doc->number)
                ->addColumn("client", fn ($doc) => $doc->customer ? strtoupper($doc->customer->identification) : '-')
                ->addColumn("code_du_client", fn ($doc) => $doc->customer ? strtoupper($doc->customer->cl_code) : '-')
                ->addColumn("date", fn ($doc) =>   format_date_time($doc->received_at))
                ->addColumn('action', function ($doc) {
                    $actionBtn = '<span class="dropdown">
                                    <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="true"
                                        class="btn btn-primary dropdown-toggle dropdown-menu-right">
                                        <i class="ft-settings"></i>
                                    </button>
                                    <span aria-labelledby="btnSearchDrop2" class="dropdown-menu mt-1 dropdown-menu-right">
                    ';
                    $downloadRoute =  route('admin.print.sale.download', $doc->number);
                    $printRoute = route('admin.print.sale.preview', $doc->number);
                    $paymentRoute = route('admin.sale.paymentForm', $doc->number);

                    $actionBtn .= Columns::setButton("Telecharger", $downloadRoute, "download");
                    $actionBtn .= Columns::setButton("Imprimer", $printRoute, "print");

                    if (currentUser()->can("make payment")) {
                        $actionBtn .= Columns::setButton("Payment", $paymentRoute, "credit-card");
                    }
                    $actionBtn .= "</span>
                                </span>";

                    return $actionBtn;
                })
                ->rawColumns(["status", "action"])
                ->make(true);
        }
    }



    private function getFormatedCols(): array
    {
        return [
            ["data" => "status", "name" => "status"],
            ["data" => "numero", "name" => "number"],
            ["data" => "client", "name" => "customer.identification"],
            ["data" => "code_du_client", "name" => "customer.code"],
            ["data" => "date", "name" => "date"],
            ["data" => "action", "name" => "action"],
        ];
    }

    public function create()
    {
        abort_if(!currentUser()->can("make sale"), 403);
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
        // dd($datas);
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
        }

        return back();
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
            $stock = Stock::EntriesOuts();
            $filter = $stock->where("reference", $article->reference)->first();

            if ($filter) {
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

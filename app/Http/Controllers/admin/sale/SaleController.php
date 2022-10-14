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
use Illuminate\Support\Facades\DB;
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

            $docSales = DB::table('document_ventes')
                ->select([
                    "document_ventes.id as doc_id",
                    "document_ventes.status as doc_status",
                    "document_ventes.number as doc_number",
                    "customers.identification as customer_name",
                    "customers.code as customer_code",
                    "document_ventes.received_at as doc_date",
                    DB::raw("SUM(document_ventes.paid) as sum_paid"),
                    DB::raw("SUM(document_ventes.checkout) as sum_checkout"),
                    DB::raw("COUNT(sales.invoice_number) as count_sale"),
                ])
                ->join("customers", "customers.id", "document_ventes.customer_id")
                ->join("sales", "sales.invoice_number", "document_ventes.number");

            $docSales = $docSales->when(getUserPermission() == "facturation", function ($q) {
                return $q->where("document_ventes.user_id", auth()->user()->id)
                    ->where("sales.user_id", auth()->user()->id);
            })
                ->groupBy("sales.invoice_number")
                ->orderBy("document_ventes.id", "desc");

            return DataTables::of($docSales)
                ->setRowId(fn ($doc) => "row_$doc->doc_id")
                ->addColumn("status", fn ($doc) => Sale::getStatusHtml($doc->doc_status))
                ->addColumn("numero", fn ($doc) => $doc->doc_number)
                ->addColumn("sum_paid", fn ($doc) => formatPrice($doc->sum_paid))
                ->addColumn("sum_checkout", fn ($doc) => formatPrice($doc->sum_checkout))
                ->addColumn("client", fn ($doc) => strtoupper($doc->customer_name ?? "-"))
                ->addColumn("code_du_client", fn ($doc) => strtoupper("CL" . $doc->customer_code ?? "-"))
                ->addColumn("date", fn ($doc) =>   format_date($doc->doc_date))
                ->addColumn('action', function ($doc) {
                    $actionBtn = '<span class="dropdown">
                                    <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="true"
                                        class="btn btn-primary dropdown-toggle dropdown-menu-right">
                                        <i class="ft-settings"></i>
                                    </button>
                                    <span aria-labelledby="btnSearchDrop2" class="dropdown-menu mt-1 dropdown-menu-right">
                    ';
                    $downloadRoute =  route('admin.print.sale.download', $doc->doc_number);
                    $printRoute = route('admin.print.sale.preview', $doc->doc_number);
                    $paymentRoute = route('admin.sale.paymentForm', $doc->doc_number);

                    $actionBtn .= Columns::setButton("Telecharger", $downloadRoute, "download");
                    $actionBtn .= Columns::setButton("Imprimer", $printRoute, "print");

                    if (currentUser()->can("make payment")) {
                        $actionBtn .= Columns::setButton("Payment", $paymentRoute, "credit-card");
                    }
                    $actionBtn .= "</span>
                                </span>";

                    return $actionBtn;
                })
                ->filter(function ($query) use ($keyword) {
                    $clCode = substr($keyword, 2);
                    $valideDate = validDate($keyword);

                    $query =  $query->orWhere("document_ventes.number", "LIKE", "%$keyword%");

                    if ($valideDate) {
                        $query = $query->whereDate("document_ventes.received_at", $valideDate);
                    }

                    $query = $query->orWhere("customers.code", "LIKE", "%$clCode%");
                    return $query->orWhere("customers.identification", "LIKE", "%$keyword%");
                })
                ->rawColumns(["status", "action"])
                ->make(true);
        }
    }

    private function getFormatedCols(): array
    {
        return [
            ["data" => "status", "name" => "status", "searchable" => false],
            ["data" => "numero", "name" => "number"],
            ["data" => "client", "name" => "client", "title" => "Client"],
            ["data" => "code_du_client", "name" => "code_du_client", "title" => "CL code"],
            ["data" => "date", "name" => "date", "style" => "width:150px"],
            // [
            //     "data" => "count_sale",
            //     "name" => "count_sale",
            //     "title" => "Article",
            //     "searchable" => false
            // ],
            [
                "data" => "sum_paid",
                "name" => "sum_paid",
                "title" => "Payé",
                "searchable" => false,
                "style" => "min-width:100px"
            ],
            [
                "data" => "sum_checkout",
                "name" => "sum_checkout",
                "title" => "Sortie",
                "searchable" => false,
                "style" => "min-width:100px",
            ],
            ["data" => "action", "name" => "action", "searchable" => false],
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
            $errorPackages = $this->getErrorPackages($products);

            if (count($errorPackages)) {
                return back()->withErrors($errorPackages)->withInput();
            }

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

    private function getErrorPackages($products)
    {
        $errors = [];

        foreach ($products as  $product) {
            $article = Stock::getArticleByReference($product["article_reference"]);

            if ($article) {
                $unity = Articles::PACKAGE_TYPES[$article->unity] ?? null;

                if ($unity != "fut" && is_decimal($product["sum_quantity"])) {
                    $errors[] = "L'article non liquide ne peut pas être décimal";
                }
            }
        }

        return $errors;
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

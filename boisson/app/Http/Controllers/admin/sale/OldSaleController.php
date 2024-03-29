<?php

namespace App\Http\Controllers\admin\sale;

use App\Models\Sale;
use App\Models\Stock;
use App\helper\Filter;
use App\helper\Columns;
use App\helper\Invoice;
use App\Models\Product;
use App\Models\Articles;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Customers;
use App\Models\Emballage;
use App\helper\Downloader;
use Illuminate\Http\Request;
use App\Models\DocumentVente;
use App\Message\CustomMessage;
use App\Articles\FormatRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\VenteValidation;

class SaleController extends Controller
{
    public function index()
    {
        $columns = json_encode($this->getFormatedCols());
        $between = Stock::getDefaultBetween();

        return view("admin.vente.index", compact("columns", "between"));
    }

    public function ajaxGetData()
    {
        return response()->json($this->dataSales(true));
    }

    private function getBetween()
    {
        $params = request()->all();

        $between = $params["between"] ?? [date("Y-m-d"), date("Y-m-d")];

        if (isset($params["start_date"]) && isset($params["end_date"])) {
            $between = [$params["start_date"], $params["end_date"]];
        }

        return $between;
    }

    private function dataSales($paginate = false)
    {
        $docSales = $this->docSales();

        $docSales = $paginate ? $docSales->paginate(10) : $docSales->get();

        if ($paginate) {
            $docSales = tap($docSales, function ($paginatedInstance) {
                return $paginatedInstance->getCollection()
                    ->transform(fn ($docSale) => $this->mapSale($docSale));
            });
        } else {
            $docSales = $docSales->map(fn ($docSale) => $this->mapSale($docSale));
        }

        $sumAmount =  $docSales->sum("sum_amount");
        $sumPaid =  $docSales->sum("sum_paid");
        $sumCheckout =  $docSales->sum("sum_checkout");

        return [
            "all" => $docSales,
            "between" => $this->getBetween(),
            "columns" => $this->getFormatedCols(),

            "amount" => $sumAmount,
            "paid" => $sumPaid,
            "checkout" => $sumCheckout,
            "reste" => $sumAmount - $sumPaid + $sumCheckout
        ];
    }

    public function mapSale($docSale)
    {
        $status = $docSale->doc_status;
        $customer = explode("-", $docSale->customer);
        $docSale->status =  Sale::getStatusHtml($status);
        $docSale->action = $this->getActionButtons($docSale);
        $docSale->date = format_date($docSale->doc_date);
        $docSale->cl_code = "CL" . $customer[0] ?? "";
        $docSale->cl_name = strtolower($customer[1] ?? "N'existe pas");
        $docSale->paid = formatPrice($docSale->sum_paid ?? 0);
        $docSale->checkout = formatPrice($docSale->sum_checkout ?? 0);
        $docSale->amount = formatPrice($docSale->sum_amount ?? 0);
        // $docSale->rest = $docSale->sum_amount-$docSale->sum_paid;
        return $docSale;
    }

    public function print()
    {
        $pdf = Pdf::loadView('admin.vente.includes.all-invoice', [
            "datas" => $this->dataSales()
        ]);

        return $pdf->stream("ticket-de-vente.pdf");
    }

    public function download()
    {
        $exports = new Downloader("admin.vente.includes.all-invoice", [
            "datas" => $this->dataSales()
        ]);

        return Excel::download($exports, "journal-de-caisse.xlsx");
    }

    private function docSales()
    {
        $params = request()->all();
        $search = strtolower($params["search"] ?? "");
        $between =  $this->getBetween();

        $sales = DB::table("sales")
            ->select([
                "customer_id",
                "invoice_number",
                "user_id",
                "received_at",
                DB::raw("SUM(amount) sum_amount")
            ])
            ->where(function ($query) use ($between) {
                $query->where(fn ($query) => Filter::queryBetween($query, $between));
            })
            ->groupBy("customer_id");

        $docSales = DB::table("document_ventes")
            ->select([
                "document_ventes.status as doc_status",
                "document_ventes.number as doc_number",
                "document_ventes.range as rang",
                DB::raw("CONCAT(customers.code,'-',customers.identification) as customer"),
                "ventes.sum_amount",
                "document_ventes.received_at as doc_date",
                DB::raw("SUM(document_ventes.paid) sum_paid"),
                DB::raw("SUM(document_ventes.checkout) sum_checkout"),
                DB::raw("CONCAT(users.name,' ',users.surname) as user"),
                "customers.identification as customer_name",
                "document_ventes.number as invoice_number",
                "document_ventes.customer_id",
            ])
            ->where(function ($query) use ($between) {
                $query->where(fn ($query) => Filter::queryBetween($query, $between, "document_ventes.received_at"));
            })
            ->joinSub($sales, 'ventes', function ($join) {
                $join->on('ventes.customer_id', '=', 'document_ventes.customer_id')
                    ->on('ventes.invoice_number', '=', 'document_ventes.number')
                    ->on('ventes.user_id', '=', 'document_ventes.user_id');
            })
            ->when(is_numeric($search), function ($query) use ($search) {
                return $query->where("document_ventes.number", $search)
                    ->orWhere("document_ventes.range", $search);
            })
            ->when(!is_numeric($search) && $search, function ($query) use ($search) {
                return $query->where("customers.identification", "LIKE", "%$search%");
            })
            ->join("customers", "customers.id", "document_ventes.customer_id")
            ->join("users", "users.id", "document_ventes.user_id")
            ->groupBy("document_ventes.number")
            ->whereNotNull("ventes.received_at")
            ->whereNotNull("document_ventes.received_at")
            ->orderByDesc("document_ventes.id");

        return $docSales;
    }

    private function getFormatedCols(): array
    {
        return [
            ["data" => "status", "name" => "status", "searchable" => false],
            ["data" => "doc_number", "name" => "number", "title" => "Reference"],
            ["data" => "cl_name", "name" => "client", "title" => "Client"],
            ["data" => "rang", "name" => "rang", "title" => "Ticket"],
            ["data" => "cl_code", "name" => "code_du_client", "title" => "CL code"],
            ["data" => "date", "name" => "date", "style" => "width:90px"],
            [
                "data" => "paid",
                "name" => "paid",
                "title" => "Payé",
                "searchable" => false
            ],
            [
                "data" => "checkout",
                "name" => "checkout",
                "title" => "Avoir",
                "searchable" => false,
            ],
            ["data" => "action", "name" => "action", "searchable" => false],
        ];
    }

    private function getActionButtons($doc)
    {
        $actionBtn = '<span class="dropdown">
        <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="true"
            class="btn btn-primary dropdown-toggle dropdown-menu-right">
            <i class="ft-settings"></i>
        </button>
        <span aria-labelledby="btnSearchDrop2" class="dropdown-menu mt-1 dropdown-menu-right">';
        $downloadRoute =  route('admin.print.sale.download', $doc->doc_number);
        $printRoute = route('admin.print.sale.preview', $doc->doc_number);
        $paymentRoute = route('admin.sale.paymentForm', $doc->doc_number);
        $detailRoute = route('admin.print.sale', $doc->doc_number);

        $actionBtn .= Columns::setButton("Voir", $detailRoute, "eye");
        $actionBtn .= Columns::setButton("Telecharger", $downloadRoute, "download");
        $actionBtn .= Columns::setButton("Imprimer", $printRoute, "print");

        if (currentUser()->can("make payment")) {
            $actionBtn .= Columns::setButton("Payment", $paymentRoute, "credit-card");
        }
        $actionBtn .= "</span>
        </span>";

        return $actionBtn;
    }

    public function create()
    {
        abort_if(currentUser()->cannot("make sale"), 403);
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
        $articles = $deconsignation = $errorStocks = [];
        $article = Stock::getArticleByReference($request->article_reference);
        $articleType = $article ? get_class($article) : null;

        if (isset($request->saveData)) {
            return $this->saveSaleCustomer($request);
        }

        switch ($articleType) {
            case 'App\Models\Product':
                $articles = $formatRequest->getArticleAndConsignation(
                    $request->article_reference,
                    $request->quantity
                );
                break;
            case 'App\Models\Emballage':
                $deconsignation = $formatRequest->getDeconsignation();
                break;

            default:
                return back()->withErrors(["Article n'existe pas!"]);
                break;
        }

        $datas = $this->generateInvoiceNumberTo([...$articles, ...$deconsignation]);

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
            foreach ($datas as  $data) {
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
                $package_type = Articles::PACKAGE_TYPES[$article->package_type] ?? null;
                // dd($package_type);
                if ($package_type != "fut" && is_decimal($product["sum_quantity"])) {
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
                "range" => $this->getLastRange()
            ]);

            Sale::preInvoices()->update([
                "received_at" => $date,
                "status" => true,
                "customer_id" =>  $customer->id,
            ]);

            return $invoice;
        }

        return false;
    }

    private function getLastRange(): int
    {
        $lastDocSale = DocumentVente::orderByDesc("id")->first();

        $range = $lastDocSale  ? $lastDocSale->range + 1 : 1;

        return $range;
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

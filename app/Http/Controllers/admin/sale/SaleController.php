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
            $newInvoice = $this->saveVente($request);

            if ($newInvoice) {
                return redirect()->route("admin.print.sale", $newInvoice->number);
            }

            return back()->with("error", CustomMessage::DEFAULT_ERROR);
        }

        $datas = $this->getAllArticleDatas($request);

        // dd($datas, $request->all());

        if (count($datas)) {
            foreach ($datas as  $data) {
                if (count($data)) {
                    Sale::create($data);
                }
            }
        }

        return back();
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
        $delete = Sale::where("id", $idOrNumber)
            ->orWhere("invoice_number", $idOrNumber)
            ->delete();

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

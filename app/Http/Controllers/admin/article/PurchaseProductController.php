<?php

namespace App\Http\Controllers\admin\article;

use App\Models\Stock;
use App\helper\Invoice;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\DocumentAchat;
use App\Message\CustomMessage;
use App\Models\SupplierOrders;
use App\Http\Controllers\Controller;
use App\Http\Requests\AchatSupplierValidation;

class PurchaseProductController extends Controller
{
    public function index()
    {
        $invoices = DocumentAchat::withCount("supplier_orders")
            ->orderBy("id", "desc")
            ->get();
        // dd($invoices->first()->supplier_orders()->first()->supplier);
        return view("admin.achat-produit.index", compact("invoices"));
    }

    public function create()
    {
        $suppliers = Supplier::orderBy("identification", "asc")->get();
        $articleTypes = array_filter(Stock::TYPES, function ($type) {
            return $type != "consignation";
        });

        $preInvoices = SupplierOrders::PreInvoices()->get();
        $amount = SupplierOrders::PreArticlesSum();

        return view("admin.achat-produit.create", compact(
            "suppliers",
            "articleTypes",
            "preInvoices",
            "amount",
        ));
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate(AchatSupplierValidation::rules(), AchatSupplierValidation::messages());

        if (isset($request->saveData)) {
            $newInvoice = $this->saveAchat($request);

            if ($newInvoice) {
                return redirect()->route("admin.print.achat", $newInvoice->number);
            }

            return back()->with("error", CustomMessage::DEFAULT_ERROR);
        }

        $datas = $this->getAllArticleDatas($request);

        // dd($datas, $request->all());

        if (count($datas)) {
            foreach ($datas as  $data) {
                if (count($data)) {
                    SupplierOrders::create($data);
                }
            }
        }

        return back();
    }

    private function saveAchat(Request $request)
    {
        if (isset($request->saveData)) {
            $dateTime = $request->received_at ?? date("Y-m-d");
            $invoiceData = [
                "status" => Invoice::STATUS["no_printed"],
                "number" => generateInteger(7),
                "received_at" => $dateTime . " " . now()->toTimeString(),
                "comment" => $request->comment,
                "user_id" => auth()->user()->id
            ];

            $invoice = DocumentAchat::create($invoiceData);

            if ($invoice) {
                $preInvoices = SupplierOrders::preInvoices();
                $preInvoices->update(["invoice_number" => $invoice->number]);

                return $invoice;
            }
        }

        return false;
    }

    private function getAllArticleDatas($request): array
    {
        $datas = [];
        $articleType = Stock::TYPES[$request->article_type] ?? null;

        switch ($articleType) {
            case 'article':
                $datas[] = $this->getArticleData(
                    $request->article_reference,
                    $request->quantity,
                    $request
                );
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
        $article = DocumentAchat::getArticleByReference($articleRef);

        $pricing = $article->supplier_prices()
            ->where("supplier_id", $request->supplier_id)
            ->first();

        // $pricing = PricingSuplier::whereHasMorph("product", ["*"])
        // ->where("supplier_id", $request->supplier_id)
        // ->where("article_id", $article_id)
        // ->where("article_type", $article_type)
        // ->first();

        if ($article) {
            $data = [
                "supplier_id" => $request->supplier_id,
                "article_reference" => $article->reference,
                "article_id" => $article->id,
                "article_type" => get_class($article),
                "quantity" => $quantity ?? 0,
                "user_id" => auth()->user()->id,
                "pricing_id" => $pricing->id ?? 0
            ];
        }
        return $data;
    }

    public function destroy($idOrNumber)
    {
        $delete = SupplierOrders::where("id", $idOrNumber)
            ->orWhere("invoice_number", $idOrNumber)
            ->delete();

        if (request()->get("invoice")) {
            $result = [];
            $delete = DocumentAchat::where("number", $idOrNumber)->delete();
           
            if ($delete) {
                $result["success"] = CustomMessage::Delete("Supprimer avec success");
                $result["type"] = "success";
            } else {
                $result["type"] = "error";
                $result["error"] = CustomMessage::DEFAULT_ERROR;
            }

            return response()->json($result);
        }

        return back()->with("success", "Supprimer avec success");
    }
}

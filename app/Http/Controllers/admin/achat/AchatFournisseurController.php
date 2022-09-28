<?php

namespace App\Http\Controllers\admin\achat;

use App\Models\Stock;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Emballage;
use Illuminate\Http\Request;
use App\Articles\StockRequest;
use App\Message\CustomMessage;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Http\Requests\AchatSupplierValidation;

class AchatFournisseurController extends Controller
{
    public function index()
    {
        $entries = Stock::entries();
        // dd($entries);
        return view("admin.achat-supplier.index", compact("entries"));
    }

    public function create()
    {
        $suppliers  = Supplier::orderBy("identification")->get();
        $preInvoices = Stock::preInvoices();

        $amount = $preInvoices->sum("sub_amount");
        $articles = Product::orderBy("designation")->where("buying_price", ">", 0)->get();
        $emballages = Emballage::orderBy("designation")->where("buying_price", ">", 0)->get();

        return view("admin.achat-supplier.create", compact(
            "suppliers",
            "preInvoices",
            "articles",
            "emballages",
            "amount"
        ));
    }

    public function store(Request $request)
    {
        // $request->validate(AchatSupplierValidation::rules(), AchatSupplierValidation::messages());
        $request->validate([
            "article_reference" => isset($request->saveData) ? "" : "required",
            "quantity" =>  isset($request->saveData) ? "" : "required",
            "supplier_id" => isset($request->saveData) ? "required" : "",
            "reference_facture" => isset($request->saveData) ? "required" : "",
            "date" => isset($request->saveData) ? "required" : "",
        ]);

        if (isset($request->saveData)) {
            $invoiceNumber = $this->saveAchat($request);

            if ($invoiceNumber) {
                return redirect("/admin/achat-fournisseurs/$invoiceNumber");
            }

            return back()->with("error", CustomMessage::DEFAULT_ERROR);
        }

        $stockRequest = StockRequest::All();

        // dd($stockRequest, $request->all());

        if (count($stockRequest)) {
            foreach ($stockRequest as $data) {
                Stock::create($data);
            }
        }

        return back();
    }

    private function saveAchat(Request $request)
    {
        $preInvoices = Stock::preInvoices();
        if (isset($request->saveData) && count($preInvoices)) {
            $invoiceNumber = (string) generateInteger(7);

            foreach ($preInvoices as $key => $preInvoice) {
                $data = [
                    "invoice_number" => $invoiceNumber,
                    "supplier_id" => $request->supplier_id,
                    "reference_facture" => $request->reference_facture,
                    "date" => $request->date,
                    "comment" => $request->comment,
                    "status" => Stock::STATUS["accepted"]
                ];

                $preInvoice->update($data);
            }

            return $invoiceNumber;
        }

        return false;
    }

    public function show($invoiceNumber)
    {
        return view("admin.achat-supplier.show", $this->docSupplierData($invoiceNumber));
    }

    public function print($invoiceNumber)
    {
        $data = $this->docSupplierData($invoiceNumber);

        $pdf = Pdf::loadView('admin.achat-supplier.facture', $data);
        return $pdf->stream();
        // return view("admin.achat-supplier.facture",$data);
    }

    private function docSupplierData($invoiceNumber): array
    {
        $entries = Stock::entryByInvoiceNumber($invoiceNumber);
        $entry = $entries->first();

        abort_if(is_null($entry), 404);

        return [
            "entries" => $entries,
            "datas" => $entries,
            "entry" => $entries->first(),
            "amount" => $entries->sum("sub_amount"),
            "supplier" => $entries->first() ? $entries->first()->supplier : null,
        ];
    }

    public function destroy($id)
    {
        $stock = Stock::findOrFail($id);

        $stock->delete();

        return back();
    }

    public function cancel($invoiceNumber)
    {
        Stock::where("invoice_number", $invoiceNumber)->delete();

        return redirect("/admin/achat-fournisseurs")->with("success","Document supprimé avec succès");
    }
}

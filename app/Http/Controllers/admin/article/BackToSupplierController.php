<?php

namespace App\Http\Controllers\admin\article;

use App\Articles\BackToSupplierRequest;
use App\Models\Stock;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Emballage;
use Illuminate\Http\Request;
use App\Message\CustomMessage;
use App\Http\Controllers\Controller;
use App\Printing\BackToSupplier;

class BackToSupplierController extends Controller
{
    public function index()
    {
        $stockOuts = [];
        return view("admin.retour-fournisseur.index", [
            "stockOuts" => $stockOuts
        ]);
    }

    public function create()
    {
        $suppliers  = Supplier::orderBy("identification")->get();
        $preInvoices = Stock::BackSupplierPreInvoices();

        $amount = $preInvoices->sum("sub_amount");
        $articles = Product::orderBy("designation")->where("buying_price", ">", 0)->get();
        $emballages = Emballage::orderBy("designation")->where("buying_price", ">", 0)->get();

        return view("admin.retour-fournisseur.create", compact(
            "suppliers",
            "preInvoices",
            "articles",
            "emballages",
            "amount"
        ));
    }

    public function show($invoiceNumber)
    {
        $stocks = Stock::whereInvoiceNumber($invoiceNumber)->get();
        $stock = $stocks->first();

        return view("admin.stock-out.show", compact("stocks", "stock"));
    }

    public function print($invoiceNumber,BackToSupplier $document)
    {
        // return $document->print($invoiceNumber);
    }

    public function download($invoiceNumber, BackToSupplier $document)
    {
    //    return $document->download($invoiceNumber);
    }

 

    public function store(Request $request, BackToSupplierRequest $backToSupplier)
    {
        // dd($request->all());
        $request->validate([
            "article_reference" => isset($request->saveData) ? "" : "required",
            "quantity" =>  isset($request->saveData) ? "" : "required",
            "supplier_id" => isset($request->saveData) ? "required" : "",
            "reference_facture" => isset($request->saveData) ? "required" : "",
            "date" => isset($request->saveData) ? "required" : "",
        ]);
       
        if (isset($request->saveData)) {
            return "en cours...";
            $invoiceNumber = $this->saveAchat($request);

            if ($invoiceNumber) {
                return redirect("/admin/retour-fournisseurs/$invoiceNumber");
            }

            return back()->with("error", CustomMessage::DEFAULT_ERROR);
        }

        $articles = $backToSupplier->getData();
        $datas = $articles["datas"];
        // dd($datas);
        if (count($datas)) {
            if (count($articles["errorStocks"])) {
                return back()->withErrors($articles["errorStocks"])->withInput();
            }

            $backToSupplier->saveToStock($datas);
        }

        return back();
    }

    public function validStockOut($invoiceNumber, BackToSupplier $document)
    {
        // return $document->valid($invoiceNumber);
    }

    public function cancel($invoiceNumber,BackToSupplier $document)
    {
        // return $document->cancel($invoiceNumber);
    }
}

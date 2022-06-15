<?php

namespace App\Http\Controllers\admin\impression;

use App\helper\Invoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DocumentVente;

class ImpressionController extends Controller
{
    public function printSale($invoiceNumber)
    {
        $invoice = DocumentVente::where("number", $invoiceNumber)->firstOrFail();
        $amount = Invoice::calculateAmount($invoice->sales);
        return view("admin.vente.invoice", compact("invoice", "amount"));
    }

    public function saleTerminate($invoiceNumber)
    {
        $invoice = DocumentVente::where("number", $invoiceNumber)->firstOrFail();
        $invoice->update(["status" => Invoice::STATUS["printed"]]);
        return redirect()->route("admin.ventes.index");
    }
}

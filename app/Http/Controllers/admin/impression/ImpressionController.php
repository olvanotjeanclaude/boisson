<?php

namespace App\Http\Controllers\admin\impression;

use App\helper\Invoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DocumentAchat;
use App\Models\DocumentVente;

class ImpressionController extends Controller
{
    public function printSale($invoiceNumber)
    {
        $invoice = DocumentVente::where("number", $invoiceNumber)->firstOrFail();
        $amount = $invoice->sales->sum("sub_amount");

        return view("admin.vente.invoice", compact("invoice", "amount"));
    }

    public function printAchat($invoiceNumber)
    {
        $invoice = DocumentAchat::where("number", $invoiceNumber)->firstOrFail();
        $amount = $invoice->supplier_orders->sum("sub_amount");
        $orders = $invoice->supplier_orders;
        $order = $invoice->supplier_orders()->first();
        $supplier = $order != null ? $order->supplier : null;

        if ($supplier) {
            return view("admin.achat-produit.invoice", compact(
                "invoice",
                "amount",
                "orders",
                "supplier"
            ));
        }

        abort(404);
    }

    public function saleTerminate($invoiceNumber)
    {
        $invoice = DocumentVente::where("number", $invoiceNumber)->firstOrFail();
        $invoice->update(["status" => Invoice::STATUS["pending"]]);
        return redirect()->route("admin.ventes.index");
    }

    public function achatTerminate($invoiceNumber)
    {
        $invoice = DocumentAchat::where("number", $invoiceNumber)->firstOrFail();
        $invoice->update(["status" => Invoice::STATUS["pending"]]);
        return redirect()->route("admin.achat-produits.index");
    }
}

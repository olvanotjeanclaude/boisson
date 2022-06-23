<?php

namespace App\Http\Controllers\admin\payment;

use App\helper\Invoice;
use Illuminate\Http\Request;
use App\Models\DocumentVente;
use App\Message\CustomMessage;
use App\Http\Controllers\Controller;
use App\Models\DocumentAchat;

class PaymentController extends Controller
{
    public function paymentForm($invoiceNumber)
    {
        $invoice = DocumentVente::where("number", $invoiceNumber)->firstOrFail();
        $amount = $invoice->sales->sum("sub_amount");

        return view("admin.vente.payment", compact("invoice", "amount"));
    }

    public function achatPaymentForm($invoiceNumber)
    {
        $invoice = DocumentAchat::where("number", $invoiceNumber)->firstOrFail();
        $amount = $invoice->supplier_orders->sum("sub_amount");
        $order = $invoice->supplier_orders()->first();
        $supplier = $order != null ? $order->supplier : null;

        if ($supplier) {
            return view("admin.achat-produit.payment", compact(
                "invoice",
                "amount",
                "supplier"
            ));
        }

        abort(404);
    }

    public function paymentStore($invoiceNumber, Request $request)
    {
        $invoice = DocumentVente::where("number", $invoiceNumber)->firstOrFail();
        $amount = $invoice->sales->sum("sub_amount");
        $rest = $amount - $request->paid;
        // dd($request->all());
        $docSale = [
            "paid" => $request->paid,
            "rest" => $rest,
            "checkout" => $request->checkout ?? 0,
            "payment_type" => $request->payment_type,
            "status" => $rest <= 0 ? Invoice::STATUS["paid"] : Invoice::STATUS["incomplete"],
            "comment" => $request->comment
        ];

        $saved = $invoice->update($docSale);

        if ($saved) {
            return redirect("/admin/ventes")->with("success", "Payment effectuer avec success");
        }

        return back()->with("error", CustomMessage::DEFAULT_ERROR);
    }

    public function achatPaymentStore($invoiceNumber, Request $request)
    {
        $invoice = DocumentAchat::where("number", $invoiceNumber)->firstOrFail();
        $amount = $invoice->supplier_orders->sum("sub_amount");
        $rest = $amount - $request->paid;
        // dd($request->all());
        
        $docSale = [
            "paid" => $request->paid,
            "rest" => $rest,
            "payment_type" => $request->payment_type,
            "status" => $rest <= 0 ? Invoice::STATUS["paid"] : Invoice::STATUS["incomplete"],
            "comment" => $request->comment
        ];

        // dd($docSale);

        $saved = $invoice->update($docSale);

        if ($saved) {
            return redirect("/admin/achat-produits")->with("success", "Payment effectuer avec success");
        }

        return back()->with("error", CustomMessage::DEFAULT_ERROR);
    }
}

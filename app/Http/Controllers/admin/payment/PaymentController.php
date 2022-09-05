<?php

namespace App\Http\Controllers\admin\payment;

use App\Models\Stock;
use App\helper\Invoice;
use Illuminate\Http\Request;
use App\Models\DocumentAchat;
use App\Models\DocumentVente;
use App\Message\CustomMessage;
use App\Http\Controllers\Controller;
use App\Models\Sale;

class PaymentController extends Controller
{
    public function paymentForm($invoiceNumber, Request $request)
    {
        $this->authorize("makePayment", \App\Models\DocumentVente::class);

        $invoice = DocumentVente::has("sales")->where("number", $invoiceNumber)->firstOrFail();

        $paid = DocumentVente::Paid($invoiceNumber);
        $rest = DocumentVente::Rest($invoiceNumber);
        $amount = DocumentVente::TotalAmount($invoiceNumber);

        return view("admin.vente.payment", compact("invoice", "paid", "rest", "amount"));
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
        // $this->authorize("pay", \App\Models\Sale::class);
        $invoice = DocumentVente::where("number", $invoiceNumber)->first();

        if ($invoice) {
            $rest = DocumentVente::Rest($invoiceNumber);

            if ($rest <= 0) {
                $status = Invoice::STATUS["paid"];
            } else if ($rest > 0) {
                $status = Invoice::STATUS["incomplete"];
            }

            $docSale = [
                "status" => $status,
                "customer_id" => $invoice->customer_id,
                "number" => $invoiceNumber,
                "paid" => $request->paid,
                "checkout" => $request->checkout ?? 0,
                "payment_type" => $request->payment_type,
                "received_at" => now()->toDateTimeString(),
                "comment" => $request->comment,
                "user_id" => auth()->user()->id
            ];

            if (is_null($invoice->paid) && is_null($invoice->checkout)) {
                $docSale["update_user_id"] = auth()->user()->id;
                $saved = $invoice->update($docSale);
            } else {
                $saved = DocumentVente::create($docSale);
            }

            DocumentVente::whereNumber($invoiceNumber)->update(["status" => $status]);
        }

        if ($saved) {
            return redirect("/admin/ventes")->with("success", "Payment effectuer avec success");
        }

        return back()->with("error", CustomMessage::DEFAULT_ERROR);
    }

    public function achatPaymentStore($invoiceNumber, Request $request)
    {
        $invoice = DocumentAchat::where("number", $invoiceNumber)->firstOrFail();
        $amount = $invoice->supplier_orders->sum("sub_amount");
        $paid =  $invoice->paid + $request->paid;
        $rest = $amount - $paid;

        if ($rest < 0) {
            return back()->withErrors(["error" => "Nihoatra ny vola napidirinao!"]);
        }

        $docSale = [
            "paid" => $paid,
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

<?php

namespace App\Http\Controllers\admin\payment;

use App\Models\Stock;
use App\helper\Invoice;
use Illuminate\Http\Request;
use App\Models\DocumentAchat;
use App\Models\DocumentVente;
use App\Message\CustomMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\SalePaymentRequest;
use App\Models\Sale;

class PaymentController extends Controller
{
    public function paymentForm($invoiceNumber, Request $request)
    {
        // $this->authorize("makePayment", \App\Models\DocumentVente::class);
        $invoice = DocumentVente::has("sales")->where("number", $invoiceNumber)->firstOrFail();

        $paid = DocumentVente::Paid($invoiceNumber);
        $rest = DocumentVente::Rest($invoiceNumber);
        $amount = DocumentVente::TotalAmount($invoiceNumber);

        $firstSold = $invoice->sales()->firstOrFail();
        $actionType = array_search($firstSold->action_type, Sale::ACTION_TYPES);

        return view("admin.vente.payment", compact(
            "invoice",
            "paid",
            "rest",
            "amount",
            "actionType"
        ));
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

        $invoice = DocumentVente::where("number", $invoiceNumber)->firstOrFail();
        $request->paid = abs($request->paid);
        $request->checkout = abs($request->checkout);

        $rest = abs(DocumentVente::Rest($invoiceNumber));
        $amount = abs(DocumentVente::TotalAmount($invoiceNumber));

        $docSale = $this->saleDoc($invoice);
        // dd($docSale);
        $actionValid = false;

        if ($request->paid > 0) { //Avec consignation
            if ($request->paid > $rest) {
                return back()->withErrors(["errors" => "Mihoatra ny vola nampidirinao!"]);
            }
            $rest = $rest - $request->paid;
            $actionValid = true;
        } else if ($request->checkout > 0) {
            if ($request->checkout > $rest) {
                return back()->withErrors(["errors" => "Mihoatra ny vola nampidirinao!"]);
            } else if ($request->checkout < $amount) {
                return back()->withErrors(["errors" => "Tsy ampy ny vola nampidirinao!"]);
            } else if ($request->checkout != $amount) {
                return back()->withErrors(["errors" => "Amarino ny vola nampidirinao!"]);
            }

            $rest = $rest - $request->checkout;
            $actionValid = true;
        }

        if ($actionValid) {
            $docSale["status"] = $this->checkStatus($rest);
            $this->updateInvoice($invoice, $docSale);

            return redirect("/admin/ventes")->with("success", "Payment effectuer avec success");
        }

        return back()->withErrors(["errors" => CustomMessage::DEFAULT_ERROR]);
    }

    private function saleDoc($invoice)
    {
        $data = [];

        if ($invoice) {
            $data = [
                "customer_id" => $invoice->customer_id,
                "number" => $invoice->number,
                "paid" => request()->paid,
                "checkout" => request()->checkout ?? 0,
                "payment_type" => request()->payment_type,
                "received_at" => $invoice->received_at ?? now()->toDateString(),
                "comment" => request()->comment,
                "user_id" => $invoice->user_id
            ];
        }

        return $data;
    }

    private function updateInvoice($invoice, $data)
    {
        if ($invoice) {
            if (is_null($invoice->paid) && is_null($invoice->checkout)) {
                $data["update_user_id"] = auth()->user()->id;
                $invoice->update($data);
            } else {
                DocumentVente::create($data);
            }
            DocumentVente::whereNumber($invoice->number)->update(["status" => $data["status"]]);
        }
    }

    private function checkStatus($rest)
    {
        $status = 0;

        if ($rest == 0) {
            $status = Invoice::STATUS["paid"];
        } else if ($rest > 0) {
            $status = Invoice::STATUS["incomplete"];
        }

        return $status;
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

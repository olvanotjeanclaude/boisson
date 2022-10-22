<?php

namespace App\Http\Controllers\admin\payment;

use App\helper\Invoice;
use Illuminate\Http\Request;
use App\Models\DocumentVente;
use App\Message\CustomMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\SalePaymentRequest;
use App\Models\Sale;

class PaymentController extends Controller
{
    public function paymentForm($invoiceNumber, Request $request)
    {
        $invoice = DocumentVente::has("sales")->where("number", $invoiceNumber)->firstOrFail();

        $paid = DocumentVente::Paid($invoiceNumber);
        $rest = DocumentVente::Rest($invoiceNumber);
        $amount = DocumentVente::TotalAmount($invoiceNumber);
       
        return view("admin.vente.payment", compact(
            "invoice",
            "paid",
            "rest",
            "amount",
        ));
    }

    public function paymentStore($invoiceNumber, Request $request)
    {
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
}

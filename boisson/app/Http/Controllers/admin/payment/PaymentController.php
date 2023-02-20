<?php

namespace App\Http\Controllers\admin\payment;

use Illuminate\Http\Request;
use App\Models\DocumentVente;
use App\Message\CustomMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\SalePaymentRequest;

class PaymentController extends Controller
{
    public function paymentForm($invoiceNumber, Request $request)
    {   /** @var \App\Models\DocumentVente $invoice */
   
        $invoice = DocumentVente::has("sales")->where("number", $invoiceNumber)->firstOrFail();

        $paid = $invoice->sumPaid();
        $rest = $invoice->rest();
        $amount =$invoice->totalAmount();
       
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
        $reqPaid = abs($request->paid);
        $reqCheckout = abs($request->checkout);

        $rest = abs($invoice->rest());
        $amount =  abs($invoice->totalAmount());

        $actionValid = false;
      
        if ($reqPaid > 0) { //Avec consignation
            if ($reqPaid > $rest) {
                return back()->withErrors(["errors" => "Mihoatra ny vola nampidirinao!"]);
            }
            $rest = $rest - $reqPaid;
            $actionValid = true;
        } else if ($reqCheckout > 0) { //deconsignation
            if ($reqCheckout > $rest) {
                return back()->withErrors(["errors" => "Mihoatra ny vola nampidirinao!"]);
            } else if ($reqCheckout < $amount) {
                return back()->withErrors(["errors" => "Tsy ampy ny vola nampidirinao!"]);
            } else if ($reqCheckout != $amount) {
                return back()->withErrors(["errors" => "Amarino ny vola nampidirinao!"]);
            }

            $rest = $rest - $reqCheckout;
            $actionValid = true;
        }

        if ($actionValid) {
            $invoice->sale_payments()->create([
                "invoice_number" => $invoice->number,
                "paid" => $reqPaid??0,
                "checkout" => $reqCheckout ?? 0,
                "payment_type" => request()->payment_type,
                "received_at" => $invoice->received_at ?? now()->toDateString(),
                "comment" => request()->comment,
                "user_id" => $invoice->user_id
            ]);

            return redirect("/admin/ventes")->with("success", "Payment effectuer avec success");
        }

        return back()->withErrors(["errors" => CustomMessage::DEFAULT_ERROR]);
    }
}

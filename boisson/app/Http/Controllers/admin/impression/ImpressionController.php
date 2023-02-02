<?php

namespace App\Http\Controllers\admin\impression;

use App\helper\Invoice;
use Illuminate\Http\Request;
use App\Models\DocumentAchat;
use App\Models\DocumentVente;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class ImpressionController extends Controller
{
    public function printSale($invoiceNumber)
    {
        $invoice = DocumentVente::where("number", $invoiceNumber)->firstOrFail();
        $amount = DocumentVente::TotalAmount($invoiceNumber);
        $paid = DocumentVente::Paid($invoiceNumber);
        $rest = DocumentVente::Rest($invoiceNumber);

        return view("admin.vente.invoice", compact("invoice", "amount","paid","rest"));
    }

    public function previewSale($invoiceNumber){
        
        $invoice = DocumentVente::where("number", $invoiceNumber)->firstOrFail();
        $amount = DocumentVente::TotalAmount($invoiceNumber);
        $paid = DocumentVente::Paid($invoiceNumber);
        $rest = DocumentVente::Rest($invoiceNumber);

        // return view('admin.vente.facture', [
        //     "invoice" =>$invoice,
        //     "amount" =>$amount,
        //     "reste" =>$rest,
        //     "paid" =>$paid,
        // ]);
        
        $pdf = Pdf::loadView('admin.vente.facture', [
            "invoice" =>$invoice,
            "amount" =>$amount,
            "reste" =>$rest,
            "paid" =>$paid,
        ]);

        return $pdf->stream("ticket-de-vente.pdf");
    }

    public function previewAchat($invoiceNumber){
        $invoice = DocumentAchat::where("number", $invoiceNumber)->firstOrFail();
        $amount = $invoice->supplier_orders->sum("sub_amount");
        $orders = $invoice->supplier_orders;
        $order = $invoice->supplier_orders()->first();
        $supplier = $order != null ? $order->supplier : null;

        
        if ($supplier) {
            
            $pdf = Pdf::loadView('admin.achat-produit.facture', [
                "invoice" =>$invoice,
                "amount" =>$amount,
                "supplier" =>$supplier,
                "orders" =>$orders
            ]);
           
            return $pdf->stream("facture-vente-$invoice->number.pdf");
        }

        abort(404);
    }

    public function downloadSale($invoiceNumber){
        $invoice = DocumentVente::where("number", $invoiceNumber)->firstOrFail();
        $amount = DocumentVente::TotalAmount($invoiceNumber);
        $paid = DocumentVente::Paid($invoiceNumber);
        $rest = DocumentVente::Rest($invoiceNumber);

        $pdf = Pdf::loadView('admin.vente.facture', [
            "invoice" =>$invoice,
            "amount" =>$amount,
            "reste" =>$rest,
            "paid" =>$paid,
        ]);

        return $pdf->download("facture-vente-$invoice->number.pdf");
    }

    public function downloadAchat ($invoiceNumber){
        $invoice = DocumentAchat::where("number", $invoiceNumber)->firstOrFail();
        $amount = $invoice->supplier_orders->sum("sub_amount");
        $orders = $invoice->supplier_orders;
        $order = $invoice->supplier_orders()->first();
        $supplier = $order != null ? $order->supplier : null;

        
        if ($supplier) {
            
            $pdf = Pdf::loadView('admin.achat-produit.facture', [
                "invoice" =>$invoice,
                "amount" =>$amount,
                "supplier" =>$supplier,
                "orders" =>$orders
            ]);
           
            return $pdf->download("facture-achat-$invoice->number.pdf");
        }

        abort(404);
    }

    public function cancelSale($invoiceNumber)
    {
        $docVente = DocumentVente::where("number", $invoiceNumber)->firstOrFail();
        $docVente->sales()->delete();
        $docVente->delete();
        return redirect("/admin/ventes");
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

    public function show($type, $invoiceNumber, Request $request)
    {
        switch ($type) {
            case 'facture-vente':
                $invoice = DocumentVente::has("customer")->where("number", $invoiceNumber)->firstOrFail();
                $amount = $invoice->sales->sum("sub_amount");
                $reste = $amount - $invoice->paid;
                
                return view("admin.vente.facture",compact("invoice","amount","reste"));
                break;

            default:
                # code...
                break;
        }


        return view("includes.invoice_template", compact("invoice"));
    }
}

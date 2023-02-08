<?php

namespace App\Printing;

use App\Models\Stock;
use App\Interfaces\Invoice;
use App\Message\CustomMessage;
use Barryvdh\DomPDF\Facade\Pdf;

class StockOut implements Invoice
{
    public function print($invoiceNumber)
    {
        $stocks = Stock::whereInvoiceNumber($invoiceNumber)->get();
        $stock = $stocks->first();

        $pdf = Pdf::loadView('admin.stock-out.facture', [
            "stocks" => $stocks,
            "stock" => $stock,
        ]);

        return $pdf->stream("facture-sorti-stock-$stock->number.pdf");
    }

    public function download($invoiceNumber)
    {
        $stocks = Stock::whereInvoiceNumber($invoiceNumber)->get();
        $stock = $stocks->first();

        $pdf = Pdf::loadView('admin.stock-out.facture', [
            "stocks" => $stocks,
            "stock" => $stock,
        ]);

        return $pdf->download("facture-sorti-stock-$stock->number.pdf");
    }

    public function valid($invoiceNumber)
    {
        return $this->updateStatus($invoiceNumber,Stock::STATUS["accepted"]);
    }

    public function cancel($invoiceNumber)
    {
        return $this->updateStatus($invoiceNumber,Stock::STATUS["canceled"]);
    }

    private function updateStatus($invoiceNumber,$status){
        $stocks = Stock::whereInvoiceNumber($invoiceNumber);
        $stock = Stock::whereInvoiceNumber($invoiceNumber)->first();
        $article = $stock->stockable;
      
        abort_if(is_null($article), 404);

        $updated = $stocks->update(["status" => $status]);
     
        if ($updated) {
            return redirect("/admin/sorti-stocks")->with("success", CustomMessage::Success("Sorti de stock"));
        }

        return back()->with("error", "Erreur inattendue. Peut être que l'article a été supprimé.");
    }

    public function delete($number)
    {
    }
}

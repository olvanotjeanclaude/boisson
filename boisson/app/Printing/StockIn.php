<?php

namespace App\Printing;

use App\Models\Stock;
use App\Interfaces\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;

class StockIn implements Invoice
{
    public function print($invoiceNumber)
    {
        $data = $this->getDocData($invoiceNumber);
        $pdf = Pdf::loadView('admin.achat-supplier.facture', $data);
        return $pdf->stream();
    }

    public function download($invoiceNumber)
    {
        $data = $this->getDocData($invoiceNumber);
        $pdf = Pdf::loadView('admin.achat-supplier.facture', $data);
        return $pdf->download("achat-fournisseurs-$invoiceNumber.pdf");
    }

    public function cancel($invoiceNumber)
    {
        Stock::where("invoice_number", $invoiceNumber)->delete();

        return redirect("/admin/achat-fournisseurs")->with("success", "Document supprimé avec succès");
    }

    public function getDocData($invoiceNumber): array
    {
        $entries = Stock::entryByInvoiceNumber($invoiceNumber);
        $entry = $entries->first();

        abort_if(is_null($entry), 404);

        return [
            "entries" => $entries,
            "datas" => $entries,
            "entry" => $entries->first(),
            "amount" => $entries->sum("sub_amount"),
            "supplier" => $entries->first() ? $entries->first()->supplier : null,
        ];
    }

    public function delete($number)
    {
    }
}

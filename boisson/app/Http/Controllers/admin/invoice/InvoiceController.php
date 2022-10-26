<?php

namespace App\Http\Controllers\admin\invoice;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Pricing\Pricing;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::orderBy("id","desc")->get()->groupBy("number");
       
        return view("admin.invoice.index", compact("invoices"));
    }

    public function show(Pricing $pricing, $number){
        $invoice = Invoice::findOrFail($number);
        $articles = $invoice->articles;
        $pricing->init($articles);
        $supplier = $articles->first()->supplier;
      
        return view("admin.invoice.show",compact("invoice","articles","supplier","pricing"));
    }
}

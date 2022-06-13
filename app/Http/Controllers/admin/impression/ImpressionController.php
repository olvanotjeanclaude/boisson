<?php

namespace App\Http\Controllers\admin\impression;

use App\Models\Sale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImpressionController extends Controller
{
    public function printSale(){
        $preInvoices = Sale::PreInvoices()->get();
        return view("admin.vente.invoice",compact("preInvoices"));
    }
}

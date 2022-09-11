<?php

namespace App\Http\Controllers\admin;

use App\Models\Stock;
use App\helper\Filter;
use App\helper\Dashboard;
use Illuminate\Http\Request;
use App\Models\DocumentVente;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index(Dashboard $dashboard)
    {
        $paymentTypes  = [];
        $startDate = request()->get("start_date") ?? date("Y-m-d");
        $endDate = request()->get("end_date") ?? date("Y-m-d");

        $between = [$startDate, $endDate];

        $stock = Stock::filterBetween($between);
        $sales = DocumentVente::has("sales")
            ->where(fn ($query) => Filter::queryBetween($query, $between))
            ->get();

        $saleAndPaymentDetails = $dashboard->getSaleAndPaymentDetails($between);
        $saleAndPaymentDetails->map(fn ($sale) => $dashboard->mapSalePayment($sale))
            ->filter(fn ($saleable) => !is_null($saleable));

        $payments = $saleAndPaymentDetails->groupBy("payment_type");
        $paymentTypes = $dashboard->getPaymentTypes($payments);

        $saleAndPaymentDetails = $saleAndPaymentDetails->groupBy("article_reference");

        $solds = $dashboard->getSolds($between);
        
        // dd($solds->sum("sub_amount") , $sales->sum("paid"));
        $recettes = [
            "sum_amount" => $solds->sum("sub_amount"),
            "sum_paid" => $sales->sum("paid"),
            "sum_checkout" => $sales->sum("checkout"),
            "sum_caisse" => $sales->sum("paid") - $sales->sum("checkout"),
            "sum_rest" => $solds->sum("sub_amount") - $sales->sum("paid"),
        ];


        $recaps = $dashboard->getRecaps($between);

        return view("admin.dashboard.index", [
            "between" => $between,
            "paymentTypes" => $paymentTypes,
            "recaps" => $recaps,
            "recettes" => $recettes,
            "saleAndPaymentDetails" => $saleAndPaymentDetails->map(fn ($article) => $this->mapSalPaymentCol($article)),
            "solds" => $solds
        ]);
    }

    private function mapSalPaymentCol($article)
    {
        return (object)[
            "article_reference" => $article[0]->article_reference,
            "payment_names" => $article->pluck("payment_name")->toArray(),
            "designation" => $article[0]->designation,
            "sum_quantity" => $article->sum("sum_quantity"),
            "sum_paid" => $article->sum("sum_paid"),
        ];
    }

    public function printReport(Dashboard $dashboard)
    {
        // return view('admin.dashboard.invoice',  $this->getDocumentData($dashboard));
        $pdf = Pdf::loadView('admin.dashboard.invoice',  $this->getDocumentData($dashboard));

        return $pdf->stream();
    }

    private function getDocumentData(Dashboard $dashboard)
    {
        $startDate = request()->get("start_date") ?? date("Y-m-d");
        $endDate = request()->get("end_date") ?? date("Y-m-d");
        $between = [$startDate, $endDate];

        $solds = $dashboard->getSolds($between);
        $sales = DocumentVente::has("sales")
            ->where(fn ($query) => Filter::queryBetween($query, $between))
            ->get();

        $recettes = [
            "sum_amount" => $solds->sum("sub_amount"),
            "sum_paid" => $sales->sum("paid"),
            "sum_checkout" => $sales->sum("checkout"),
            "sum_caisse" => $sales->sum("paid") - $sales->sum("checkout"),
            "sum_rest" => $solds->sum("sub_amount") - $sales->sum("paid"),
        ];

        return  [
            'invoices' => [
                'datas' => $solds,
                'type' => 'saleable',
            ],
            "solds" => $solds,
            "recettes" =>$recettes,
            "between" =>$between
        ];
    }
}

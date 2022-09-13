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
    public function yedek(Dashboard $dashboard)
    {
        $paymentTypes  = [];
        $startDate = request()->get("start_date") ?? date("Y-m-d");
        $endDate = request()->get("end_date") ?? date("Y-m-d");
        $filterType = request()->get("filter_type") ?? Filter::TYPES[0];
        $between = [$startDate, $endDate];

        $docVente = $dashboard->getDocVente($between);
        $saleAndPaymentDetails = $dashboard->getSaleAndPaymentDetails($between);
        // dd($saleAndPaymentDetails);
        $saleAndPaymentDetails = $saleAndPaymentDetails->map(fn ($sale) => $dashboard->mapSalePayment($sale))
            ->filter(fn ($saleable) => !is_null($saleable));

        $payments = $saleAndPaymentDetails->groupBy("payment_type");
        $paymentTypes = $dashboard->getPaymentTypes($payments);

        $saleAndPaymentDetails = $saleAndPaymentDetails->groupBy("article_reference");

        $solds = $dashboard->getSolds($between, $filterType);
        $recettes = $this->getRecettes($solds, $docVente);
        $recaps = $dashboard->getRecaps($between, $filterType);

        return view("admin.dashboard.index", [
            "between" => $between,
            "paymentTypes" => $paymentTypes,
            "recaps" => $recaps,
            "recettes" => $recettes,
            "saleAndPaymentDetails" => $saleAndPaymentDetails->map(fn ($article) => $this->mapSalPaymentCol($article)),
            "solds" => $solds
        ]);
    }

    public function index(Dashboard $dashboard)
    {
        $paymentTypes  = [];
        $startDate = request()->get("start_date") ?? date("Y-m-d");
        $endDate = request()->get("end_date") ?? date("Y-m-d");
        $filterType = request()->get("filter_type") ?? Filter::TYPES[0];
        $between = [$startDate, $endDate];

        $solds = $dashboard->getSolds($between, $filterType);
        $docVente = $dashboard->getDocVente($between);
        $soldPayments = $dashboard->getSaleAndPaymentDetails($between, $filterType);
        $soldPayments = $this->getSaleDocs($soldPayments, $filterType);
        $payments = $soldPayments->groupBy("payment_type");
        $paymentTypes = $dashboard->getPaymentTypes($payments);
        // dd($soldPayments);
        $recettes = $this->getRecettes($solds, $docVente);
        $recaps = $dashboard->getRecaps($between, $filterType);

        return view("admin.dashboard.index", [
            "between" => $between,
            "paymentTypes" => $paymentTypes,
            "recaps" => $recaps,
            "recettes" => $recettes,
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
        $filterType = request()->get("filter_type") ?? Filter::TYPES[0];
        $solds = $dashboard->getSolds($between, $filterType);
        $docVente = $dashboard->getDocVente($between);

        $recettes = $this->getRecettes($solds, $docVente);

        return  [
            'invoices' => [
                'datas' => $solds,
                'type' => 'saleable',
            ],
            "solds" => $solds,
            "recettes" => $recettes,
            "between" => $between
        ];
    }

    private function getSaleDocs($saleDocs, $filterType)
    {
        // dd($saleDocs,$filterType);
        $articles = $saleDocs->filter(fn ($data) => $data->saleable_type == "App\Models\Product");
        $consignations = $saleDocs->filter(function ($data) {
            return  $data->saleable_type == "App\Models\Emballage" && $data->isWithEmballage == 0;
        });
        $deconsignations = $saleDocs->filter(function ($data) {
            return  $data->saleable_type == "App\Models\Emballage" && $data->isWithEmballage == 1;
        });

        switch ($filterType) {
            case 'article':
                $saleDocs = $articles;
                break;
            case 'consignation':
                $saleDocs = $consignations;
                break;
            case 'deconsignation':
                $saleDocs = $deconsignations;
                break;
            default:
                break;
        }

        return $saleDocs;
    }

    private function getRecettes($solds, $docVente)
    {
        // $docVente = $docVente->get();
        $rest = $solds->sum("sub_amount") - $docVente->sum("paid");

        return  [
            // "sum_paid" => 0,
            // "sum_checkout" => 0,
            // "sum_caisse" => 0,
            // "sum_rest" => 0,
            "sum_amount" => $solds->sum("sub_amount"),
            "sum_paid" => $docVente->sum("paid"),
            "sum_checkout" => $docVente->sum("checkout"),
            "sum_caisse" => $docVente->sum("paid") - $docVente->sum("checkout"),
            "sum_rest" => $rest
        ];
    }
}

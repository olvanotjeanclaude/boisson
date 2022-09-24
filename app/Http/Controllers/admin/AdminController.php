<?php

namespace App\Http\Controllers\admin;

use App\helper\Filter;
use App\helper\Dashboard;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index(Dashboard $dashboard)
    {
        if (!currentUser()->can("view dashboard")) {
            return  redirect("/admin/ventes");
        }

        $paymentTypes  = [];
        $startDate = request()->get("start_date") ?? date("Y-m-d");
        $endDate = request()->get("end_date") ?? date("Y-m-d");
        $filterType = request()->get("filter_type") ?? Filter::TYPES[0];
        $between = [$startDate, $endDate];

        $solds = $dashboard->getSolds($between, $filterType);
        $docVente = $dashboard->getDocVente($between);
        $payments = $docVente->get()->groupBy("payment_type");
        $paymentTypes = $dashboard->getPaymentTypes($payments);
        // dd($paymentTypes);
        $recettes = $dashboard->getRecettes($solds, $docVente, $between);
        $recaps = $dashboard->getRecaps($between, $filterType);
        
        return view("admin.dashboard.index", [
            "between" => $between,
            "paymentTypes" => $paymentTypes,
            "recaps" => $recaps,
            "recettes" => $recettes,
            "solds" => $solds
        ]);
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
        $recettes = $dashboard->getRecettes($solds, $docVente, $between);
        $recaps = $dashboard->getRecaps($between, $filterType);

        return  [
            'invoices' => [
                'datas' => $solds,
                'type' => 'saleable',
            ],
            "solds" => $solds,
            "recettes" => $recettes,
            "between" => $between,
            "recaps" => $recaps,
        ];
    }
}

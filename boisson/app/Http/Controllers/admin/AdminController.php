<?php

namespace App\Http\Controllers\admin;

use App\Exports\DashboardDetail;
use App\helper\Filter;
use App\helper\Dashboard;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function index(Dashboard $dashboard)
    {
        return redirect("/admin/stocks");

        if (!currentUser()->can("view dashboard")) {
            return  redirect("/admin/stocks");
        }

        $paymentTypes = $dashboard->getPaymentTypes() ?? [];
        $paymentTypes = ["paymentTypes" => $paymentTypes];

        $datas = array_merge($this->getDocumentData($dashboard), $paymentTypes);

        return view("admin.dashboard.index", $datas);
    }

    public function printReport(Dashboard $dashboard)
    {
        $pdf = Pdf::loadView('admin.dashboard.invoice',  $this->getDocumentData($dashboard));

        return $pdf->stream();
    }

    public function download(Dashboard $dashboard)
    {
        $pdf = Pdf::loadView('admin.dashboard.invoice',  $this->getDocumentData($dashboard));

        return $pdf->download("dashboard.pdf");
    }

    private function getDocumentData(Dashboard $dashboard)
    {
        $startDate = request()->get("start_date") ?? date("Y-m-d");
        $endDate = request()->get("end_date") ?? date("Y-m-d");
        $between = [$startDate, $endDate];
        $filterType = request()->get("filter_type") ?? Filter::TYPES["tout"];
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

    public function detail(Dashboard $dashboard)
    {
        return view("admin.dashboard.detail", $this->getDocumentData($dashboard));
    }

    public function exportExcel(Dashboard $dashboard)
    {
        $datas = $this->getDocumentData($dashboard);
        $between = $datas["between"];
        $between[0] = format_date($between[0], "-");
        $between[1] = format_date($between[1], "-");

        $date = $between[0] != $between[1] ? join("--", $between) : $between[0];

        $dashboardDetail = new DashboardDetail($datas);

        return Excel::download($dashboardDetail, "$date-dashboard-detail.xlsx");
    }

    public function detailData(Request $request, Dashboard $dashboard)
    {
        $datas = $this->getDocumentData($dashboard);

        if ($request->ajax()) {
            return DataTables::of($datas)
                ->setRowId(fn ($product) => "row_$product->id")
                ->addColumn("price", fn ($product) => formatPrice($product->price))
                ->addColumn("wholesale_price", fn ($product) => formatPrice($product->wholesale_price))
                ->addColumn("cont_or_condition", fn ($product) => $product->contenance ?? $product->condition ?? null)
                ->addColumn("category", fn ($product) =>  $product->category->name)
                ->make(true);
        }
    }
}

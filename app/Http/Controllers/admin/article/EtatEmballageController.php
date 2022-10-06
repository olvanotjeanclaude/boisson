<?php

namespace App\Http\Controllers\admin\article;

use App\Models\Stock;
use App\helper\Filter;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class EtatEmballageController extends Controller
{
    public function index(){
        return view("admin.stock.emballage",$this->getData());
    }

    private function getDocumentData()
    {
        $data = $this->getData();
        $emballages = $data["emballages"];
        $between = $data["between"];
       
        return [
            "emballages" => $emballages,
            "sum_final" => $emballages->sum("final"),
            "between" => $between
        ];
    }

    public function printReport()
    {
        // return view('admin.stock.invoice',  $this->getDocumentData());
        $pdf = Pdf::loadView('admin.stock.invoice-emballage',  $this->getDocumentData());

        return $pdf->stream();
    }

    public function getData()
    {
        $between = [now()->toDateString(),now()->toDateString()];
        $startDate = request()->get("start_date") ?? $between[0];
        $endDate = request()->get("end_date") ?? $between[1];
        $between = [$startDate, $endDate];
        $keyword = strtolower(request()->get("chercher"));

        $emballages = Stock::Emballages($between);

        if ($keyword) {
            $emballages = $emballages->filter(function ($emballage) use ($keyword) {
                $designation = strtolower($emballage->designation);
                return $emballage->reference == $keyword ||  Str::contains($designation, $keyword);
            });
        }

        return [
            "emballages" => $emballages,
            "between" => $between,
        ];
    }
}

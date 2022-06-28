<?php

namespace App\Http\Controllers\admin\commercial_state;

use App\Models\Sale;
use Illuminate\Http\Request;
use App\Models\DocumentVente;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class CommercialStateController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->get("filtrerPar");
        $states = DocumentVente::CommercialStateBetween($type);

        $states = $states->map(function ($state) use ($type) {
            return $this->callbackSales($state, $type);
        });

        $type = DocumentVente::FILTER_TYPE[$type] ?? "Date";
        // dd($states);
        return view("admin.commercial_state.index", compact("states", "type"));
    }

    public function show($date)
    {
        $date =  date("Y-m-d", strtotime($date));

        $states = Sale::CommercialStateByDate($date);

        $states = $states->map(function ($state) {
            $state->amount = $state->sum_sale * $state->saleable->price;
            $state->amount = $state->isWithEmballage ? -$state->amount : $state->amount;
            return $state;
        });

        $total = $states->sum("amount");
        // dd($states);
        return view("admin.commercial_state.show", compact("states", "date", "total"));
    }

    public function filterData(Request $request)
    {
        // dd("ok");
        $states = DocumentVente::CommercialStateBetween($request->get("filterPar"));

        return DataTables::of($states)->make(true);
    }

    private function callbackSales($state, $type)
    {
        switch ($type) {
            case 'jour':
                $sale = Sale::where("received_at", $state->date)->get();
                break;
            case 'hebdomadaire':
                $sale = Sale::select(
                    [
                        DB::raw("SUM(quantity) as quantity"),
                        DB::raw("EXTRACT(WEEK FROM received_at) as week_of_year")
                    ]
                )
                    ->groupBy("week_of_year")
                    ->get();

                $sale = $sale->where("week_of_year", $state->week_of_year);
                break;
            case 'mois':
                $monthYear = explode("-", $state->month_of_year);
                $sale = Sale::whereMonth("received_at", $monthYear[1])
                    ->whereYear("received_at", $monthYear[0])->get();
                break;
            case 'annuel':
                $sale = Sale::whereYear("received_at", $state->year);
                break;
            default:
                $sale = Sale::where("received_at", $state->date)->get();
                break;
        }

        $state->sum_quantity =  $sale->sum("quantity");
        $state->amount_received = $state->paid - $state->sum_checkout;

        return $state;
    }
}

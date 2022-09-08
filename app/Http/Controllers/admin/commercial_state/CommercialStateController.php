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
        $this->authorize("commercialState", \App\Models\DocumentVente::class);

        $type = $request->get("filtrerPar");
        $states = [];
      
        $type = DocumentVente::FILTER_TYPE[$type] ?? "Date";
        // dd($states);
        return view("admin.commercial_state.index", compact("states", "type"));
    }

    public function show(Request $request)
    {
        $type = $request->get("filtrerPar");

        switch ($type) {
            case 'jour':
                $date = $request->get("date") ?? date("d-m-Y");
                $date =  date("Y-m-d", strtotime($date));
                $criteria = [
                    "date" => $date
                ];
                $filtered = format_date($date);
                break;

            case 'hebdomadaire':
                $startDate = $request->get("start") ?? now()->subWeek();
                $startDate =  date("Y-m-d", strtotime($startDate));

                $endDate = $request->get("end") ?? now()->subWeek();
                $endDate =  date("Y-m-d", strtotime($endDate));

                $filtered = format_date($startDate) . "-" . format_date($endDate);
                $criteria = [
                    "between" => [$startDate, $endDate]
                ];
                break;

            case 'mois':
                $month = $request->mois ?? date("m");
                $year = $request->year ?? date("Y");
                $criteria = [
                    "monthYear" => [$month, $year]
                ];
                $filtered = "$month/$year";
                break;

            case 'annuel':
                $year = $request->year ?? date("year");
                $criteria = [
                    "year" => $year
                ];
                $filtered = $year;
                break;

            default:
                $criteria = [
                    "date" => date("Y-m-d")
                ];
                break;
        }

        $states = Sale::FilterBy($type, $criteria);

        $states = $states->map(function ($state) {
            // dd($state);
            $state->invoice = DocumentVente::find($state->invoice_number);
            $state->amount = $state->sum_sale * $state->saleable->price;
            $state->amount = $state->isWithEmballage == 1 ? -$state->amount : $state->amount;
            return $state;
        });

        // dd($states);

        $total = $states->sum("amount");

        return view("admin.commercial_state.show", compact("states", "filtered", "total"));
    }

    private function callbackSales($state, $type)
    {
        switch ($type) {
            case 'jour':
                // dd("ok");
                $sale = Sale::where("received_at", $state->date)->get();
                $state->url =  route("admin.commercialState.show", [
                    "filtrerPar" => "jour",
                    "date" => format_date($state->date, "-")
                ]);
                break;

            case 'hebdomadaire':
                $sale = Sale::select(
                    [
                        DB::raw("SUM(quantity) as quantity"),
                        DB::raw("EXTRACT(WEEK FROM received_at) as week_of_year"),
                        DB::raw("EXTRACT(YEAR FROM received_at) as year"),
                    ]
                )
                    ->groupBy("week_of_year")
                    ->groupBy("year")
                    ->get();

                $sale = $sale->where("week_of_year", $state->week_of_year);

                $dates = getStartAndEndDate($state->week_of_year, $state->year);
                // dd($dates);
                $state->week_days = format_date($dates["week_start"], "/") . "-" . format_date($dates["week_end"], "/");
                $state->startEndWeek = $dates;
                $state->url =  route("admin.commercialState.show", [
                    "filtrerPar" => "hebdomadaire",
                    "start" => format_date($dates["week_start"], "-"),
                    "end" => format_date($dates["week_end"], "-"),
                ]);
                break;

            case 'mois':
                $monthYear = explode("-", $state->month_of_year);
                $sale = Sale::whereMonth("received_at", $monthYear[1])
                    ->whereYear("received_at", $monthYear[0])->get();
                $state->url =  route("admin.commercialState.show", [
                    "filtrerPar" => "mois",
                    "mois" => $monthYear[1],
                    "year" => $monthYear[0],
                ]);
                break;

            case 'annuel':
                $sale = Sale::whereYear("received_at", $state->year);
                $state->url =  route("admin.commercialState.show", [
                    "filtrerPar" => "annuel",
                    "year" => $state->year
                ]);
                break;
            default:
                $sale = Sale::where("received_at", $state->date)->get();
                $state->url =  route("admin.commercialState.show", [
                    "filtrerPar" => "jour",
                    "date" => format_date($state->date, "-")
                ]);
                break;
        }

        $state->sum_quantity =  $sale->sum("quantity");
        $state->amount_received = $state->paid - $state->sum_checkout;
        $state->sum_checkout = -$state->sum_checkout;

        return $state;
    }

    private function calculAmount($state)
    {
        $state->amount = $state->sum_sale * $state->saleable->price;
        $state->amount = $state->isWithEmballage == 1 ? -$state->amount : $state->amount;
        return $state;
    }
}

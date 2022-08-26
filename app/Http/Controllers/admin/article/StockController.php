<?php

namespace App\Http\Controllers\admin\article;

use App\Models\Stock;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function index(Request $request)
    {
        $between = Stock::getDefaultBetween();

        if(isset($request->start_date)){
            $between[0] = $request->start_date;
        }
        if(isset($request->end_date)){
            $between[1] = $request->end_date;
        }

        $stocks = Stock::between($between)->filter(function ($stock) {
            return $stock->article_type != "App\Models\Emballage";
        });
        // dd($between);
        // dd($stocks);

        $saleBottles = DB::table("sales")
            ->select([
                "article_reference",
                DB::raw("SUM(quantity) AS sum_bottle"),
                "saleable_id as article_id",
                "saleable_type as article_type",
                "isWithEmballage"
            ])
            ->where("saleable_type", "App\Models\Emballage")
            ->whereNotNull("invoice_number")
            ->whereNotNull("received_at")
            ->whereBetween("received_at", $between)
            ->groupBy("article_reference")
            ->get()->map(function ($sale) {
                $sale->type = "sale";
                return $sale;
            });


        $supplierBottles = DB::table("supplier_orders")
            ->select([
                "article_reference",
                DB::raw("SUM(quantity) AS sum_bottle"),
                "article_id",
                "article_type",
                "isWithEmballage",
            ])
            ->where("article_type", "App\Models\Emballage")
            ->whereNotNull("invoice_number")
            ->whereNotNull("received_at")
            ->whereBetween("received_at", $between)
            ->groupBy("article_reference")
            ->get()->map(function ($sale) {
                $sale->type = "supplier";
                return $sale;
            });

        $bottles = $saleBottles->merge($supplierBottles)->map(function ($bottle) {
            $articleModel = $bottle->article_type;
            $article = $articleModel::find($bottle->article_id);
            if ($article) {
                $bottle->exists = true;
                $bottle->designation = strtoupper($article->designation);
            }
            return $bottle;
        })->sort();
        // dd($saleBottles, $supplierBottles);
        // dd($bottles);
        // dd($stocks);
        // dd($magasins);
        return view("admin.stock.index", compact("stocks", "bottles", "between"));
    }
}

<?php

namespace App\Http\Controllers\admin\article;

use App\Models\Stock;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\SupplierOrders;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function index()
    {
        //stock entry
        $entries = SupplierOrders::between();
        $out = Sale::Between();
        // $this->updateEntries($entries);

        //Sales
        // $noEmballages = Sale::ByDate();
        // $this->updateOut($noEmballages);
        // dd($entries);
        dd($entries, $out);


        $stocks = Stock::orderBy("date", "desc")->get();
        // dd($magasins);
        return view("admin.stock.index", compact("stocks"));
    }

    private function updateEntries($entries = [])
    {
        // dd($entries);
        // $deconsignations = Sale::byDate(true);

        if (count($entries)) {
            foreach ($entries as $magasin) {
                // // dd($magasin);
                $modelArticle = $magasin->article_type;
                $article = $modelArticle::find($magasin->article_id);
                // // dd($article);
                if ($article) {
                        Stock::updateOrcreate(
                            [
                                "date" => $magasin->received_at,
                                "article_reference" => $article->reference,
                                "stockable_id" => $article->id,
                                "stockable_type" => get_class($article),
                            ],
                            [
                                "entry" => $magasin->sum_quantity
                            ]
                        );
                }
            }

            foreach (Stock::all() as $stock) {
                $modelArticle = $stock->stockable_type;
                $article = $modelArticle::find($stock->stockable_id);

                if ($article) {
                    $prevStock = Stock::where("article_reference", $stock->article_reference)
                        ->where("date", "<", $stock->date)->first();
                    $nextStock = Stock::where("article_reference", $stock->article_reference)
                        ->where("date", ">", $stock->date)->first();
                    // dd($stock,$prevStock);
                    if ($prevStock) {
                        // dd($stock, $prevStock->final);
                        $sumEntry = $stock->entry + $prevStock->final;
                        $stock->update(["entry" => $sumEntry]);
                    }
                }
            }
        }
        // dd($deconsignations);
        // $this->updateEntryByDeconsignation($deconsignations);
    }

    private function updateEntryByDeconsignation($deconsignations = [])
    {
        foreach ($deconsignations as $key => $deconsignation) {
            // dd($deconsignation);
            Stock::updateOrcreate(
                [
                    "date" => $deconsignation->received_at,
                    "article_reference" => $deconsignation->article_reference,
                    "stockable_id" => $deconsignation->saleable_id,
                    "stockable_type" =>$deconsignation->saleable_type,
                ],
                [
                    "entry" => $deconsignation->sum_sale
                ]
            );
        }

        // foreach (Stock::all() as $stock) {
        //     $sumEntry = $stock->entry;
        //     foreach ($deconsignations as $deconsignation) {
        //         if (
        //             $stock->date == $deconsignation->received_at &&
        //             $stock->article_reference == $deconsignation->article_reference
        //         ) {
        //             $sumEntry += $deconsignation->sum_sale;

        //             $stock->update([
        //                 "entry" => $sumEntry
        //             ]);
        //         }
        //     }
        // }
    }

    private function updateOut($sales = [])
    {
        $allStocks = Stock::all();
        // dd($sales);
        if (count($sales)) {
            // foreach ($allStocks as $stock) {
            //     $article = $stock->stockable;
            //     // dd($article);
            //     if ($article) {
            //         foreach ($sales as  $sale) {
            //             Stock::where("article_reference", $sale->article_reference)
            //                 ->where("date", $sale->received_at)
            //                 ->update([
            //                     "out" => $sale->sum_sale
            //                 ]);
            //         }
            //     }
            // }

            foreach ($sales as $sale) {
                $stock = Stock::where("date", $sale->received_at)
                    ->where("article_reference", $sale->article_reference)
                    ->first();

                $prevStock = Stock::where("date", "<", $sale->received_at)
                    ->where("article_reference", $sale->article_reference)
                    ->first();

                Stock::updateOrCreate([
                    "date" => $sale->received_at,
                    "article_reference" => $sale->article_reference,
                    "stockable_id" => $sale->saleable_id,
                    "stockable_type" => $sale->saleable_type,
                ], [
                    "entry" => $prevStock->final??$stock->final??0,
                    "out" => $sale->sum_sale
                ]);
            }
        }
    }
}

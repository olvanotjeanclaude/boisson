<?php

namespace App\Http\Controllers\admin\article;

use App\Models\Stock;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\SupplierOrders;

class StockController extends Controller
{
    public function index()
    {
        //stock initial
        $lastOneMonth = SupplierOrders::Between();
        $this->updateStockInitial($lastOneMonth);

        //stock entry
        $entries = SupplierOrders::ByDate();
        $this->updateEntries($entries);

        //Sales
        $nomEmballages = Sale::ByDate();
        $this->updateOut($nomEmballages);

        $stocks = Stock::orderBy("date", "desc")->get();
        // dd($magasins);
        return view("admin.stock.index", compact("stocks"));
    }

    private function updateStockInitial($magasins = [])
    {
        if (count($magasins)) {
            foreach ($magasins as $magasin) {
                $modelArticle = $magasin->article_type;
                $article = $modelArticle::find($magasin->article_id);
                // dd($article);
                if ($article) {
                    Stock::updateOrcreate(
                        [
                            "date" => $magasin->received_at,
                            "article_reference" => $article->reference,
                            "stockable_id" => $article->id,
                            "stockable_type" => get_class($article),
                        ],
                        [
                            "initial" => $magasin->sum_initial
                        ]
                    );
                }
            }
        }
    }

    private function updateEntries($entries = [])
    {
        // dd($entries);
        $lastOneMonth = SupplierOrders::Between();
        $deconsignations = Sale::byDate(true);
        // dd($deconsignations);
        if (count($entries)) {
            foreach ($entries as $magasin) {
                $modelArticle = $magasin->article_type;
                $article = $modelArticle::find($magasin->article_id);

                if ($article) {
                    Stock::updateOrcreate(
                        [
                            "date" => $magasin->received_at,
                            "article_reference" => $article->reference,
                            "stockable_id" => $article->id,
                            "stockable_type" => get_class($article),
                        ],
                        [
                            "entry" => $magasin->sum_entry
                        ]
                    );
                }
            }

            $allStockToday =  Stock::where("date", date("Y-m-d"))->get();

            foreach ($allStockToday as $stock) {
                $article = $stock->stockable;
                // dd($article);
                // dd($lastOneMonth, $stock);
                if ($article) {
                    foreach ($lastOneMonth as  $last) {
                        if ($last->article_reference == $stock->article_reference) {
                            $stock->where("article_reference", $stock->article_reference)
                                ->update([
                                    "initial" => $last->sum_initial
                                ]);
                        }
                    }
                }
            }
        }

        foreach (Stock::all() as $stock) {
            $sumEntry = $stock->entry;
            foreach ($deconsignations as $deconsignation) {
                if (
                    $stock->date == $deconsignation->received_at &&
                    $stock->article_reference == $deconsignation->article_reference
                ) {
                    $sumEntry += $deconsignation->sum_sale;

                    $stock->update([
                        "entry" => $sumEntry
                    ]);
                }
            }
        }
    }

    private function updateOut($sales = [])
    {
        $allStocks = Stock::all();
        // dd($sales);
        if (count($sales)) {
            foreach ($allStocks as $stock) {
                $article = $stock->stockable;
                // dd($article);
                if ($article) {
                    foreach ($sales as  $sale) {
                        Stock::where("article_reference", $sale->article_reference)
                            ->where("date", $sale->received_at)
                            ->update([
                                "out" => $sale->sum_sale
                            ]);
                    }
                }
            }
        }
    }
}

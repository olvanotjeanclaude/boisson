<?php

namespace App\Articles;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockRequest
{
    public static function All()
    {
        $request = request();
        $formatRequest = new FormatRequest();
        $datas = [];

        $article = Stock::getArticleByReference($request->article_reference);

        if ($article) {
            // dd($formatRequest);
            if (get_class($article) == "App\Models\Emballage") {
                $datas[] =  [
                    "status" => Stock::STATUS["pending"],
                    "article_reference" => $article->reference,
                    "stockable_id" => $article->id,
                    "stockable_type" => get_class($article),
                    "supplier_id" => $request->supplier_id,
                    "entry" => $request->quantity ?? 0,
                    "user_id" => auth()->user()->id,
                    "action_type" => Stock::ACTION_TYPES["new_stock"],
                    "date" => now()->toDateString(),
                ];
            } else { //if article
                $articleAndConsignations = $formatRequest->getArticleAndConsignation(
                    $article->reference,
                    $request->quantity
                );

                $articleAndConsignations = array_filter($articleAndConsignations,function($article){
                    return count($article);
                });

                $datas = array_map(function ($article) use ($request) {
                    return [
                        "status" => Stock::STATUS["pending"],
                        "article_reference" => $article["article_reference"],
                        "stockable_id" => $article["saleable_id"],
                        "stockable_type" => $article["saleable_type"],
                        "supplier_id" => $request->supplier_id,
                        "entry" => $article["quantity"],
                        "user_id" => auth()->user()->id,
                        "action_type" => Stock::ACTION_TYPES["new_stock"],
                        "date" => now()->toDateString(),
                    ];
                }, $articleAndConsignations);
            }
        }

        return $datas;
    }
}

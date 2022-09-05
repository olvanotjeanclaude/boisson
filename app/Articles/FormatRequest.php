<?php

namespace App\Articles;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Articles;
use App\Models\Emballage;

class FormatRequest
{
    public function getItems($reference, int $quantity)
    {
        $items =  [];

        $article = Product::where("reference", $reference)->first();
        if ($article && $quantity > 0 && $article->price && $article->wholesale_price) {

            $unity = Articles::UNITS[$article->unity];
            $prices = [
                "price" => $article->price,
                "wholesale_price" => $article->wholesale_price,
            ];
            $data = [
                "quantity" => $quantity,
                "reference" => $article->reference,
                "designation" => $article->designation,
            ];

            switch ($unity) {
                case 'pcs':
                    if ($article->contenance) {
                        $pricings = $this->calculateAmount($article->contenance, $quantity, $prices);
                    }
                    break;
                case 'litre':
                    if ($article->contenance) {
                        $pricings = $this->calculateAmount($article->condition, $quantity, $prices);
                    }
                    break;

                default:
                    $pricings = [];
                    break;
            }
            //   dd(request()->all(), $pricings, $article->toArray());

            if (isset($pricings["amount_detail"])) {
                $data["price"] = $article->price;
                $data["sub_amount"] = $pricings["amount_detail"];
                $items[] = $data;
            }

            if (isset($pricings["amount_wholesale"])) {
                $data["designation"] = $data["designation"];
                $data["wholesale_price"] = $article->wholesale_price;
                $data["sub_amount"] = $pricings["amount_wholesale"];
                $items[] = $data;
            }
        }

        return $items;
    }

    private function calculateAmount(int $divider, int $quantity, array $prices): array
    {
        $amounts = [];

        if ($divider && $quantity && isset($prices["price"]) && isset($prices["wholesale_price"])) {
            if ($quantity < $divider) {
                $amounts["amount_detail"] =  $quantity * $prices["price"];
            } else if ($quantity >= $divider) {
                $quantityDetail = $quantity % $divider;
                $quantityPack = $quantity / $divider;

                if ($quantityDetail > 0) {
                    $amounts["amount_detail"] = $quantityDetail * $prices["price"];
                }

                if ($quantityPack > 0) {
                    $amounts["amount_wholesale"] =  intval($quantityPack) * $prices["wholesale_price"];
                }
            }
        }

        return $amounts;
    }

    private function format_article($actionType, $article, $quantity): array
    {
        if($article){
            return [
                "action_type" => $actionType,
                "article_reference" => $article->reference,
                "saleable_id" => $article->id,
                "saleable_type" => get_class($article),
                "quantity" => $quantity,
                "user_id" => auth()->user()->id,
            ];
        }

        return [];
    }

    public function getArticleAndConsignation($articleRef, int $quantity)
    {
        $article = Product::whereReference($articleRef)->first();
        $datas = [];
        $actionType = Sale::ACTION_TYPES[request()->article_type];
        $sampleConsignation = $article->simple_package;
        $packConsignation = $article->big_package;
        // $quantity = 100;
        // $divider =20;

        $divider =  $article->contenance ?? $article->condition ?? null;;
       
        if ($article && $divider) {
            if ($quantity < $divider) {
                $datas[] = $this->format_article($actionType, $article, $quantity);
                if ($sampleConsignation) {
                    $datas[] = $this->format_article($actionType, $sampleConsignation, $quantity);
                }
            } else if ($quantity >= $divider) {
                $rest = $quantity % $divider;
                $quantityPack = intval($quantity / $divider);
                // dd($quantity, $rest,$quantityPack,$sampleConsignation,$packConsignation);
               
                if ($rest >0) {
                    $datas[] = $this->format_article($actionType, $article, $rest);
                   
                    if ($sampleConsignation) {
                        $datas[] = $this->format_article($actionType, $sampleConsignation, $rest);
                    }
                }

                if($rest==0){
                    $datas[] = $this->format_article($actionType, $sampleConsignation, $quantity);
                }

                if ($quantityPack > 0) {
                    $datas[] = $this->format_article($actionType, $article, $quantityPack * $divider);

                    if ($packConsignation) {
                        $datas[] = $this->format_article($actionType, $packConsignation, $quantityPack);
                    }
                }
            }
        }

        return  $datas;
    }

    public function getAllDeconsignations(array $emballages)
    {
        $datas = [];

        if (count($emballages)) {
            foreach ($emballages as $emballage) {
                if (isset($emballage["reference"]) && isset($emballage["quantity"])) {
                  
                    $emballage = $this->getEmballage(
                        $emballage["reference"],
                        $emballage["quantity"]
                    );
                   
                    if($emballage){
                        $datas[] = $emballage;
                    }
                }
            }
        }

        if(count($datas)){
            $datas = array_map(function($data){
                $data["isWithEmballage"] = true;
                return $data;
            },$datas);
        }

        return $datas;
    }

    public function getEmballage($articleRef, int $quantity)
    {
        $data = null;
        $emballage = Emballage::where("reference", $articleRef)->first();
        $actionType = Sale::ACTION_TYPES[request()->article_type];

        if ($emballage && $quantity > 0) {
            $data = $this->format_article($actionType, $emballage, $quantity);
        }

        return $data;
    }
}

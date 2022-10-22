<?php

namespace App\Articles;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Articles;
use App\Models\Emballage;

class FormatRequest
{
    private function format_article($actionType, $article, $quantity): array
    {
        if ($article) {
            return [
                "action_type" => $actionType,
                "article_reference" => $article->reference,
                "saleable_id" => $article->id,
                "saleable_type" => get_class($article),
                "quantity" => $quantity,
                "user_id" => auth()->user()->id,
                "received_at" => now()->toDateString()
            ];
        }

        return [];
    }

    public function getArticleAndConsignation($articleRef,  $quantity)
    {
        $datas = [];

        $article = Product::whereReference($articleRef)->first();
        $actionType = Sale::ACTION_TYPES["avec-consignation"];
        $sampleConsignation = $article->simple_package ?? null;
        $packConsignation = $article->big_package ?? null;
        $unity = Articles::UNITS[$article->unity] ?? null;
        // $quantity = 100;
        // $divider =20;

        $divider =  $article->contenance ?? $article->condition ?? null;;

        if ($article && $divider) {
            if ($quantity < $divider) { // si Qtt < bareme vend le par prix detail + consignation
                $datas[] = $this->format_article($actionType, $article, $quantity);
                if ($sampleConsignation) {
                    $datas[] = $this->format_article($actionType, $sampleConsignation, $quantity);
                }
            } else if ($quantity >= $divider) { // Si Qtt > barem vend le par PrixGros + consignation
                // dd($article);
                if ($unity == "litre") {
                    $datas[] = $this->format_article($actionType, $article, $quantity);
                } else {
                    $rest = $quantity % $divider;
                    $quantityPack = intval($quantity / $divider);
                    // dd($quantity, $rest,$quantityPack,$sampleConsignation,$packConsignation);

                    if ($rest > 0) {
                        $datas[] = $this->format_article($actionType, $article, $rest);

                        if ($sampleConsignation) {
                            $datas[] = $this->format_article($actionType, $sampleConsignation, $quantity);
                        }
                    }

                    if ($rest == 0) {
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
        }

        return $datas;
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

                    if ($emballage) {
                        $datas[] = $emballage;
                    }
                }
            }
        }

        if (count($datas)) {
            $datas = array_map(function ($data) {
                $data["isWithEmballage"] = true;
                return $data;
            }, $datas);
        }

        return $datas;
    }

    public function getEmballage($articleRef,  $quantity)
    {
        $data = null;
        $emballage = Emballage::where("reference", $articleRef)->first();
        $actionType = Sale::ACTION_TYPES["deconsignation"];

        if ($emballage && $quantity > 0) {
            $data = $this->format_article($actionType, $emballage, $quantity);
            $data["isWithEmballage"] = true;
        }

        return $data;
    }

    public function getDeconsignation()
    {
        $request = request()->all();

        $emballage = [];

        if (isset($request["article_reference"]) && isset($request["quantity"])) {
            $emballage = $this->getEmballage(
                $request["article_reference"],
                $request["quantity"]
            );
        }

        return [$emballage];
    }
}

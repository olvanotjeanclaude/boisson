<?php

namespace App\helper;

use App\Models\Sale;

class Filter
{
    const TYPES = [
        "tout" => "tout",
        "article" =>  "article",
        "consignation" => "consignation",
        "deconsignation" => "avoir",
        "wholesale" => "en gros",
        "detail" => "en detail"
    ];

    public static function queryBetween($query, $between, $dateColumn = "received_at")
    {
        if ($between[0] == $between[1]) {
            $query = $query->whereDate($dateColumn, $between[0]);
        } else {
            $query = $query->whereDate($dateColumn, '>=', $between[0])
                ->whereDate($dateColumn, '<=', $between[1]);
        }
        return $query;
    }

    public static function querySales($sales, $filterType)
    {
        switch ($filterType) {
            case 'article':
                $sales =  $sales->where("saleable_type", "App\Models\Product");
                break;
            case 'consignation':
                $sales = $sales->where("saleable_type", "App\Models\Emballage")
                    ->where("isWithEmballage", false);
                break;
            case 'deconsignation':
                $sales = $sales->where("saleable_type", "App\Models\Emballage")
                    ->where("isWithEmballage", true);
                break;
            case 'detail':
                $sales =  Sale::getDetailOrWholesale($sales, "detail");
                break;
            case 'wholesale':
                $sales =  Sale::getDetailOrWholesale($sales, "wholesale");
                break;
        }

        return $sales;
    }

    public static function filterStock($query, $filterType)
    {
        switch ($filterType) {
            case 'article':
                $query =  $query->where("stockable_id", "App\Models\Product");
                break;
            case 'consignation':
                $query = $query->where("stockable_type", "App\Models\Emballage")
                    ->where("isWithEmballage", false);
                break;
            case 'deconsignation':
                $query = $query->where("stockable_type", "App\Models\Emballage")
                    ->where("isWithEmballage", true);
                break;
            case 'sorti':
                $query = $query->where("out_quantity", ">", 0);
                break;
            default:
                # code...
                break;
        }

        return $query;
    }
}

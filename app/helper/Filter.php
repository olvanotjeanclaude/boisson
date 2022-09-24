<?php

namespace App\helper;

class Filter
{
    const TYPES = ["tout", "article", "consignation", "deconsignation"];

    public static function queryBetween($query, $between, $dateColumn = "received_at")
    {
        if ($between[0] == $between[1]) {
            $query = $query->whereDate($dateColumn, $between[0]);
        } else {
            $query = $query->whereDate($dateColumn, '>=', $between[0])
                ->whereDate($dateColumn, '<=', $between[1]);
            // $query = $query->whereBetween($dateColumn, $between);
        }
        return $query;
    }

    public static function querySales($query, $filterType)
    {
        switch ($filterType) {
            case 'article':
                $query =  $query->where("saleable_type", "App\Models\Product");
                break;
            case 'consignation':
                $query = $query->where("saleable_type", "App\Models\Emballage")
                    ->where("isWithEmballage", false);
                break;
            case 'deconsignation':
                $query = $query->where("saleable_type", "App\Models\Emballage")
                    ->where("isWithEmballage", true);
                break;

            default:
                # code...
                break;
        }

        return $query;
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

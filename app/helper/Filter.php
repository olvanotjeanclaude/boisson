<?php

namespace App\helper;

class Filter
{
    const TYPES = [
        "article" => 1,
        "consignation" => 2,
        "deconsignation" => 3
    ];

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
}

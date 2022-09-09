<?php

namespace App\helper;

class Filter
{
    public static function queryBetween($query, $between,$dateColumn="received_at")
    {
        if($between[0]==$between[1]){
            $query = $query->whereDate($dateColumn, now()->toDateString());
        }
        else{
            $query = $query->whereBetween($dateColumn, $between);
        }
        
        return $query;
    }
}

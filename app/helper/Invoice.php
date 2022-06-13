<?php

namespace App\helper;

class Invoice{
    const PAYMENT_TYPES = [
        "1" => "Chèque",
        "2" => "espèce",
        "3" => "Mvola",
        "4" => "orange money",
        "5" => "airtel",
    ];

    const STATUS = [
        "printed" => 1,
        "no_printed" => 2,
        "deleted" => 3,
        "modified" => 4,
        "valid" => 5,
    ];
}
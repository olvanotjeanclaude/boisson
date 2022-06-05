<?php

namespace App\Http\Requests;

class VenteValidation
{
    const RULES = [
        "article_id" => "required|numeric|integer",
        "consignation_id" => "required",

        //customer
        "customer_id" => ["required_if:newCustomer,0"],
        "customer_identification" => ["required_if:newCustomer,1"],
        "customer_phone" => ["required_if:newCustomer,1"],

        "deconsignation_id" => "required_if:withDeconsignation,on",

        //requested sale
        // "package_type" => "required|numeric|integer",
        // "package_type_value" => "required|numeric|integer",
        // "package_contenance" => ["required", "numeric", "integer"],
        "quantity_bottle" => "required|numeric|integer",

        //received
        // "received_bottle" => "required_if:withDeconsignation,on|numeric",
        // "received_package_contenance" => "required_if:withDeconsignation,on|numeric",
        // "received_package_type" => "required_if:withDeconsignation,on|numeric",
        // "received_package_type_value" => "required_if:withDeconsignation,on|numeric",
    ];

    const MESSAGES = [
        "article_id.required" => "Veuillez selectionner l'article",
        "consignation_id.required" => "Veuillez selectionner la consignation",

        "customer_id.required_if" => "Veuillez selectionner le client",
        "customer_identification.required_if" => "Veuillez selectionner le client",
        "customer_phone.required_if" => "Entrer le numero telephone",

        "package_type.required" => "Selection le type d'article",
        "package_type_value.required" => "Entrer le valeur de type d'article",
        "package_contenance.required" => "Entrer le contenu",
        "quantity_bottle.required" => "Entrer le quantite de bouteille",

        "deconsignation_id.required_if" => "Veuillez selectionner la designation de la deconsignation",
    ];
}

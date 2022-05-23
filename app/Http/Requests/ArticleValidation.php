<?php

namespace App\Http\Requests;

class ArticleValidation
{
    const RULES = [
        "article_type" => "required|numeric|integer",
        "category_id " => "",
        "designation" => "required",
        "quantity_type" => "",
        "quantity_type_value" => ["required_if:quantity_type,2", "required_if:quantity_type,3"],
        //"contenance" => ["required_if:quantity_type,2", "required_if:quantity_type,3"],
        "quantity_bottle" => "required|numeric|integer",
        "unity" => "required|numeric|integer",
        "unit_price" => "required|numeric",
        "buying_price" => "required|numeric",
        "detail_price" => "required|numeric",
        "wholesale_price" => "required|numeric",
        "supplier_id" => "required",
    ];

    const MESSAGES = [
        "article_type.required" => "Veuillez selectionner le type d'article",
        "designation.required" => "Le champ designation est obligatoire",
        "quantity_type_value.required_if" => "Veuillez entrer le nombre de cageot ou carton",
        //"contenance.required_if" => "Veuillez entrer le contenance de cageot ou carton",

        "quantity_bottle.required" => "Entrer nombre de bouteille",
        "quantity_bottle.numeric" => "le nombre de la bouteille doit être un nombre",
        "quantity_bottle.integer" => "le nombre de la bouteille doit être un nombre entier",

        "unity.required" => "Veuillez selectionner le type d'unité",

        "unit_price.required" => "Entrer le prix unitaire",
        "unit_price.numeric" => "le prix unitaire doit être un nombre",

        "buying_price.required" => "Entrer le prix d'achat",
        "unit_price.numeric" => "le prix unitaire doit être un nombre",

        "detail_price.required" => "Entrer le prix détail",
        "detail_price.numeric" => "le prix détail doit être un nombre",

        "wholesale_price.required" => "Entre le prix de gros",
        "unit_price.numeric" => "le prix de gros doit être un nombre",

        "supplier_id.required" => "Veuillez selectionner le fournisseur",
    ];
}

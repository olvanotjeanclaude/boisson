<?php

namespace App\Http\Requests;

class VenteValidation
{
    public static function rules()
    {
        $withCustomer = [
            "customer_id" => "required_if:newCustomer,0",
            "customer_identification" => "required_if:newCustomer,1",
            "customer_phone" => "required_if:newCustomer,1",
        ];

        $article = [
            "article_type" => "required",
            "article_reference" => "required",
            "category_id" => "required",
            "quantity" => "required",
            "consignation_id" => "required",
            "deconsignation_id" => "required_if:withBottle,on",
        ];

        return isset(request()->saveData) ? $withCustomer : $article;
    }

    public static function messages()
    {
        return [
            "customer_id.required_if" =>"Selectionner le client",
            "customer_identification.required_if" =>"Enter l'identification du client",
            "customer_phone.required_if" =>"Enter le numero telephone du client",
            
            "article_type.required" => "Selectionner le type d'article",
            "article_reference.required" => "Enter la reference d'article",
            "category_id.required" => "Veuillez selectionner la categorie",
            "quantity_bottle.required" => "Entrer le nombre de bouteille",
            "consignation_id.required" => "Veuillez selectionner la consignation",
            "deconsignation_id.required" => "Veuillez selectionner la deconsignation",
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class AchatSupplierValidation
{
    public static function rules()
    {
        $withCustomer = [
            "customer_id" => "required_if:newCustomer,0",
            "customer_identification" => "required_if:newCustomer,1",
            "customer_phone" => "required_if:newCustomer,1",
        ];

        $article = [
            // "article_type" => "required",

            "article_reference" => "required_if:article_type,1",
            // "consignation_id" => "required_if:article_type,1",
            "quantity" => "required_if:article_type,1",
            
            // "deconsignation_id" => Rule::requiredIf(self::validDeconsignation()),
            // "received_bottle" => Rule::requiredIf(self::validDeconsignation()),

            // "no_consign_ref_id" => "required_if:article_type,4",
            // "no_consign_quantity" => "required_if:article_type,4"
        ];

        return isset(request()->saveData) ? $withCustomer : $article;
    }

    private static function validDeconsignation(){
        return (request()->article_type==1 && request()->withBottle=="on") || request()->article_type==3;
    }

    public static function messages()
    {
        return [
            "customer_id.required_if" => "Selectionner le client",
            "customer_identification.required_if" => "Enter l'identification du client",
            "customer_phone.required_if" => "Enter le numero telephone du client",

            "article_reference.required_if" => "Veuillez selectionner l'article",
            "consignation_id.required_if" => "Veuillez selectionner la consignation",
            "quantity.required_if" => "Entrer le nombre de bouteille",
            
            "deconsignation_id.required_if" => "Veuillez selectionner l'article a deconsigner",
            "received_bottle.required_if" => "Entrer le nombre de bouteille a deconsigner",
            
            "no_consign_ref_id.required_if" => "Veuillez selectionner l'article non consigné",
            "no_consign_quantity.required_if" => "Entrer la quantité de l'article non consigné",
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VenteValidation extends FormRequest
{
    public  function rules()
    {
        $withCustomer = [
            "customer_id" => "required_if:newCustomer,0",
            "customer_identification" => "required_if:newCustomer,1",
            "customer_phone" => "required_if:newCustomer,1",
        ];

        $article = [
            "article_reference" => "required|numeric",
            "quantity" => "required|numeric",
        ];

        return isset(request()->saveData) ? $withCustomer : $article;
    }


    public  function messages()
    {
        return [
            "article_reference.required" =>"Veuillez selectionner l'article",
            "quantity.required" =>"Entrer le nombre de bouteille",
            "quantity.numeric" =>"a quantité doit être un nombre",

            "article_type.required" => "Type d'article incorrect",
            "customer_id.required_if" => "Selectionner le client",
            "customer_identification.required_if" => "Enter l'identification du client",
            "customer_phone.required_if" => "Enter le numero telephone du client",

            "article_reference.required_if" => "Veuillez selectionner l'article",
            "quantity.required_if" => "Entrer le nombre de bouteille",

            "tab1Deco.*.reference.required_without" => "Veuillez selectionner l'article à deconsigner : en detail ou gros?",
            "tab1Deco.*.reference.required" => "Veuillez selectionner l'article à deconsigner",
            "tab1Deco.*.reference.required_with" => "Veuillez selectionner l'article à deconsigner",
            "tab1Deco.*.quantity.required_with" => "Entrer le nombre à deconsigner",
            
            "tab2Deco.*.reference.required_without" => "Veuillez selectionner l'article à deconsigner : en detail ou gros?",
            "tab2Deco.*.reference.required" => "Veuillez selectionner l'article à deconsigner",
            "tab2Deco.*.reference.required_with" => "Veuillez selectionner l'article à deconsigner",
            "tab2Deco.*.quantity.required_with" => "Entrer le nombre à deconsigner"
        ];
    }
}

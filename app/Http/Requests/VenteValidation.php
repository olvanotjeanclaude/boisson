<?php

namespace App\Http\Requests;

use App\Models\Sale;
use Illuminate\Validation\Rule;
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
            "article_type" => ["required", Rule::in(array_keys(Sale::ACTION_TYPES))],

            "article_reference" => "required_if:article_type,avec-consignation",
            "quantity" => "required_if:article_type,avec-consignation",
            // "tab1Deco.row_1.reference" => [
            //     request()->article_type == "avec-consignation" && request()->withBottle == "on" ? "required" : "",
            //     "required_with:tab1Deco.row_1.quantity"
            // ],
            // "tab1Deco.row_2.reference" => "required_with:tab1Deco.row_2.quantity",
            // "tab1Deco.row_1.quantity" => "required_with:tab1Deco.row_1.reference",
            // "tab1Deco.row_2.quantity" => "required_with:tab1Deco.row_2.reference",

            // "tab2Deco.row_1.reference" => "required_if:article_type,deconsignation",
            // "tab2Deco.row_1.reference" => "required_with:tab2Deco.row_1.quantity",
            // "tab2Deco.row_2.reference" => "required_with:tab2Deco.row_2.quantity",
            // "tab2Deco.row_1.quantity" => "required_with:tab2Deco.row_1.reference",
            // "tab2Deco.row_2.quantity" => "required_with:tab2Deco.row_2.reference",
        ];

        $article = array_merge($article,$this->validDeconsignation());
        // dd($article);

        return isset(request()->saveData) ? $withCustomer : $article;
    }


    private  function validDeconsignation()
    {
        $rules = [];

        $articleType = request()->article_type;
        // dd($articleType);

        switch ($articleType) {
            case 'avec-consignation':
                if (request()->withBottle == "on") {
                    $rules = [
                        "tab1Deco.row_1.reference" => [
                            "required_without:tab1Deco.row_2.reference",
                            "required_with:tab1Deco.row_1.quantity"
                        ],
                        "tab1Deco.row_2.reference" => [
                            "required_with:tab1Deco.row_2.quantity"
                        ],
                        "tab1Deco.row_1.quantity" => "required_with:tab1Deco.row_1.reference",
                        "tab1Deco.row_2.quantity" => "required_with:tab1Deco.row_2.reference",
                    ];
                }
                break;
            case 'deconsignation':
                $rules = [
                    "tab2Deco.row_1.reference" => [
                        "required_without:tab2Deco.row_2.reference",
                        "required_with:tab2Deco.row_1.quantity"
                    ],
                    "tab2Deco.row_2.reference" => [
                        "required_with:tab2Deco.row_2.quantity"
                    ],
                    "tab2Deco.row_1.quantity" => "required_with:tab2Deco.row_1.reference",
                    "tab2Deco.row_2.quantity" => "required_with:tab2Deco.row_2.reference",
                ];
                break;

            default:
                // ....
                break;
        }
        // dd($rules,$articleType);
        return $rules;
    }

    public  function messages()
    {
        return [
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

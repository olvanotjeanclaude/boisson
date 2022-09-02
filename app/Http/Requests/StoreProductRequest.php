<?php

namespace App\Http\Requests;

use App\Models\Articles;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $bidon = Articles::PACKAGE_TYPES["bidon"];

        return [
            "designation" => "required|string",
            "price" => "required|numeric",
            "wholesale_price" => "required|numeric",
            "category_id" => "required|integer",
            "unity" => "required|integer",
            "package_type" => "required|integer",
            "contenance" => Rule::requiredIf(fn () => request()->package_type != $bidon),
            "condition" => "required_if:package_type,$bidon",
        ];
    }

    public function messages()
    {
        return [
            "designation.required" => "la désignation ne peut pas être vide!",
            "price.required" => "le prix unitaire de vente ne peut pas être vide!",
            "wholesale_price.required" => "le prix de gros ne peut pas être vide!",
            "category_id.required" => "Selectionnez la famille d'article!",
            "unity.required" => "L'unité ne peut pas être vide!",
            "package_type.required" => "la désignation ne peut pas être vide!",
            "contenance.required" => "Veuillez entrer la contenance!",
            "emballage_id.required" => "Le nombre de la consignation de etre compris  1 ou 2!",
            "condition.required_if" => "Veuillez entrer la condition!",
        ];
    }
}

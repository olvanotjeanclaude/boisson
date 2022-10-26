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
        $litre = array_search("litre",Articles::UNITS);
        $article = request()->route()->parameter("article");
        $articleId = $article->id ?? null;
        // dd($article);
        return [
            "designation" => [
                "required",
                "string",
                Rule::unique("products","designation")->ignore($articleId),
            ],
            "price" => "required|numeric",
            "wholesale_price" => "required|numeric",
            "buying_price" => "required|numeric",
            "category_id" => "required|integer",
            "unity" => "required|integer",
            "package_type" => "required|integer",
            "contenance" => [
                Rule::requiredIf(fn () => request()->unity != $litre),
                fn ($a, $v, $f) => $this->validContenanceAndCondition($a, $v, $f)
            ],
            "condition" => ["required_if:unity,$litre"],
            "simple_package" => "nullable|different:big_package",
            "big_package" => "nullable|different:simple_package",
        ];
    }

    public function messages()
    {
        return [
            "designation.required" => "la désignation ne peut pas être vide!",
            "designation.unique" => "L'article " . request()->designation . " est déjà prise!",
            "price.required" => "le prix unitaire de vente ne peut pas être vide!",
            "wholesale_price.required" => "le prix de gros ne peut pas être vide!",
            "buying_price.required" => "le prix d'achat ne peut pas être vide!",
            "category_id.required" => "Selectionnez la famille d'article!",
            "unity.required" => "L'unité ne peut pas être vide!",
            "package_type.required" => "la désignation ne peut pas être vide!",
            "contenance.required" => "Veuillez entrer la contenance!",
            "emballage_id.required" => "Le nombre de la consignation de etre compris  1 ou 2!",
            "condition.required_if" => "Veuillez entrer la condition!",
            "simple_package.different" => "La consignation simple et le gros doivent être différents!",
            "big_package.different" => "La consignation gros et le simple doivent être différents!",
        ];
    }

    private function validContenanceAndCondition($attribute, $value, $fail)
    {
        if (request()->contenance && request()->condition) {
            $fail("Contenance et la condition ne peut pas être rempli ensemble");
        }
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalePaymentRequest extends FormRequest
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
        return [
            "checkout" => "nullable|different:paid",
            "paid" => "nullable|different:checkout",
        ];

        // if ($request->paid && $request->checkout) {
        //     return back()->withErrors(["errors" => "Entrer de caisse ou sortie de caisse ?"]);
        // } 
    }

    public function messages()
    {
        
    }
}

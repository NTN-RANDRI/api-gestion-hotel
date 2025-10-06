<?php

namespace App\Http\Requests\TypeChambre;

use Illuminate\Foundation\Http\FormRequest;

class StoreTypeChambreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nom' => 'required|string|max:50',
            'nombre_lits' => 'required|integer|min:1',
            'capacite_max' => 'required|integer|min:1',
            'description' => 'nullable|string|max:1000',
        ];
    }
}

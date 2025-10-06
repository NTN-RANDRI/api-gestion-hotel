<?php

namespace App\Http\Requests\TypeChambre;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTypeChambreRequest extends FormRequest
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
            'nom' => 'sometimes|string|max:50',
            'nombre_lits' => 'sometimes|integer|min:1',
            'capacite_max' => 'sometimes|integer|min:1',
            'description' => 'nullable|string|max:1000',
        ];
    }
}

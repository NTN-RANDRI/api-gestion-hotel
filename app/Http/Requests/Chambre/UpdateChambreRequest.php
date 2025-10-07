<?php

namespace App\Http\Requests\Chambre;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChambreRequest extends FormRequest
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
            'numero' => 'sometimes|string|max:10',
            'prix_nuit' => 'sometimes|integer|min:0',
            'description' => 'nullable|string|max:1000',
            'type_chambre_id' => 'sometimes|integer|exists:type_chambres,id',
        ];
    }
}

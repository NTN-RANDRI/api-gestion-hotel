<?php

namespace App\Http\Requests\Chambre;

use Illuminate\Foundation\Http\FormRequest;

class StoreChambreRequest extends FormRequest
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
            'numero' => 'required|string|max:10',
            'prix_nuit' => 'required|integer|min:0',
            'description' => 'nullable|string|max:1000',
            'type_chambre_id' => 'required|integer|exists:type_chambres,id',
            'equipements' => 'nullable|array',
            'equipements.*' => 'integer|exists:equipements,id',
        ];
    }
}

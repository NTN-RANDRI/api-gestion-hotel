<?php

namespace App\Http\Requests\Chambre;

use Illuminate\Foundation\Http\FormRequest;

class SearchDisponibleChambreRequest extends FormRequest
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
            'date_debut' => 'required|date|after_or_equal:today',
            'date_fin' => 'required|date|after:date_debut',
            'reservation_id_to_ignore' => 'sometimes|integer|exists:reservations,id'
        ];
    }
}

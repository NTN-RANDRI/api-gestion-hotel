<?php

namespace App\Http\Requests\Reservation;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReservationRequest extends FormRequest
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
            'date_fin' => 'required|date|after:dateDebut',
            'nombre_personnes' => 'required|integer|min:1',
            'chambre_ids' => 'required|array|min:1', 'chambre_ids.*' => 'integer|exists:chambres,id',
        ];
    }
}

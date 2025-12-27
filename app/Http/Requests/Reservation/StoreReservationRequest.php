<?php

namespace App\Http\Requests\Reservation;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
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
            'client' => 'required_if:reservation.type,sur_place,par_telephone|nullable|array:reservation.type',
            'client.nom' => 'required_with:client|string|max:100',
            'client.prenom' => 'required_with:client|string|max:100',
            'client.telephone' => 'required_with:client|string|max:10',
            'client.cin' => 'required_with:client|string|max:12',

            'reservation' => 'required|array',
            'reservation.date_debut' => 'required|date|after_or_equal:today',
            'reservation.date_fin' => 'required|date|after:date_debut',
            'reservation.nombre_personnes' => 'required|integer|min:1',
            'reservation.type' => 'required|in:en_ligne,sur_place,par_telephone',
            'reservation.chambre_ids' => 'required|array|min:1', 'reservation.chambre_ids.*' => 'integer|exists:chambres,id',

            'paiement' => 'required|array',
            'paiement.montant' => 'required|integer|min:1',
            'paiement.mode' => 'required|string|in:espece,Mvola',
            'paiement.telephone' => 'nullable|string|max:10|required_if:mode,Mvola',
        ];
    }
}
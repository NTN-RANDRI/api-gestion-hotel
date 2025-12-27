<?php

namespace App\Http\Requests\Chambre;

use Illuminate\Foundation\Http\FormRequest;

class AddImageChambreRequest extends FormRequest
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
            'chambre_id' => 'required|integer|exists:chambres,id',
            'image' => 'required|file|mimes:jpg,jpeg,png|max:5120'
        ];
    }
}

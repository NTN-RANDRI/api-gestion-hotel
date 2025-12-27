<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterClientRequest extends FormRequest
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
            'user' => 'required',
            'user.email' => 'required|email|unique:users,email',
            'user.password' => 'required|string|min:6',

            'client' => 'required',
            'client.nom' => 'required|string|max:100', 
            'client.prenom' => 'required|string|max:100',
            'client.telephone' => 'required|string|max:12',
            'client.cin' => 'required|string|max:12'
        ];
    }
}

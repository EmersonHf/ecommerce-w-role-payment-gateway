<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientsStoreRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'telefone' => 'required|string|max:20',
            'cover' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the "cover" field as an image.
            // Add other validation rules for your client form fields.
        ];
    }
}

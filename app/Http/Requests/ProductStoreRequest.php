<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        
        return [
          'name'=>'required|string',
          'price'=>'required|numeric',
          'stock'=>'nullable|integer',
          'cover'=>'nullable|file',
          'description'=> 'nullable|string',
          'role_id'=>'required',
          'user_id'=>'required'
        ];
    }
}

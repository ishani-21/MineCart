<?php

namespace App\Http\Requests\Seller;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'en_name' => 'required|unique:stores',
            'ar_name' => 'required|unique:stores',
            'email' => 'required|email|unique:stores',
            'en_description' => 'required',
            'ar_description' => 'required',
        ];
    }
}

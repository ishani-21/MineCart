<?php

namespace App\Http\Requests\Seller;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStoreRequest extends FormRequest
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
        $id = $this->id;
        return [
            'en_name' => 'required',
            'ar_name' => 'required',
            'email' => 'required|email|unique:stores,email,'.$id,
            'en_description' => 'required',
            'ar_description' => 'required',
        ];
    }
}

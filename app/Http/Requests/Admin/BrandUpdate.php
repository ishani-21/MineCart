<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BrandUpdate extends FormRequest
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
            'en_name' => 'required|alpha|unique:brands,en_name,'.$id,
            'ar_name' => 'required|alpha|unique:brands,ar_name,'.$id,
        ];
    }
    public function messages()
    {
        return [
            'en_name.required' => 'Please enter english name',
            'ar_name.required' => 'Please enter arrabic name',
            'en_name.alpha' => 'Please Enter only Characters.',
            'ar_name.alpha' => 'Please Enter only Characters.',
        ];
    }
}

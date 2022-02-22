<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'en_name' => 'required|unique:categories,en_name,'.$id,
            'ar_name' => 'required|unique:categories,en_name,'.$id,
            'parent_id' => 'required',
            'commission' => 'required|regex:/^\d+(\.\d{1,2})?$/|numeric',
        ];
    }
    public function messages()
    {
        return [
            'en_name.required' => 'Please enter english name',
            'ar_name.required' => 'Please enter arrabic name',
            'en_name.unique' => 'This name is alerady exist.',
            'ar_name.unique' => 'This name is alerady exist.',
            'commission.regex' => 'Please Enter only numeric',
            'commission.numeric' => 'Please Enter only numeric',
            'parent_id.required' => 'Please select any one',
        ];
    }
}

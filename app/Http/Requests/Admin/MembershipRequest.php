<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MembershipRequest extends FormRequest
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
            'en_package_name' => 'required|regex:/^[\pL\s\-]+$/u|unique:membership_plans,en_package_name,' . $id,
            'ar_package_name' => 'required|regex:/^[\pL\s\-]+$/u|unique:membership_plans,ar_package_name,' . $id,
            'price'           => 'required',
            'duration'        => 'required',
            'en_discription'  => 'required',
            'ar_discription'  => 'required',
        ];
    }

    public function messages()
    {
        return [
            'en_package_name.required' => 'Please enter english package name',
            'ar_package_name.required' => 'Please enter arrabic package name',
            'en_package_name.regex'    => 'Please Enter only character',
            'ar_package_name.regex'    => 'Please Enter only character',
            'en_package_name.unique'   => 'This package name is alerady exist.',
            'ar_package_name.unique'   => 'This package name is alerady exist.',
            'en_discription.required'  => 'Please enter english discription',
            'ar_discription.required'  => 'Please enter arrabic discription',
        ];
    }
}

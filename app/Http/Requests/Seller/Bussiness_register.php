<?php

namespace App\Http\Requests\Seller;

use Illuminate\Foundation\Http\FormRequest;

class Bussiness_register extends FormRequest
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
            'business_name' => 'required',
                'email' => 'required|email|unique:sellers,email',
                'mobile' => 'required',
                'website' => 'required',
                'register_number' => 'required',
                'b_password' => 'required|min:3|max:30',
                'cpassword' => 'required|min:3|max:30|same:b_password'
        ];
    }

    // public function messages()
    // {
    //     return [
    //         'business_name.required' => 'Please Enter Name',
    //         'email.required' => 'Please Enter Email',
    //         'mobile.required' => 'Please Enter Mobile No',
    //         'website.required' => 'Please Enter Website',
    //         'website.regex' => 'Please Enter valid url',
    //         'register_number.required' => 'Please Enter register number',
    //         'b_password.required' => 'Please Enter Password',
    //         'cpassword.required' => 'Please Enter Confirm Password',
    //         'cpassword.same' => 'The Confirm password And password must match.'
    //     ];
    // }
}

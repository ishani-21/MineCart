<?php

namespace App\Http\Requests\Seller;

use Illuminate\Foundation\Http\FormRequest;

class ForgotRequest extends FormRequest
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
            'email' => 'required',
            'password' => 'required|min:6',
            'cpassword' => 'required|same:password'
        ];

    }
    public function messages()
    {
        return [
            'email.exists' => 'This email is not exists on sellers table',
            'password.required' => 'Please Enter Password',
            'cpassword.required' => 'Please Enter Confirm Password',
            'cpassword.same' => 'The Confirm password And password must match.'
        ];
    }
}

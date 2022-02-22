<?php

namespace App\Http\Requests\Seller;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'fname' => 'required|regex:/(^([a-zA-z ]+)(\d+)?$)/u',
            'lname' => 'required|regex:/(^([a-zA-z ]+)(\d+)?$)/u',
            'email' => 'required|string|email|max:255|regex:/(.+)@(.+)\.(.+)/i|unique:sellers',
            'mobile' => 'required|max:10|min:10',
        ];
    }

    public function messages()
    {
        return [
            'fname.required' => 'Please Enter First Name',
            'fname.regex' => 'Please Enter only Characters',
            'lname.required' => 'Please Enter Last Name',
            'lname.regex' => 'Please Enter only Characters',
            'email.required' => 'Please Enter Your Email Address',
            'mobile.required' => 'Please Enter Your Mobile Number',
        ];
    }
}

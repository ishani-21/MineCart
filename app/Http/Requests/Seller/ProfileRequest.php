<?php

namespace App\Http\Requests\Seller;

use App\Models\Seller;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProfileRequest extends FormRequest
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
            'fname' => 'required|regex:/(^([a-zA-z ]+)(\d+)?$)/u',
            'lname' => 'required|regex:/(^([a-zA-z ]+)(\d+)?$)/u',
            'email' => 'required|email|unique:sellers,email,'.$id,
            'mobile' => 'required|max:10|min:10',
            'country' => 'required|not-in:0',
            'state' => 'required|not-in:0',
            'city' => 'required|not-in:0',
        ];
    }
    // |unique:sellers,email,' . $seller['id']
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

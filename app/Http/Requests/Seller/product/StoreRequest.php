<?php

namespace App\Http\Requests\Seller\product;

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
            'brand_id' => 'required|not_in:0',
            'categories_id' => 'required|not_in:0',
            'cover_image' => 'required',
            'images.*' => 'required',
            'en_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'ar_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'cost_price' => 'required|numeric',
            'regular_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'total_qty' => 'required|numeric',
            'available_stock' => 'required|numeric',
            'en_description' => 'required',
            'ar_description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'brand_id.required' => 'Please select Brand',
            'categories_id.required' => 'Please select Category',
            'cover_image.required' => 'Please select Image',
            'en_name.required' => 'Please Enter Name',
            'en_name.regex' => 'Please Enter only character',
            'ar_name.required' => 'Please Enter Name',
            'ar_name.regex' => 'Please Enter only character',
            'cost_price.required' => 'Please Enter Cost Price',
            'cost_price.numeric' => 'Please Enter Only Number',
            'regular_price.required' => 'Please Enter Regular Price',
            'regular_price.numeric' => 'Please Enter Only Number',
            'sale_price.required' => 'Please Enter Sale Price',
            'sale_price.numeric' => 'Please Enter Only Number',
            'total_qty.required' => 'Please Enter Quantity',
            'available_stock.required' => 'Please Enter Quantity',
            'total_qty.numeric' => 'Please Enter Only Number',
            'available_stock.numeric' => 'Please Enter Only Number',
            'en_description.required' => 'Please Entert Description',
            'ar_description.required' => 'Please Entert Description',
        ];
    }
}

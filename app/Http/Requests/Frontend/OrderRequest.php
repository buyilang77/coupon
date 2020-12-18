<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'coupon_id' => 'required|integer|exist:coupons',
            'consignee' => 'required|string|max:20',
            'code'      => 'required|string',
            'password'  => 'required|string',
            'phone'     => [
                'required',
                'regex:/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199)\d{8}$/',
            ],
            'products'  => 'required|array',
            'region'    => 'required|array',
            'address'   => 'required|string|max:100',
        ];
    }
}

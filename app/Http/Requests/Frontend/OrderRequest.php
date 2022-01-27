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
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'coupon_id'        => 'required|integer',
            'store_id'         => 'nullable|integer',
            'consignee'        => 'nullable|string|max:20',
            'code'             => 'nullable|string',
            'password'         => 'nullable|string',
            'phone'            => [
                'required',
                'regex:/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|195|198|199)\d{8}$/',
            ],
            'product_id'       => 'required|integer',
            'region'           => 'nullable|array',
            'address'          => 'nullable|string|max:100',
            'remark'           => 'nullable|string|max:100',
            'appointment_time' => 'nullable|string',
            'type'             => 'required',
        ];
    }
}

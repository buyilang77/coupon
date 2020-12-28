<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MerchantRequest extends FormRequest
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
            'username'      => 'string|max:20|nullable',
            'merchant_name' => 'string|max:20|nullable',
            'surname'       => 'string|max:10|nullable',
            'phone'         => [
                'required',
                'regex:/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199)\d{8}$/',
            ],
            'region'        => 'required|array',
            'address'       => 'required|string|max:100',
            'status'        => 'required|in:0,1',
        ];
    }
}

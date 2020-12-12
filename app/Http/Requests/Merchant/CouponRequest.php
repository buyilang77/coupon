<?php

namespace App\Http\Requests\Merchant;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
            'title'                => 'required|string|max:200',
            'services_phone'       => 'required|string|max:15',
            'activity_description' => 'required|string|max:200',
            'products'             => 'required|array',
            'start_time'           => 'required|date',
            'end_time'             => 'required|date',
            'prefix'               => 'required|string|max:15',
            'start_number'         => 'required|integer|max:10000000000000000',
            'quantity'             => 'required|integer|max:100000',
            'length'               => 'required|integer|max:20',
            'status'               => 'required|integer|in:0,1',
        ];
    }
}

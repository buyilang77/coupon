<?php

namespace App\Http\Requests\Merchant;

use Illuminate\Foundation\Http\FormRequest;

class CouponItemRequest extends FormRequest
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
            'status' => 'required|integer|in:0,1',
            'item'   => 'integer',
            'items'  => 'array',
            'type'   => 'required|integer|in:1,2', // 1: 单条更新, 2: 批量更新
        ];
    }
}

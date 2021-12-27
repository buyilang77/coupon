<?php

namespace App\Http\Requests\Merchant;

use Illuminate\Foundation\Http\FormRequest;

class RechargeCardRequest extends FormRequest
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
            'name'                 => 'required|string|max:200',
            'price'                => 'required|numeric',
            'denomination'         => 'required|numeric',
            'type'                 => 'required|integer',
            'is_online'            => 'required|integer',
            'carousel'             => 'array|nullable',
            'delivery_type'        => 'required|array',
            'remark'               => 'string|nullable',
            'activity_description' => 'string|nullable',
        ];
    }
}

<?php

namespace App\Http\Requests\Merchant;

use Illuminate\Foundation\Http\FormRequest;

class RechargeCardItemRequest extends FormRequest
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
            'prefix'        => 'string|max:15|nullable',
            'start_number' => 'required|integer|max:10000000000000000',
            'quantity'     => 'required|integer|max:100000',
            'length'       => 'required|integer|between:4,12',
            'status'       => 'required|integer|in:0,1',
        ];
    }
}

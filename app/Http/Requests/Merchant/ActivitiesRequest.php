<?php

namespace App\Http\Requests\Merchant;

use Illuminate\Foundation\Http\FormRequest;

class ActivitiesRequest extends FormRequest
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
            'price'                => 'required|numeric',
            'original_price'       => 'required|numeric',
            'title'                => 'required|string|max:200',
            'services_phone'       => 'string|max:15|nullable',
            'activity_description' => 'string|nullable',
            'products'             => 'required|array',
//            'status'               => 'required|integer|in:0,1',
        ];
    }
}

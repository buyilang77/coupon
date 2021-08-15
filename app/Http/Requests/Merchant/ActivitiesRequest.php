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
            'price'                => 'required|string',
            'title'                => 'required|string|max:200',
            'services_phone'       => 'string|max:15|nullable',
            'activity_description' => 'string|max:200|nullable',
            'products'             => 'required|array',
            'start_time'           => 'required|date',
            'end_time'             => 'required|date',
            'status'               => 'required|integer|in:0,1',
        ];
    }
}

<?php

namespace App\Http\Requests\Merchant;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $rule = [
            'surname'       => 'max:15',
            'merchant_name' => 'max:20',
            'region'        => 'required|array',
            'address'       => 'max:200',
        ];
        switch ($this->method()) {
            case 'POST':
                return array_merge($rule, [
                    'username'     => 'required|between:6,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:merchants,username',
                    'password' => 'required|alpha_dash|min:6',
                    'phone'    => [
                        'required',
                        'regex:/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199)\d{8}$/',
                        'unique:merchants,phone',
                    ],
                ]);
                break;
            case 'PATCH':
                return array_merge($rule, [
                    'username'  => 'between:6,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:merchants,name',
                    'phone' => [
                        'regex:/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199)\d{8}$/',
                        'unique:merchants,phone',
                    ],
                ]);
                break;
        }
        return $rule;
    }
}

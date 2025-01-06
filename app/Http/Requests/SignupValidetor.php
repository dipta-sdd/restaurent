<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupValidetor extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|string|email|unique:users|max:255',
            'phone' => 'nullable|string|unique:users|max:11',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'nullable|string|max:20',
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!$this->email && !$this->phone) {
                $validator->errors()->add('email', 'Either email or phone is required.');
                $validator->errors()->add('phone', 'Either email or phone is required.');
            }
        });
    }
}

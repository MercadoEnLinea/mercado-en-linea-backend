<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegistrationRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|string|min:8',
            'phone' => 'required|max:10|unique:users'
        ];
    }
}

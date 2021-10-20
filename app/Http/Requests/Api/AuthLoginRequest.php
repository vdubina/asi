<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class AuthLoginRequest extends FormRequest
{

    /**
     * @return \string[][]
     */
    public function rules()
    {
        return [
            'username' => [
                'string',
                'required',
                'min:6',
                'max:60',
            ],
            'password' => [
                'string',
                'required',
                'min:8',
                'max:60',
            ],
        ];
    }
}

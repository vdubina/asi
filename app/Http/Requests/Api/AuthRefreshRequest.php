<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class AuthRefreshRequest extends FormRequest
{

    /**
     * @return \string[][]
     */
    public function rules()
    {
        return [
            'refresh_token' => [
                'string',
                'required',
                'min:6',
                'max:2048',
            ],
        ];
    }
}

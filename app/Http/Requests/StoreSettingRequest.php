<?php

namespace App\Http\Requests;

use App\Models\Setting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSettingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('setting_create');
    }

    public function rules()
    {
        return [
            'key' => [
                'string',
                'min:2',
                'max:80',
                'required',
                'unique:settings',
            ],
            'value' => [
                'string',
                'required',
            ],
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Models\TaxonomyArmsCode;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTaxonomyArmsCodeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('taxonomy_arms_code_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'min:2',
                'max:30',
                'required',
            ],
            'field_offsiteid' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'unique:taxonomy_arms_codes,field_offsiteid',
            ],
            'field_arms_category_id' => [
                'required',
                'integer',
            ],
        ];
    }
}

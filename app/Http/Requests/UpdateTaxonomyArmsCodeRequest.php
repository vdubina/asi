<?php

namespace App\Http\Requests;

use App\Models\TaxonomyArmsCode;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTaxonomyArmsCodeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('taxonomy_arms_code_edit');
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
                'unique:taxonomy_arms_codes,field_offsiteid,' . request()->route('taxonomy_arms_code')->id,
            ],
            'field_arms_category_id' => [
                'required',
                'integer',
            ],
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Models\TaxonomyPhoneType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTaxonomyPhoneTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('taxonomy_phone_type_create');
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
                'unique:taxonomy_phone_types,field_offsiteid',
            ],
        ];
    }
}

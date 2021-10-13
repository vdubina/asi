<?php

namespace App\Http\Requests;

use App\Models\TaxonomyProfession;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTaxonomyProfessionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('taxonomy_profession_create');
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
                'unique:taxonomy_professions,field_offsiteid',
            ],
            'field_salutation' => [
                'string',
                'nullable',
            ],
            'field_ad_customer_category' => [
                'string',
                'nullable',
            ],
        ];
    }
}

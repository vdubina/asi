<?php

namespace App\Http\Requests;

use App\Models\TaxonomyPracticeType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTaxonomyPracticeTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('taxonomy_practice_type_edit');
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
                'unique:taxonomy_practice_types,field_offsiteid,' . request()->route('taxonomy_practice_type')->id,
            ],
        ];
    }
}

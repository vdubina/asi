<?php

namespace App\Http\Requests;

use App\Models\TaxonomyCertificationType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTaxonomyCertificationTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('taxonomy_certification_type_edit');
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
                'unique:taxonomy_certification_types,field_offsiteid,' . request()->route('taxonomy_certification_type')->id,
            ],
        ];
    }
}

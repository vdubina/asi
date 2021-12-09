<?php

namespace App\Http\Requests;

use App\Models\TaxonomyTopicSelectionType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTaxonomyTopicSelectionTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('taxonomy_topic_selection_type_create');
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
                'unique:taxonomy_topic_selection_types,field_offsiteid',
            ],
            'field_sort_order' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}

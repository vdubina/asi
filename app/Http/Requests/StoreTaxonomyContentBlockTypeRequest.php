<?php

namespace App\Http\Requests;

use App\Models\TaxonomyContentBlockType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTaxonomyContentBlockTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('taxonomy_content_block_type_create');
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
            'fa_icon' => [
                'string',
                'min:2',
                'max:60',
                'nullable',
            ],
        ];
    }
}

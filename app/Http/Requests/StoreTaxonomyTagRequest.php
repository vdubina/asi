<?php

namespace App\Http\Requests;

use App\Models\TaxonomyTag;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTaxonomyTagRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('taxonomy_tag_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Models\TaxonomyTag;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTaxonomyTagRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('content_tag_edit');
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

<?php

namespace App\Http\Requests;

use App\Models\TaxonomyTag;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTaxonomyTagRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('taxonomy_tag_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:content_tags,id',
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Models\TaxonomyTopicSelectionType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTaxonomyTopicSelectionTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('taxonomy_topic_selection_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:taxonomy_topic_selection_types,id',
        ];
    }
}

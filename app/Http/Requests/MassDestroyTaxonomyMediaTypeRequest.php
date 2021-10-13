<?php

namespace App\Http\Requests;

use App\Models\TaxonomyMediaType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTaxonomyMediaTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('taxonomy_media_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:taxonomy_media_types,id',
        ];
    }
}

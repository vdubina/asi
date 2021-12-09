<?php

namespace App\Http\Requests;

use App\Models\TaxonomyCourseFullShort;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTaxonomyCourseFullShortRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('taxonomy_course_full_short_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:taxonomy_course_full_shorts,id',
        ];
    }
}

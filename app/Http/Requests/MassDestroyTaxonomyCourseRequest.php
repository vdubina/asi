<?php

namespace App\Http\Requests;

use App\Models\TaxonomyCourse;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTaxonomyCourseRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('taxonomy_course_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:taxonomy_courses,id',
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Models\TaxonomyCourse;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTaxonomyCourseRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('taxonomy_course_edit');
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
            'field_dental_report_text' => [
                'string',
                'nullable',
            ],
        ];
    }
}

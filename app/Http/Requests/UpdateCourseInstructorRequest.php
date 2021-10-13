<?php

namespace App\Http\Requests;

use App\Models\CourseInstructor;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCourseInstructorRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('course_instructor_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'field_course_products.*' => [
                'integer',
            ],
            'field_course_products' => [
                'array',
            ],
        ];
    }
}

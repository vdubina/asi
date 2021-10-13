<?php

namespace App\Http\Requests;

use App\Models\CourseTopic;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCourseTopicRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('course_topic_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'field_offsiteid' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'unique:course_topics,field_offsiteid',
            ],
            'field_ad_code' => [
                'string',
                'nullable',
            ],
            'field_supplier_code' => [
                'string',
                'nullable',
            ],
            'field_position' => [
                'string',
                'nullable',
            ],
            'field_volume' => [
                'string',
                'nullable',
            ],
            'field_issue' => [
                'string',
                'nullable',
            ],
            'field_course_type_id' => [
                'required',
                'integer',
            ],
            'field_media_provider_topic' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'field_aana_expiration_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'field_expiration_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}

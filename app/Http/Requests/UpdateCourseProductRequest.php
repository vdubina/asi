<?php

namespace App\Http\Requests;

use App\Models\CourseProduct;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCourseProductRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('course_product_edit');
    }

    public function rules()
    {
        return [
            'sku' => [
                'string',
                'min:2',
                'max:20',
                'required',
            ],
            'title' => [
                'string',
                'required',
            ],
            'commerce_price' => [
                'required',
            ],
            'field_course_length' => [
                'required',
            ],
            'field_offsiteid' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'unique:course_products,field_offsiteid,' . request()->route('course_product')->id,
            ],
            'field_supplier_code' => [
                'string',
                'required',
            ],
            'field_dental_report_text' => [
                'string',
                'nullable',
            ],
            'field_download_availability' => [
                'string',
                'nullable',
            ],
            'field_standard_credit_hours' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'field_course_type_id' => [
                'required',
                'integer',
            ],
            'field_course_credit_type_id' => [
                'required',
                'integer',
            ],
            'field_practice_type_id' => [
                'required',
                'integer',
            ],
            'field_media_provider_id' => [
                'required',
                'integer',
            ],
            'field_media_delivery_type_id' => [
                'required',
                'integer',
            ],
            'field_web_category_id' => [
                'required',
                'integer',
            ],
            'field_topics_nodes.*' => [
                'integer',
            ],
            'field_topics_nodes' => [
                'array',
            ],
        ];
    }
}

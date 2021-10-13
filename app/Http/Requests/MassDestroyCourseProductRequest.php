<?php

namespace App\Http\Requests;

use App\Models\CourseProduct;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCourseProductRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('course_product_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:course_products,id',
        ];
    }
}

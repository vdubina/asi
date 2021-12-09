<?php

namespace App\Http\Requests;

use App\Models\TestimonialType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTestimonialTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('testimonial_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:testimonial_types,id',
        ];
    }
}

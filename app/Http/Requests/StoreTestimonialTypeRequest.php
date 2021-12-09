<?php

namespace App\Http\Requests;

use App\Models\TestimonialType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTestimonialTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('testimonial_type_create');
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
        ];
    }
}

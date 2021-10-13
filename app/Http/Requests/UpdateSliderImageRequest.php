<?php

namespace App\Http\Requests;

use App\Models\SliderImage;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSliderImageRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('slider_image_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'field_sliders.*' => [
                'integer',
            ],
            'field_sliders' => [
                'array',
            ],
            'field_weight' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}

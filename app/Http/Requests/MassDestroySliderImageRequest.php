<?php

namespace App\Http\Requests;

use App\Models\SliderImage;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySliderImageRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('slider_image_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:slider_images,id',
        ];
    }
}

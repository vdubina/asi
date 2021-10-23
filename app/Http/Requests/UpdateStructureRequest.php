<?php

namespace App\Http\Requests;

use App\Models\Structure;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateStructureRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('structure_edit');
    }

    public function rules()
    {
        return [
            'label' => [
                'string',
                'min:2',
                'max:60',
                'required',
            ],
            'type' => [
                'required',
            ],
            'link' => [
                'string',
                'nullable',
            ],
        ];
    }
}

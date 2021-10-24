<?php

namespace App\Http\Requests;

use App\Models\ContentBlock;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateContentBlockRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('content_block_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'type_id' => [
                'required',
                'integer',
            ],
            'show_on_pages.*' => [
                'integer',
            ],
            'show_on_pages' => [
                'array',
            ],
        ];
    }
}

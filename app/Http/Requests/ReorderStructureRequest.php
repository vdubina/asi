<?php

namespace App\Http\Requests;

use App\Models\Structure;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class ReorderStructureRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('structure_edit');
    }

    public function rules()
    {
        return [
            'tree.*' => [
                'required',
                'array:item_id,parent_id,depth,left,right',
            ],
            'tree.*.item_id' => [
                'integer',
                'nullable',
            ],
            'tree.*.parent_id' => [
                'integer',
                'nullable',
            ],
            'tree.*.depth' => [
                'required',
                'integer',
            ],
            'tree.*.left' => [
                'required',
                'integer',
            ],
            'tree.*.right' => [
                'required',
                'integer',
            ],
        ];
    }
}

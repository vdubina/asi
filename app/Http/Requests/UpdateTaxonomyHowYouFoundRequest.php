<?php

namespace App\Http\Requests;

use App\Models\TaxonomyHowYouFound;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTaxonomyHowYouFoundRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('taxonomy_how_you_found_edit');
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
            'field_offsiteid' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'unique:taxonomy_how_you_founds,field_offsiteid,' . request()->route('taxonomy_how_you_found')->id,
            ],
        ];
    }
}

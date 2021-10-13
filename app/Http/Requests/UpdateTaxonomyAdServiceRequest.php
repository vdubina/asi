<?php

namespace App\Http\Requests;

use App\Models\TaxonomyAdService;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTaxonomyAdServiceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('taxonomy_ad_service_edit');
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
                'unique:taxonomy_ad_services,field_offsiteid,' . request()->route('taxonomy_ad_service')->id,
            ],
            'field_ad_service_code' => [
                'string',
                'required',
            ],
        ];
    }
}

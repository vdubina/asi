<?php

namespace App\Http\Requests;

use App\Models\TaxonomyMediaDelivery;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTaxonomyMediaDeliveryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('taxonomy_media_delivery_edit');
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
            ],
        ];
    }
}

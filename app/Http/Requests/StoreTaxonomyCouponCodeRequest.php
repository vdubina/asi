<?php

namespace App\Http\Requests;

use App\Models\TaxonomyCouponCode;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTaxonomyCouponCodeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('taxonomy_coupon_code_create');
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
                'unique:taxonomy_coupon_codes,field_offsiteid',
            ],
            'field_value' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'field_type' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'field_max_uses' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'field_date_start' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'field_date_end' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}

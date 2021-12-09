<?php

namespace App\Http\Requests;

use App\Models\TaxonomyCouponCode;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTaxonomyCouponCodeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('taxonomy_coupon_code_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:taxonomy_coupon_codes,id',
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Models\TaxonomyDiscountType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTaxonomyDiscountTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('taxonomy_discount_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:taxonomy_discount_types,id',
        ];
    }
}

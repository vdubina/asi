<?php

namespace App\Http\Requests;

use App\Models\TaxonomyPaymentType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTaxonomyPaymentTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('taxonomy_payment_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:taxonomy_payment_types,id',
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Models\TaxonomyAddressType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTaxonomyAddressTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('taxonomy_address_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:taxonomy_address_types,id',
        ];
    }
}

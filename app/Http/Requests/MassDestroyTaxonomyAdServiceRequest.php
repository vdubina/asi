<?php

namespace App\Http\Requests;

use App\Models\TaxonomyAdService;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTaxonomyAdServiceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('taxonomy_ad_service_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:taxonomy_ad_services,id',
        ];
    }
}

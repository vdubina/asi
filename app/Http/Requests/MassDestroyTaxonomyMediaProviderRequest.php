<?php

namespace App\Http\Requests;

use App\Models\TaxonomyMediaProvider;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTaxonomyMediaProviderRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('taxonomy_media_provider_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:taxonomy_media_providers,id',
        ];
    }
}

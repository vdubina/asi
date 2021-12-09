<?php

namespace App\Http\Requests;

use App\Models\TaxonomyHowYouFound;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTaxonomyHowYouFoundRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('taxonomy_how_you_found_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:taxonomy_how_you_founds,id',
        ];
    }
}

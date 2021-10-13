<?php

namespace App\Http\Requests;

use App\Models\TaxonomyProfession;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTaxonomyProfessionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('taxonomy_profession_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:taxonomy_professions,id',
        ];
    }
}

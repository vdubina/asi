<?php

namespace App\Http\Requests;

use App\Models\TaxonomyWebCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTaxonomyWebCategoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('taxonomy_web_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:taxonomy_web_categories,id',
        ];
    }
}

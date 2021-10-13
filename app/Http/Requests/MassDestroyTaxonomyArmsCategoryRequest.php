<?php

namespace App\Http\Requests;

use App\Models\TaxonomyArmsCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTaxonomyArmsCategoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('taxonomy_arms_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:taxonomy_arms_categories,id',
        ];
    }
}

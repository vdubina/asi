<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTaxonomyArmsCategoryRequest;
use App\Http\Requests\StoreTaxonomyArmsCategoryRequest;
use App\Http\Requests\UpdateTaxonomyArmsCategoryRequest;
use App\Models\TaxonomyArmsCategory;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class TaxonomyArmsCategoryController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('taxonomy_arms_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyArmsCategories = TaxonomyArmsCategory::all();

        return view('admin.taxonomyArmsCategories.index', compact('taxonomyArmsCategories'));
    }

    public function create()
    {
        abort_if(Gate::denies('taxonomy_arms_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyArmsCategories.create');
    }

    public function store(StoreTaxonomyArmsCategoryRequest $request)
    {
        $taxonomyArmsCategory = TaxonomyArmsCategory::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $taxonomyArmsCategory->id]);
        }

        return redirect()->route('admin.taxonomy-arms-categories.index');
    }

    public function edit(TaxonomyArmsCategory $taxonomyArmsCategory)
    {
        abort_if(Gate::denies('taxonomy_arms_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyArmsCategories.edit', compact('taxonomyArmsCategory'));
    }

    public function update(UpdateTaxonomyArmsCategoryRequest $request, TaxonomyArmsCategory $taxonomyArmsCategory)
    {
        $taxonomyArmsCategory->update($request->all());

        return redirect()->route('admin.taxonomy-arms-categories.index');
    }

    public function show(TaxonomyArmsCategory $taxonomyArmsCategory)
    {
        abort_if(Gate::denies('taxonomy_arms_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyArmsCategory->load('fieldArmsCategoryTaxonomyArmsCodes');

        return view('admin.taxonomyArmsCategories.show', compact('taxonomyArmsCategory'));
    }

    public function destroy(TaxonomyArmsCategory $taxonomyArmsCategory)
    {
        abort_if(Gate::denies('taxonomy_arms_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyArmsCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyTaxonomyArmsCategoryRequest $request)
    {
        TaxonomyArmsCategory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('taxonomy_arms_category_create') && Gate::denies('taxonomy_arms_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new TaxonomyArmsCategory();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

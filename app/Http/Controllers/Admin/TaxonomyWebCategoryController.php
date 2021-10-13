<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTaxonomyWebCategoryRequest;
use App\Http\Requests\StoreTaxonomyWebCategoryRequest;
use App\Http\Requests\UpdateTaxonomyWebCategoryRequest;
use App\Models\TaxonomyPracticeType;
use App\Models\TaxonomyWebCategory;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class TaxonomyWebCategoryController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('taxonomy_web_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyWebCategories = TaxonomyWebCategory::with(['field_practice_type'])->get();

        return view('admin.taxonomyWebCategories.index', compact('taxonomyWebCategories'));
    }

    public function create()
    {
        abort_if(Gate::denies('taxonomy_web_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $field_practice_types = TaxonomyPracticeType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.taxonomyWebCategories.create', compact('field_practice_types'));
    }

    public function store(StoreTaxonomyWebCategoryRequest $request)
    {
        $taxonomyWebCategory = TaxonomyWebCategory::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $taxonomyWebCategory->id]);
        }

        return redirect()->route('admin.taxonomy-web-categories.index');
    }

    public function edit(TaxonomyWebCategory $taxonomyWebCategory)
    {
        abort_if(Gate::denies('taxonomy_web_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $field_practice_types = TaxonomyPracticeType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $taxonomyWebCategory->load('field_practice_type');

        return view('admin.taxonomyWebCategories.edit', compact('field_practice_types', 'taxonomyWebCategory'));
    }

    public function update(UpdateTaxonomyWebCategoryRequest $request, TaxonomyWebCategory $taxonomyWebCategory)
    {
        $taxonomyWebCategory->update($request->all());

        return redirect()->route('admin.taxonomy-web-categories.index');
    }

    public function show(TaxonomyWebCategory $taxonomyWebCategory)
    {
        abort_if(Gate::denies('taxonomy_web_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyWebCategory->load('field_practice_type', 'fieldWebCategoryCourseTopics', 'fieldWebCategoryCourseProducts');

        return view('admin.taxonomyWebCategories.show', compact('taxonomyWebCategory'));
    }

    public function destroy(TaxonomyWebCategory $taxonomyWebCategory)
    {
        abort_if(Gate::denies('taxonomy_web_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyWebCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyTaxonomyWebCategoryRequest $request)
    {
        TaxonomyWebCategory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('taxonomy_web_category_create') && Gate::denies('taxonomy_web_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new TaxonomyWebCategory();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

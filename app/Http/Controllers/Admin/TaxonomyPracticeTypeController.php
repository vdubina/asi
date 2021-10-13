<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTaxonomyPracticeTypeRequest;
use App\Http\Requests\StoreTaxonomyPracticeTypeRequest;
use App\Http\Requests\UpdateTaxonomyPracticeTypeRequest;
use App\Models\TaxonomyPracticeType;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class TaxonomyPracticeTypeController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('taxonomy_practice_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyPracticeTypes = TaxonomyPracticeType::all();

        return view('admin.taxonomyPracticeTypes.index', compact('taxonomyPracticeTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('taxonomy_practice_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyPracticeTypes.create');
    }

    public function store(StoreTaxonomyPracticeTypeRequest $request)
    {
        $taxonomyPracticeType = TaxonomyPracticeType::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $taxonomyPracticeType->id]);
        }

        return redirect()->route('admin.taxonomy-practice-types.index');
    }

    public function edit(TaxonomyPracticeType $taxonomyPracticeType)
    {
        abort_if(Gate::denies('taxonomy_practice_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyPracticeTypes.edit', compact('taxonomyPracticeType'));
    }

    public function update(UpdateTaxonomyPracticeTypeRequest $request, TaxonomyPracticeType $taxonomyPracticeType)
    {
        $taxonomyPracticeType->update($request->all());

        return redirect()->route('admin.taxonomy-practice-types.index');
    }

    public function show(TaxonomyPracticeType $taxonomyPracticeType)
    {
        abort_if(Gate::denies('taxonomy_practice_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyPracticeType->load('fieldPracticeTypeTaxonomyWebCategories', 'fieldPracticeTypeCourseTopics', 'fieldPracticeTypeCourseProducts');

        return view('admin.taxonomyPracticeTypes.show', compact('taxonomyPracticeType'));
    }

    public function destroy(TaxonomyPracticeType $taxonomyPracticeType)
    {
        abort_if(Gate::denies('taxonomy_practice_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyPracticeType->delete();

        return back();
    }

    public function massDestroy(MassDestroyTaxonomyPracticeTypeRequest $request)
    {
        TaxonomyPracticeType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('taxonomy_practice_type_create') && Gate::denies('taxonomy_practice_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new TaxonomyPracticeType();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

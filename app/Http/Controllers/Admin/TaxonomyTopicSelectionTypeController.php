<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTaxonomyTopicSelectionTypeRequest;
use App\Http\Requests\StoreTaxonomyTopicSelectionTypeRequest;
use App\Http\Requests\UpdateTaxonomyTopicSelectionTypeRequest;
use App\Models\TaxonomyTopicSelectionType;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class TaxonomyTopicSelectionTypeController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('taxonomy_topic_selection_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyTopicSelectionTypes = TaxonomyTopicSelectionType::all();

        return view('admin.taxonomyTopicSelectionTypes.index', compact('taxonomyTopicSelectionTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('taxonomy_topic_selection_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyTopicSelectionTypes.create');
    }

    public function store(StoreTaxonomyTopicSelectionTypeRequest $request)
    {
        $taxonomyTopicSelectionType = TaxonomyTopicSelectionType::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $taxonomyTopicSelectionType->id]);
        }

        return redirect()->route('admin.taxonomy-topic-selection-types.index');
    }

    public function edit(TaxonomyTopicSelectionType $taxonomyTopicSelectionType)
    {
        abort_if(Gate::denies('taxonomy_topic_selection_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyTopicSelectionTypes.edit', compact('taxonomyTopicSelectionType'));
    }

    public function update(UpdateTaxonomyTopicSelectionTypeRequest $request, TaxonomyTopicSelectionType $taxonomyTopicSelectionType)
    {
        $taxonomyTopicSelectionType->update($request->all());

        return redirect()->route('admin.taxonomy-topic-selection-types.index');
    }

    public function show(TaxonomyTopicSelectionType $taxonomyTopicSelectionType)
    {
        abort_if(Gate::denies('taxonomy_topic_selection_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyTopicSelectionTypes.show', compact('taxonomyTopicSelectionType'));
    }

    public function destroy(TaxonomyTopicSelectionType $taxonomyTopicSelectionType)
    {
        abort_if(Gate::denies('taxonomy_topic_selection_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyTopicSelectionType->delete();

        return back();
    }

    public function massDestroy(MassDestroyTaxonomyTopicSelectionTypeRequest $request)
    {
        TaxonomyTopicSelectionType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('taxonomy_topic_selection_type_create') && Gate::denies('taxonomy_topic_selection_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new TaxonomyTopicSelectionType();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

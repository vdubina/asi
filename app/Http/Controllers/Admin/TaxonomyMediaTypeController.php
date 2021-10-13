<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTaxonomyMediaTypeRequest;
use App\Http\Requests\StoreTaxonomyMediaTypeRequest;
use App\Http\Requests\UpdateTaxonomyMediaTypeRequest;
use App\Models\TaxonomyMediaType;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class TaxonomyMediaTypeController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('taxonomy_media_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyMediaTypes = TaxonomyMediaType::all();

        return view('admin.taxonomyMediaTypes.index', compact('taxonomyMediaTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('taxonomy_media_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyMediaTypes.create');
    }

    public function store(StoreTaxonomyMediaTypeRequest $request)
    {
        $taxonomyMediaType = TaxonomyMediaType::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $taxonomyMediaType->id]);
        }

        return redirect()->route('admin.taxonomy-media-types.index');
    }

    public function edit(TaxonomyMediaType $taxonomyMediaType)
    {
        abort_if(Gate::denies('taxonomy_media_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyMediaTypes.edit', compact('taxonomyMediaType'));
    }

    public function update(UpdateTaxonomyMediaTypeRequest $request, TaxonomyMediaType $taxonomyMediaType)
    {
        $taxonomyMediaType->update($request->all());

        return redirect()->route('admin.taxonomy-media-types.index');
    }

    public function show(TaxonomyMediaType $taxonomyMediaType)
    {
        abort_if(Gate::denies('taxonomy_media_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyMediaTypes.show', compact('taxonomyMediaType'));
    }

    public function destroy(TaxonomyMediaType $taxonomyMediaType)
    {
        abort_if(Gate::denies('taxonomy_media_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyMediaType->delete();

        return back();
    }

    public function massDestroy(MassDestroyTaxonomyMediaTypeRequest $request)
    {
        TaxonomyMediaType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('taxonomy_media_type_create') && Gate::denies('taxonomy_media_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new TaxonomyMediaType();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

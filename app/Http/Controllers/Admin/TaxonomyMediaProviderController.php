<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTaxonomyMediaProviderRequest;
use App\Http\Requests\StoreTaxonomyMediaProviderRequest;
use App\Http\Requests\UpdateTaxonomyMediaProviderRequest;
use App\Models\TaxonomyMediaProvider;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class TaxonomyMediaProviderController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('taxonomy_media_provider_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyMediaProviders = TaxonomyMediaProvider::all();

        return view('admin.taxonomyMediaProviders.index', compact('taxonomyMediaProviders'));
    }

    public function create()
    {
        abort_if(Gate::denies('taxonomy_media_provider_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyMediaProviders.create');
    }

    public function store(StoreTaxonomyMediaProviderRequest $request)
    {
        $taxonomyMediaProvider = TaxonomyMediaProvider::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $taxonomyMediaProvider->id]);
        }

        return redirect()->route('admin.taxonomy-media-providers.index');
    }

    public function edit(TaxonomyMediaProvider $taxonomyMediaProvider)
    {
        abort_if(Gate::denies('taxonomy_media_provider_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyMediaProviders.edit', compact('taxonomyMediaProvider'));
    }

    public function update(UpdateTaxonomyMediaProviderRequest $request, TaxonomyMediaProvider $taxonomyMediaProvider)
    {
        $taxonomyMediaProvider->update($request->all());

        return redirect()->route('admin.taxonomy-media-providers.index');
    }

    public function show(TaxonomyMediaProvider $taxonomyMediaProvider)
    {
        abort_if(Gate::denies('taxonomy_media_provider_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyMediaProvider->load('fieldMediaProviderCourseTopics', 'fieldMediaProviderCourseProducts');

        return view('admin.taxonomyMediaProviders.show', compact('taxonomyMediaProvider'));
    }

    public function destroy(TaxonomyMediaProvider $taxonomyMediaProvider)
    {
        abort_if(Gate::denies('taxonomy_media_provider_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyMediaProvider->delete();

        return back();
    }

    public function massDestroy(MassDestroyTaxonomyMediaProviderRequest $request)
    {
        TaxonomyMediaProvider::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('taxonomy_media_provider_create') && Gate::denies('taxonomy_media_provider_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new TaxonomyMediaProvider();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

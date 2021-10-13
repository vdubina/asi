<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTaxonomyAdServiceRequest;
use App\Http\Requests\StoreTaxonomyAdServiceRequest;
use App\Http\Requests\UpdateTaxonomyAdServiceRequest;
use App\Models\TaxonomyAdService;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class TaxonomyAdServiceController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('taxonomy_ad_service_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyAdServices = TaxonomyAdService::all();

        return view('admin.taxonomyAdServices.index', compact('taxonomyAdServices'));
    }

    public function create()
    {
        abort_if(Gate::denies('taxonomy_ad_service_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyAdServices.create');
    }

    public function store(StoreTaxonomyAdServiceRequest $request)
    {
        $taxonomyAdService = TaxonomyAdService::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $taxonomyAdService->id]);
        }

        return redirect()->route('admin.taxonomy-ad-services.index');
    }

    public function edit(TaxonomyAdService $taxonomyAdService)
    {
        abort_if(Gate::denies('taxonomy_ad_service_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyAdServices.edit', compact('taxonomyAdService'));
    }

    public function update(UpdateTaxonomyAdServiceRequest $request, TaxonomyAdService $taxonomyAdService)
    {
        $taxonomyAdService->update($request->all());

        return redirect()->route('admin.taxonomy-ad-services.index');
    }

    public function show(TaxonomyAdService $taxonomyAdService)
    {
        abort_if(Gate::denies('taxonomy_ad_service_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyAdService->load('fieldAdServiceCourseTopics');

        return view('admin.taxonomyAdServices.show', compact('taxonomyAdService'));
    }

    public function destroy(TaxonomyAdService $taxonomyAdService)
    {
        abort_if(Gate::denies('taxonomy_ad_service_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyAdService->delete();

        return back();
    }

    public function massDestroy(MassDestroyTaxonomyAdServiceRequest $request)
    {
        TaxonomyAdService::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('taxonomy_ad_service_create') && Gate::denies('taxonomy_ad_service_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new TaxonomyAdService();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

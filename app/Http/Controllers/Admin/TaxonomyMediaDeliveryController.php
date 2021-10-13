<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTaxonomyMediaDeliveryRequest;
use App\Http\Requests\StoreTaxonomyMediaDeliveryRequest;
use App\Http\Requests\UpdateTaxonomyMediaDeliveryRequest;
use App\Models\TaxonomyMediaDelivery;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class TaxonomyMediaDeliveryController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('taxonomy_media_delivery_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyMediaDeliveries = TaxonomyMediaDelivery::all();

        return view('admin.taxonomyMediaDeliveries.index', compact('taxonomyMediaDeliveries'));
    }

    public function create()
    {
        abort_if(Gate::denies('taxonomy_media_delivery_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyMediaDeliveries.create');
    }

    public function store(StoreTaxonomyMediaDeliveryRequest $request)
    {
        $taxonomyMediaDelivery = TaxonomyMediaDelivery::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $taxonomyMediaDelivery->id]);
        }

        return redirect()->route('admin.taxonomy-media-deliveries.index');
    }

    public function edit(TaxonomyMediaDelivery $taxonomyMediaDelivery)
    {
        abort_if(Gate::denies('taxonomy_media_delivery_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyMediaDeliveries.edit', compact('taxonomyMediaDelivery'));
    }

    public function update(UpdateTaxonomyMediaDeliveryRequest $request, TaxonomyMediaDelivery $taxonomyMediaDelivery)
    {
        $taxonomyMediaDelivery->update($request->all());

        return redirect()->route('admin.taxonomy-media-deliveries.index');
    }

    public function show(TaxonomyMediaDelivery $taxonomyMediaDelivery)
    {
        abort_if(Gate::denies('taxonomy_media_delivery_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyMediaDelivery->load('fieldMediaDeliveryTypeCourseProducts');

        return view('admin.taxonomyMediaDeliveries.show', compact('taxonomyMediaDelivery'));
    }

    public function destroy(TaxonomyMediaDelivery $taxonomyMediaDelivery)
    {
        abort_if(Gate::denies('taxonomy_media_delivery_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyMediaDelivery->delete();

        return back();
    }

    public function massDestroy(MassDestroyTaxonomyMediaDeliveryRequest $request)
    {
        TaxonomyMediaDelivery::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('taxonomy_media_delivery_create') && Gate::denies('taxonomy_media_delivery_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new TaxonomyMediaDelivery();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

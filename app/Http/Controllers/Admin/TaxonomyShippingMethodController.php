<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTaxonomyShippingMethodRequest;
use App\Http\Requests\StoreTaxonomyShippingMethodRequest;
use App\Http\Requests\UpdateTaxonomyShippingMethodRequest;
use App\Models\TaxonomyShippingMethod;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class TaxonomyShippingMethodController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('taxonomy_shipping_method_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyShippingMethods = TaxonomyShippingMethod::all();

        return view('admin.taxonomyShippingMethods.index', compact('taxonomyShippingMethods'));
    }

    public function create()
    {
        abort_if(Gate::denies('taxonomy_shipping_method_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyShippingMethods.create');
    }

    public function store(StoreTaxonomyShippingMethodRequest $request)
    {
        $taxonomyShippingMethod = TaxonomyShippingMethod::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $taxonomyShippingMethod->id]);
        }

        return redirect()->route('admin.taxonomy-shipping-methods.index');
    }

    public function edit(TaxonomyShippingMethod $taxonomyShippingMethod)
    {
        abort_if(Gate::denies('taxonomy_shipping_method_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyShippingMethods.edit', compact('taxonomyShippingMethod'));
    }

    public function update(UpdateTaxonomyShippingMethodRequest $request, TaxonomyShippingMethod $taxonomyShippingMethod)
    {
        $taxonomyShippingMethod->update($request->all());

        return redirect()->route('admin.taxonomy-shipping-methods.index');
    }

    public function show(TaxonomyShippingMethod $taxonomyShippingMethod)
    {
        abort_if(Gate::denies('taxonomy_shipping_method_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyShippingMethods.show', compact('taxonomyShippingMethod'));
    }

    public function destroy(TaxonomyShippingMethod $taxonomyShippingMethod)
    {
        abort_if(Gate::denies('taxonomy_shipping_method_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyShippingMethod->delete();

        return back();
    }

    public function massDestroy(MassDestroyTaxonomyShippingMethodRequest $request)
    {
        TaxonomyShippingMethod::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('taxonomy_shipping_method_create') && Gate::denies('taxonomy_shipping_method_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new TaxonomyShippingMethod();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

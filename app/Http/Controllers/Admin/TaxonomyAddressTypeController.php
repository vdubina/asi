<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTaxonomyAddressTypeRequest;
use App\Http\Requests\StoreTaxonomyAddressTypeRequest;
use App\Http\Requests\UpdateTaxonomyAddressTypeRequest;
use App\Models\TaxonomyAddressType;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class TaxonomyAddressTypeController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('taxonomy_address_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyAddressTypes = TaxonomyAddressType::all();

        return view('admin.taxonomyAddressTypes.index', compact('taxonomyAddressTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('taxonomy_address_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyAddressTypes.create');
    }

    public function store(StoreTaxonomyAddressTypeRequest $request)
    {
        $taxonomyAddressType = TaxonomyAddressType::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $taxonomyAddressType->id]);
        }

        return redirect()->route('admin.taxonomy-address-types.index');
    }

    public function edit(TaxonomyAddressType $taxonomyAddressType)
    {
        abort_if(Gate::denies('taxonomy_address_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyAddressTypes.edit', compact('taxonomyAddressType'));
    }

    public function update(UpdateTaxonomyAddressTypeRequest $request, TaxonomyAddressType $taxonomyAddressType)
    {
        $taxonomyAddressType->update($request->all());

        return redirect()->route('admin.taxonomy-address-types.index');
    }

    public function show(TaxonomyAddressType $taxonomyAddressType)
    {
        abort_if(Gate::denies('taxonomy_address_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyAddressTypes.show', compact('taxonomyAddressType'));
    }

    public function destroy(TaxonomyAddressType $taxonomyAddressType)
    {
        abort_if(Gate::denies('taxonomy_address_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyAddressType->delete();

        return back();
    }

    public function massDestroy(MassDestroyTaxonomyAddressTypeRequest $request)
    {
        TaxonomyAddressType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('taxonomy_address_type_create') && Gate::denies('taxonomy_address_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new TaxonomyAddressType();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

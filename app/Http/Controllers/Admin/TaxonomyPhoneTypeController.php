<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTaxonomyPhoneTypeRequest;
use App\Http\Requests\StoreTaxonomyPhoneTypeRequest;
use App\Http\Requests\UpdateTaxonomyPhoneTypeRequest;
use App\Models\TaxonomyPhoneType;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class TaxonomyPhoneTypeController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('taxonomy_phone_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyPhoneTypes = TaxonomyPhoneType::all();

        return view('admin.taxonomyPhoneTypes.index', compact('taxonomyPhoneTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('taxonomy_phone_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyPhoneTypes.create');
    }

    public function store(StoreTaxonomyPhoneTypeRequest $request)
    {
        $taxonomyPhoneType = TaxonomyPhoneType::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $taxonomyPhoneType->id]);
        }

        return redirect()->route('admin.taxonomy-phone-types.index');
    }

    public function edit(TaxonomyPhoneType $taxonomyPhoneType)
    {
        abort_if(Gate::denies('taxonomy_phone_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyPhoneTypes.edit', compact('taxonomyPhoneType'));
    }

    public function update(UpdateTaxonomyPhoneTypeRequest $request, TaxonomyPhoneType $taxonomyPhoneType)
    {
        $taxonomyPhoneType->update($request->all());

        return redirect()->route('admin.taxonomy-phone-types.index');
    }

    public function show(TaxonomyPhoneType $taxonomyPhoneType)
    {
        abort_if(Gate::denies('taxonomy_phone_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyPhoneTypes.show', compact('taxonomyPhoneType'));
    }

    public function destroy(TaxonomyPhoneType $taxonomyPhoneType)
    {
        abort_if(Gate::denies('taxonomy_phone_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyPhoneType->delete();

        return back();
    }

    public function massDestroy(MassDestroyTaxonomyPhoneTypeRequest $request)
    {
        TaxonomyPhoneType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('taxonomy_phone_type_create') && Gate::denies('taxonomy_phone_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new TaxonomyPhoneType();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

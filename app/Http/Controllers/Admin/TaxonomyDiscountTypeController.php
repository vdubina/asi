<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTaxonomyDiscountTypeRequest;
use App\Http\Requests\StoreTaxonomyDiscountTypeRequest;
use App\Http\Requests\UpdateTaxonomyDiscountTypeRequest;
use App\Models\TaxonomyDiscountType;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class TaxonomyDiscountTypeController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('taxonomy_discount_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyDiscountTypes = TaxonomyDiscountType::all();

        return view('admin.taxonomyDiscountTypes.index', compact('taxonomyDiscountTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('taxonomy_discount_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyDiscountTypes.create');
    }

    public function store(StoreTaxonomyDiscountTypeRequest $request)
    {
        $taxonomyDiscountType = TaxonomyDiscountType::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $taxonomyDiscountType->id]);
        }

        return redirect()->route('admin.taxonomy-discount-types.index');
    }

    public function edit(TaxonomyDiscountType $taxonomyDiscountType)
    {
        abort_if(Gate::denies('taxonomy_discount_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyDiscountTypes.edit', compact('taxonomyDiscountType'));
    }

    public function update(UpdateTaxonomyDiscountTypeRequest $request, TaxonomyDiscountType $taxonomyDiscountType)
    {
        $taxonomyDiscountType->update($request->all());

        return redirect()->route('admin.taxonomy-discount-types.index');
    }

    public function show(TaxonomyDiscountType $taxonomyDiscountType)
    {
        abort_if(Gate::denies('taxonomy_discount_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyDiscountTypes.show', compact('taxonomyDiscountType'));
    }

    public function destroy(TaxonomyDiscountType $taxonomyDiscountType)
    {
        abort_if(Gate::denies('taxonomy_discount_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyDiscountType->delete();

        return back();
    }

    public function massDestroy(MassDestroyTaxonomyDiscountTypeRequest $request)
    {
        TaxonomyDiscountType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('taxonomy_discount_type_create') && Gate::denies('taxonomy_discount_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new TaxonomyDiscountType();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

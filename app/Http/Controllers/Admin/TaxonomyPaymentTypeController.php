<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTaxonomyPaymentTypeRequest;
use App\Http\Requests\StoreTaxonomyPaymentTypeRequest;
use App\Http\Requests\UpdateTaxonomyPaymentTypeRequest;
use App\Models\TaxonomyPaymentType;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class TaxonomyPaymentTypeController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('taxonomy_payment_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyPaymentTypes = TaxonomyPaymentType::all();

        return view('admin.taxonomyPaymentTypes.index', compact('taxonomyPaymentTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('taxonomy_payment_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyPaymentTypes.create');
    }

    public function store(StoreTaxonomyPaymentTypeRequest $request)
    {
        $taxonomyPaymentType = TaxonomyPaymentType::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $taxonomyPaymentType->id]);
        }

        return redirect()->route('admin.taxonomy-payment-types.index');
    }

    public function edit(TaxonomyPaymentType $taxonomyPaymentType)
    {
        abort_if(Gate::denies('taxonomy_payment_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyPaymentTypes.edit', compact('taxonomyPaymentType'));
    }

    public function update(UpdateTaxonomyPaymentTypeRequest $request, TaxonomyPaymentType $taxonomyPaymentType)
    {
        $taxonomyPaymentType->update($request->all());

        return redirect()->route('admin.taxonomy-payment-types.index');
    }

    public function show(TaxonomyPaymentType $taxonomyPaymentType)
    {
        abort_if(Gate::denies('taxonomy_payment_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyPaymentTypes.show', compact('taxonomyPaymentType'));
    }

    public function destroy(TaxonomyPaymentType $taxonomyPaymentType)
    {
        abort_if(Gate::denies('taxonomy_payment_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyPaymentType->delete();

        return back();
    }

    public function massDestroy(MassDestroyTaxonomyPaymentTypeRequest $request)
    {
        TaxonomyPaymentType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('taxonomy_payment_type_create') && Gate::denies('taxonomy_payment_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new TaxonomyPaymentType();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

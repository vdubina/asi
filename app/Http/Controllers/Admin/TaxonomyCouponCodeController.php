<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTaxonomyCouponCodeRequest;
use App\Http\Requests\StoreTaxonomyCouponCodeRequest;
use App\Http\Requests\UpdateTaxonomyCouponCodeRequest;
use App\Models\TaxonomyCouponCode;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class TaxonomyCouponCodeController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('taxonomy_coupon_code_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyCouponCodes = TaxonomyCouponCode::all();

        return view('admin.taxonomyCouponCodes.index', compact('taxonomyCouponCodes'));
    }

    public function create()
    {
        abort_if(Gate::denies('taxonomy_coupon_code_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyCouponCodes.create');
    }

    public function store(StoreTaxonomyCouponCodeRequest $request)
    {
        $taxonomyCouponCode = TaxonomyCouponCode::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $taxonomyCouponCode->id]);
        }

        return redirect()->route('admin.taxonomy-coupon-codes.index');
    }

    public function edit(TaxonomyCouponCode $taxonomyCouponCode)
    {
        abort_if(Gate::denies('taxonomy_coupon_code_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyCouponCodes.edit', compact('taxonomyCouponCode'));
    }

    public function update(UpdateTaxonomyCouponCodeRequest $request, TaxonomyCouponCode $taxonomyCouponCode)
    {
        $taxonomyCouponCode->update($request->all());

        return redirect()->route('admin.taxonomy-coupon-codes.index');
    }

    public function show(TaxonomyCouponCode $taxonomyCouponCode)
    {
        abort_if(Gate::denies('taxonomy_coupon_code_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyCouponCodes.show', compact('taxonomyCouponCode'));
    }

    public function destroy(TaxonomyCouponCode $taxonomyCouponCode)
    {
        abort_if(Gate::denies('taxonomy_coupon_code_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyCouponCode->delete();

        return back();
    }

    public function massDestroy(MassDestroyTaxonomyCouponCodeRequest $request)
    {
        TaxonomyCouponCode::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('taxonomy_coupon_code_create') && Gate::denies('taxonomy_coupon_code_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new TaxonomyCouponCode();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTaxonomyCreditTypeRequest;
use App\Http\Requests\StoreTaxonomyCreditTypeRequest;
use App\Http\Requests\UpdateTaxonomyCreditTypeRequest;
use App\Models\TaxonomyCreditType;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class TaxonomyCreditTypeController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('taxonomy_credit_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyCreditTypes = TaxonomyCreditType::all();

        return view('admin.taxonomyCreditTypes.index', compact('taxonomyCreditTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('taxonomy_credit_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyCreditTypes.create');
    }

    public function store(StoreTaxonomyCreditTypeRequest $request)
    {
        $taxonomyCreditType = TaxonomyCreditType::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $taxonomyCreditType->id]);
        }

        return redirect()->route('admin.taxonomy-credit-types.index');
    }

    public function edit(TaxonomyCreditType $taxonomyCreditType)
    {
        abort_if(Gate::denies('taxonomy_credit_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyCreditTypes.edit', compact('taxonomyCreditType'));
    }

    public function update(UpdateTaxonomyCreditTypeRequest $request, TaxonomyCreditType $taxonomyCreditType)
    {
        $taxonomyCreditType->update($request->all());

        return redirect()->route('admin.taxonomy-credit-types.index');
    }

    public function show(TaxonomyCreditType $taxonomyCreditType)
    {
        abort_if(Gate::denies('taxonomy_credit_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyCreditType->load('fieldCourseCreditTypeCourseTopics', 'fieldCourseCreditTypeCourseProducts');

        return view('admin.taxonomyCreditTypes.show', compact('taxonomyCreditType'));
    }

    public function destroy(TaxonomyCreditType $taxonomyCreditType)
    {
        abort_if(Gate::denies('taxonomy_credit_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyCreditType->delete();

        return back();
    }

    public function massDestroy(MassDestroyTaxonomyCreditTypeRequest $request)
    {
        TaxonomyCreditType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('taxonomy_credit_type_create') && Gate::denies('taxonomy_credit_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new TaxonomyCreditType();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

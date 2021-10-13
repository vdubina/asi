<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTaxonomyCertificationTypeRequest;
use App\Http\Requests\StoreTaxonomyCertificationTypeRequest;
use App\Http\Requests\UpdateTaxonomyCertificationTypeRequest;
use App\Models\TaxonomyCertificationType;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class TaxonomyCertificationTypeController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('taxonomy_certification_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyCertificationTypes = TaxonomyCertificationType::all();

        return view('admin.taxonomyCertificationTypes.index', compact('taxonomyCertificationTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('taxonomy_certification_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyCertificationTypes.create');
    }

    public function store(StoreTaxonomyCertificationTypeRequest $request)
    {
        $taxonomyCertificationType = TaxonomyCertificationType::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $taxonomyCertificationType->id]);
        }

        return redirect()->route('admin.taxonomy-certification-types.index');
    }

    public function edit(TaxonomyCertificationType $taxonomyCertificationType)
    {
        abort_if(Gate::denies('taxonomy_certification_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyCertificationTypes.edit', compact('taxonomyCertificationType'));
    }

    public function update(UpdateTaxonomyCertificationTypeRequest $request, TaxonomyCertificationType $taxonomyCertificationType)
    {
        $taxonomyCertificationType->update($request->all());

        return redirect()->route('admin.taxonomy-certification-types.index');
    }

    public function show(TaxonomyCertificationType $taxonomyCertificationType)
    {
        abort_if(Gate::denies('taxonomy_certification_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyCertificationTypes.show', compact('taxonomyCertificationType'));
    }

    public function destroy(TaxonomyCertificationType $taxonomyCertificationType)
    {
        abort_if(Gate::denies('taxonomy_certification_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyCertificationType->delete();

        return back();
    }

    public function massDestroy(MassDestroyTaxonomyCertificationTypeRequest $request)
    {
        TaxonomyCertificationType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('taxonomy_certification_type_create') && Gate::denies('taxonomy_certification_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new TaxonomyCertificationType();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

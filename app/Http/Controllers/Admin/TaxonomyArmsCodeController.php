<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTaxonomyArmsCodeRequest;
use App\Http\Requests\StoreTaxonomyArmsCodeRequest;
use App\Http\Requests\UpdateTaxonomyArmsCodeRequest;
use App\Models\TaxonomyArmsCategory;
use App\Models\TaxonomyArmsCode;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class TaxonomyArmsCodeController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('taxonomy_arms_code_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyArmsCodes = TaxonomyArmsCode::with(['field_arms_category'])->get();

        return view('admin.taxonomyArmsCodes.index', compact('taxonomyArmsCodes'));
    }

    public function create()
    {
        abort_if(Gate::denies('taxonomy_arms_code_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $field_arms_categories = TaxonomyArmsCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.taxonomyArmsCodes.create', compact('field_arms_categories'));
    }

    public function store(StoreTaxonomyArmsCodeRequest $request)
    {
        $taxonomyArmsCode = TaxonomyArmsCode::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $taxonomyArmsCode->id]);
        }

        return redirect()->route('admin.taxonomy-arms-codes.index');
    }

    public function edit(TaxonomyArmsCode $taxonomyArmsCode)
    {
        abort_if(Gate::denies('taxonomy_arms_code_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $field_arms_categories = TaxonomyArmsCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $taxonomyArmsCode->load('field_arms_category');

        return view('admin.taxonomyArmsCodes.edit', compact('field_arms_categories', 'taxonomyArmsCode'));
    }

    public function update(UpdateTaxonomyArmsCodeRequest $request, TaxonomyArmsCode $taxonomyArmsCode)
    {
        $taxonomyArmsCode->update($request->all());

        return redirect()->route('admin.taxonomy-arms-codes.index');
    }

    public function show(TaxonomyArmsCode $taxonomyArmsCode)
    {
        abort_if(Gate::denies('taxonomy_arms_code_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyArmsCode->load('field_arms_category', 'fieldArmscodeCourseTopics');

        return view('admin.taxonomyArmsCodes.show', compact('taxonomyArmsCode'));
    }

    public function destroy(TaxonomyArmsCode $taxonomyArmsCode)
    {
        abort_if(Gate::denies('taxonomy_arms_code_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyArmsCode->delete();

        return back();
    }

    public function massDestroy(MassDestroyTaxonomyArmsCodeRequest $request)
    {
        TaxonomyArmsCode::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('taxonomy_arms_code_create') && Gate::denies('taxonomy_arms_code_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new TaxonomyArmsCode();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTaxonomyCourseFullShortRequest;
use App\Http\Requests\StoreTaxonomyCourseFullShortRequest;
use App\Http\Requests\UpdateTaxonomyCourseFullShortRequest;
use App\Models\TaxonomyCourseFullShort;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class TaxonomyCourseFullShortController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('taxonomy_course_full_short_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyCourseFullShorts = TaxonomyCourseFullShort::all();

        return view('admin.taxonomyCourseFullShorts.index', compact('taxonomyCourseFullShorts'));
    }

    public function create()
    {
        abort_if(Gate::denies('taxonomy_course_full_short_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyCourseFullShorts.create');
    }

    public function store(StoreTaxonomyCourseFullShortRequest $request)
    {
        $taxonomyCourseFullShort = TaxonomyCourseFullShort::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $taxonomyCourseFullShort->id]);
        }

        return redirect()->route('admin.taxonomy-course-full-shorts.index');
    }

    public function edit(TaxonomyCourseFullShort $taxonomyCourseFullShort)
    {
        abort_if(Gate::denies('taxonomy_course_full_short_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyCourseFullShorts.edit', compact('taxonomyCourseFullShort'));
    }

    public function update(UpdateTaxonomyCourseFullShortRequest $request, TaxonomyCourseFullShort $taxonomyCourseFullShort)
    {
        $taxonomyCourseFullShort->update($request->all());

        return redirect()->route('admin.taxonomy-course-full-shorts.index');
    }

    public function show(TaxonomyCourseFullShort $taxonomyCourseFullShort)
    {
        abort_if(Gate::denies('taxonomy_course_full_short_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyCourseFullShorts.show', compact('taxonomyCourseFullShort'));
    }

    public function destroy(TaxonomyCourseFullShort $taxonomyCourseFullShort)
    {
        abort_if(Gate::denies('taxonomy_course_full_short_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyCourseFullShort->delete();

        return back();
    }

    public function massDestroy(MassDestroyTaxonomyCourseFullShortRequest $request)
    {
        TaxonomyCourseFullShort::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('taxonomy_course_full_short_create') && Gate::denies('taxonomy_course_full_short_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new TaxonomyCourseFullShort();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

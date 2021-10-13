<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTaxonomyCourseRequest;
use App\Http\Requests\StoreTaxonomyCourseRequest;
use App\Http\Requests\UpdateTaxonomyCourseRequest;
use App\Models\TaxonomyCourse;
use App\Models\TaxonomyCourseType;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class TaxonomyCourseController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('taxonomy_course_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyCourses = TaxonomyCourse::with(['field_course_type'])->get();

        return view('admin.taxonomyCourses.index', compact('taxonomyCourses'));
    }

    public function create()
    {
        abort_if(Gate::denies('taxonomy_course_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $field_course_types = TaxonomyCourseType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.taxonomyCourses.create', compact('field_course_types'));
    }

    public function store(StoreTaxonomyCourseRequest $request)
    {
        $taxonomyCourse = TaxonomyCourse::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $taxonomyCourse->id]);
        }

        return redirect()->route('admin.taxonomy-courses.index');
    }

    public function edit(TaxonomyCourse $taxonomyCourse)
    {
        abort_if(Gate::denies('taxonomy_course_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $field_course_types = TaxonomyCourseType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $taxonomyCourse->load('field_course_type');

        return view('admin.taxonomyCourses.edit', compact('field_course_types', 'taxonomyCourse'));
    }

    public function update(UpdateTaxonomyCourseRequest $request, TaxonomyCourse $taxonomyCourse)
    {
        $taxonomyCourse->update($request->all());

        return redirect()->route('admin.taxonomy-courses.index');
    }

    public function show(TaxonomyCourse $taxonomyCourse)
    {
        abort_if(Gate::denies('taxonomy_course_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyCourse->load('field_course_type');

        return view('admin.taxonomyCourses.show', compact('taxonomyCourse'));
    }

    public function destroy(TaxonomyCourse $taxonomyCourse)
    {
        abort_if(Gate::denies('taxonomy_course_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyCourse->delete();

        return back();
    }

    public function massDestroy(MassDestroyTaxonomyCourseRequest $request)
    {
        TaxonomyCourse::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('taxonomy_course_create') && Gate::denies('taxonomy_course_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new TaxonomyCourse();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

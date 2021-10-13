<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTaxonomyCourseTypeRequest;
use App\Http\Requests\StoreTaxonomyCourseTypeRequest;
use App\Http\Requests\UpdateTaxonomyCourseTypeRequest;
use App\Models\TaxonomyCourseType;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class TaxonomyCourseTypeController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('taxonomy_course_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyCourseTypes = TaxonomyCourseType::all();

        return view('admin.taxonomyCourseTypes.index', compact('taxonomyCourseTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('taxonomy_course_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyCourseTypes.create');
    }

    public function store(StoreTaxonomyCourseTypeRequest $request)
    {
        $taxonomyCourseType = TaxonomyCourseType::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $taxonomyCourseType->id]);
        }

        return redirect()->route('admin.taxonomy-course-types.index');
    }

    public function edit(TaxonomyCourseType $taxonomyCourseType)
    {
        abort_if(Gate::denies('taxonomy_course_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyCourseTypes.edit', compact('taxonomyCourseType'));
    }

    public function update(UpdateTaxonomyCourseTypeRequest $request, TaxonomyCourseType $taxonomyCourseType)
    {
        $taxonomyCourseType->update($request->all());

        return redirect()->route('admin.taxonomy-course-types.index');
    }

    public function show(TaxonomyCourseType $taxonomyCourseType)
    {
        abort_if(Gate::denies('taxonomy_course_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyCourseType->load('fieldCourseTypeTaxonomyCourses', 'fieldCourseTypeCourseTopics', 'fieldCourseTypeCourseProducts');

        return view('admin.taxonomyCourseTypes.show', compact('taxonomyCourseType'));
    }

    public function destroy(TaxonomyCourseType $taxonomyCourseType)
    {
        abort_if(Gate::denies('taxonomy_course_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyCourseType->delete();

        return back();
    }

    public function massDestroy(MassDestroyTaxonomyCourseTypeRequest $request)
    {
        TaxonomyCourseType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('taxonomy_course_type_create') && Gate::denies('taxonomy_course_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new TaxonomyCourseType();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

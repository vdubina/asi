<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCourseInstructorRequest;
use App\Http\Requests\StoreCourseInstructorRequest;
use App\Http\Requests\UpdateCourseInstructorRequest;
use App\Models\CourseInstructor;
use App\Models\CourseProduct;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class CourseInstructorController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('course_instructor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courseInstructors = CourseInstructor::with(['field_course_products', 'media'])->get();

        $course_products = CourseProduct::get();

        return view('admin.courseInstructors.index', compact('courseInstructors', 'course_products'));
    }

    public function create()
    {
        abort_if(Gate::denies('course_instructor_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $field_course_products = CourseProduct::pluck('sku', 'id');

        return view('admin.courseInstructors.create', compact('field_course_products'));
    }

    public function store(StoreCourseInstructorRequest $request)
    {
        $courseInstructor = CourseInstructor::create($request->all());
        $courseInstructor->field_course_products()->sync($request->input('field_course_products', []));
        if ($request->input('field_image', false)) {
            $courseInstructor->addMedia(storage_path('tmp/uploads/' . basename($request->input('field_image'))))->toMediaCollection('field_image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $courseInstructor->id]);
        }

        return redirect()->route('admin.course-instructors.index');
    }

    public function edit(CourseInstructor $courseInstructor)
    {
        abort_if(Gate::denies('course_instructor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $field_course_products = CourseProduct::pluck('sku', 'id');

        $courseInstructor->load('field_course_products');

        return view('admin.courseInstructors.edit', compact('field_course_products', 'courseInstructor'));
    }

    public function update(UpdateCourseInstructorRequest $request, CourseInstructor $courseInstructor)
    {
        $courseInstructor->update($request->all());
        $courseInstructor->field_course_products()->sync($request->input('field_course_products', []));
        if ($request->input('field_image', false)) {
            if (!$courseInstructor->field_image || $request->input('field_image') !== $courseInstructor->field_image->file_name) {
                if ($courseInstructor->field_image) {
                    $courseInstructor->field_image->delete();
                }
                $courseInstructor->addMedia(storage_path('tmp/uploads/' . basename($request->input('field_image'))))->toMediaCollection('field_image');
            }
        } elseif ($courseInstructor->field_image) {
            $courseInstructor->field_image->delete();
        }

        return redirect()->route('admin.course-instructors.index');
    }

    public function show(CourseInstructor $courseInstructor)
    {
        abort_if(Gate::denies('course_instructor_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courseInstructor->load('field_course_products');

        return view('admin.courseInstructors.show', compact('courseInstructor'));
    }

    public function destroy(CourseInstructor $courseInstructor)
    {
        abort_if(Gate::denies('course_instructor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courseInstructor->delete();

        return back();
    }

    public function massDestroy(MassDestroyCourseInstructorRequest $request)
    {
        CourseInstructor::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('course_instructor_create') && Gate::denies('course_instructor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new CourseInstructor();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

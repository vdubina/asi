<?php

namespace App\Http\Controllers\Api\V1\Frontend;

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreCourseInstructorRequest;
use App\Http\Requests\UpdateCourseInstructorRequest;
use App\Http\Resources\Admin\CourseInstructorResource;
use App\Models\CourseInstructor;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CourseInstructorApiController extends ApiController
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('course_instructor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CourseInstructorResource(CourseInstructor::with(['field_course_products'])->get());
    }

    public function store(StoreCourseInstructorRequest $request)
    {
        $courseInstructor = CourseInstructor::create($request->all());
        $courseInstructor->field_course_products()->sync($request->input('field_course_products', []));
        if ($request->input('field_image', false)) {
            $courseInstructor->addMedia(storage_path('tmp/uploads/' . basename($request->input('field_image'))))->toMediaCollection('field_image');
        }

        return (new CourseInstructorResource($courseInstructor))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CourseInstructor $courseInstructor)
    {
        abort_if(Gate::denies('course_instructor_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CourseInstructorResource($courseInstructor->load(['field_course_products']));
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

        return (new CourseInstructorResource($courseInstructor))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CourseInstructor $courseInstructor)
    {
        abort_if(Gate::denies('course_instructor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courseInstructor->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

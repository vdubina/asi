<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreCourseTopicRequest;
use App\Http\Requests\UpdateCourseTopicRequest;
use App\Http\Resources\Admin\CourseTopicResource;
use App\Models\CourseTopic;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CourseTopicApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('course_topic_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CourseTopicResource(CourseTopic::with(['field_course_type', 'field_course_credit_type', 'field_practice_type', 'field_armscode', 'field_web_category', 'field_ad_service', 'field_media_provider'])->get());
    }

    public function store(StoreCourseTopicRequest $request)
    {
        $courseTopic = CourseTopic::create($request->all());

        return (new CourseTopicResource($courseTopic))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CourseTopic $courseTopic)
    {
        abort_if(Gate::denies('course_topic_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CourseTopicResource($courseTopic->load(['field_course_type', 'field_course_credit_type', 'field_practice_type', 'field_armscode', 'field_web_category', 'field_ad_service', 'field_media_provider']));
    }

    public function update(UpdateCourseTopicRequest $request, CourseTopic $courseTopic)
    {
        $courseTopic->update($request->all());

        return (new CourseTopicResource($courseTopic))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CourseTopic $courseTopic)
    {
        abort_if(Gate::denies('course_topic_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courseTopic->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
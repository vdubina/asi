<?php

namespace App\Http\Controllers\Api\V1\Frontend;

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Resources\Frontend\CourseTopicResource;
use App\Models\CourseTopic;
use Symfony\Component\HttpFoundation\Response;

class CourseTopicApiController extends ApiController
{
    use MediaUploadingTrait;

    public function index()
    {
        $this->checkGate('course_topic_access');
        return new CourseTopicResource(
            CourseTopic::with(['field_course_type', 'field_course_credit_type', 'field_practice_type', 'field_armscode', 'field_web_category', 'field_ad_service', 'field_media_provider'])->get()
        );
    }

    public function show(CourseTopic $courseTopic)
    {
        abort_if(Gate::denies('course_topic_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return new CourseTopicResource($courseTopic->load(['field_course_type', 'field_course_credit_type', 'field_practice_type', 'field_armscode', 'field_web_category', 'field_ad_service', 'field_media_provider']));
    }

}

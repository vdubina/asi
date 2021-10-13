<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCourseTopicRequest;
use App\Http\Requests\StoreCourseTopicRequest;
use App\Http\Requests\UpdateCourseTopicRequest;
use App\Models\CourseTopic;
use App\Models\TaxonomyAdService;
use App\Models\TaxonomyArmsCode;
use App\Models\TaxonomyCourseType;
use App\Models\TaxonomyCreditType;
use App\Models\TaxonomyMediaProvider;
use App\Models\TaxonomyPracticeType;
use App\Models\TaxonomyWebCategory;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class CourseTopicController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('course_topic_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courseTopics = CourseTopic::with(['field_course_type', 'field_course_credit_type', 'field_practice_type', 'field_armscode', 'field_web_category', 'field_ad_service', 'field_media_provider'])->get();

        $taxonomy_course_types = TaxonomyCourseType::get();

        $taxonomy_credit_types = TaxonomyCreditType::get();

        $taxonomy_practice_types = TaxonomyPracticeType::get();

        $taxonomy_arms_codes = TaxonomyArmsCode::get();

        $taxonomy_web_categories = TaxonomyWebCategory::get();

        $taxonomy_ad_services = TaxonomyAdService::get();

        $taxonomy_media_providers = TaxonomyMediaProvider::get();

        return view('admin.courseTopics.index', compact('courseTopics', 'taxonomy_course_types', 'taxonomy_credit_types', 'taxonomy_practice_types', 'taxonomy_arms_codes', 'taxonomy_web_categories', 'taxonomy_ad_services', 'taxonomy_media_providers'));
    }

    public function create()
    {
        abort_if(Gate::denies('course_topic_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $field_course_types = TaxonomyCourseType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $field_course_credit_types = TaxonomyCreditType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $field_practice_types = TaxonomyPracticeType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $field_armscodes = TaxonomyArmsCode::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $field_web_categories = TaxonomyWebCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $field_ad_services = TaxonomyAdService::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $field_media_providers = TaxonomyMediaProvider::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.courseTopics.create', compact('field_course_types', 'field_course_credit_types', 'field_practice_types', 'field_armscodes', 'field_web_categories', 'field_ad_services', 'field_media_providers'));
    }

    public function store(StoreCourseTopicRequest $request)
    {
        $courseTopic = CourseTopic::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $courseTopic->id]);
        }

        return redirect()->route('admin.course-topics.index');
    }

    public function edit(CourseTopic $courseTopic)
    {
        abort_if(Gate::denies('course_topic_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $field_course_types = TaxonomyCourseType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $field_course_credit_types = TaxonomyCreditType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $field_practice_types = TaxonomyPracticeType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $field_armscodes = TaxonomyArmsCode::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $field_web_categories = TaxonomyWebCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $field_ad_services = TaxonomyAdService::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $field_media_providers = TaxonomyMediaProvider::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $courseTopic->load('field_course_type', 'field_course_credit_type', 'field_practice_type', 'field_armscode', 'field_web_category', 'field_ad_service', 'field_media_provider');

        return view('admin.courseTopics.edit', compact('field_course_types', 'field_course_credit_types', 'field_practice_types', 'field_armscodes', 'field_web_categories', 'field_ad_services', 'field_media_providers', 'courseTopic'));
    }

    public function update(UpdateCourseTopicRequest $request, CourseTopic $courseTopic)
    {
        $courseTopic->update($request->all());

        return redirect()->route('admin.course-topics.index');
    }

    public function show(CourseTopic $courseTopic)
    {
        abort_if(Gate::denies('course_topic_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courseTopic->load('field_course_type', 'field_course_credit_type', 'field_practice_type', 'field_armscode', 'field_web_category', 'field_ad_service', 'field_media_provider', 'fieldTopicsNodesCourseProducts');

        return view('admin.courseTopics.show', compact('courseTopic'));
    }

    public function destroy(CourseTopic $courseTopic)
    {
        abort_if(Gate::denies('course_topic_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courseTopic->delete();

        return back();
    }

    public function massDestroy(MassDestroyCourseTopicRequest $request)
    {
        CourseTopic::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('course_topic_create') && Gate::denies('course_topic_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new CourseTopic();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

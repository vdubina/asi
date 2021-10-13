<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCourseProductRequest;
use App\Http\Requests\StoreCourseProductRequest;
use App\Http\Requests\UpdateCourseProductRequest;
use App\Models\CourseProduct;
use App\Models\CourseTopic;
use App\Models\TaxonomyCourseType;
use App\Models\TaxonomyCreditType;
use App\Models\TaxonomyMediaDelivery;
use App\Models\TaxonomyMediaProvider;
use App\Models\TaxonomyPracticeType;
use App\Models\TaxonomyWebCategory;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class CourseProductController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('course_product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courseProducts = CourseProduct::with(['field_course_type', 'field_course_credit_type', 'field_practice_type', 'field_media_provider', 'field_media_delivery_type', 'field_web_category', 'field_topics_nodes'])->get();

        $taxonomy_course_types = TaxonomyCourseType::get();

        $taxonomy_credit_types = TaxonomyCreditType::get();

        $taxonomy_practice_types = TaxonomyPracticeType::get();

        $taxonomy_media_providers = TaxonomyMediaProvider::get();

        $taxonomy_media_deliveries = TaxonomyMediaDelivery::get();

        $taxonomy_web_categories = TaxonomyWebCategory::get();

        $course_topics = CourseTopic::get();

        return view('admin.courseProducts.index', compact('courseProducts', 'taxonomy_course_types', 'taxonomy_credit_types', 'taxonomy_practice_types', 'taxonomy_media_providers', 'taxonomy_media_deliveries', 'taxonomy_web_categories', 'course_topics'));
    }

    public function create()
    {
        abort_if(Gate::denies('course_product_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $field_course_types = TaxonomyCourseType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $field_course_credit_types = TaxonomyCreditType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $field_practice_types = TaxonomyPracticeType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $field_media_providers = TaxonomyMediaProvider::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $field_media_delivery_types = TaxonomyMediaDelivery::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $field_web_categories = TaxonomyWebCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $field_topics_nodes = CourseTopic::pluck('title', 'id');

        return view('admin.courseProducts.create', compact('field_course_types', 'field_course_credit_types', 'field_practice_types', 'field_media_providers', 'field_media_delivery_types', 'field_web_categories', 'field_topics_nodes'));
    }

    public function store(StoreCourseProductRequest $request)
    {
        $courseProduct = CourseProduct::create($request->all());
        $courseProduct->field_topics_nodes()->sync($request->input('field_topics_nodes', []));
        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $courseProduct->id]);
        }

        return redirect()->route('admin.course-products.index');
    }

    public function edit(CourseProduct $courseProduct)
    {
        abort_if(Gate::denies('course_product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $field_course_types = TaxonomyCourseType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $field_course_credit_types = TaxonomyCreditType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $field_practice_types = TaxonomyPracticeType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $field_media_providers = TaxonomyMediaProvider::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $field_media_delivery_types = TaxonomyMediaDelivery::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $field_web_categories = TaxonomyWebCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $field_topics_nodes = CourseTopic::pluck('title', 'id');

        $courseProduct->load('field_course_type', 'field_course_credit_type', 'field_practice_type', 'field_media_provider', 'field_media_delivery_type', 'field_web_category', 'field_topics_nodes');

        return view('admin.courseProducts.edit', compact('field_course_types', 'field_course_credit_types', 'field_practice_types', 'field_media_providers', 'field_media_delivery_types', 'field_web_categories', 'field_topics_nodes', 'courseProduct'));
    }

    public function update(UpdateCourseProductRequest $request, CourseProduct $courseProduct)
    {
        $courseProduct->update($request->all());
        $courseProduct->field_topics_nodes()->sync($request->input('field_topics_nodes', []));

        return redirect()->route('admin.course-products.index');
    }

    public function show(CourseProduct $courseProduct)
    {
        abort_if(Gate::denies('course_product_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courseProduct->load('field_course_type', 'field_course_credit_type', 'field_practice_type', 'field_media_provider', 'field_media_delivery_type', 'field_web_category', 'field_topics_nodes', 'fieldCourseProductsCourseInstructors');

        return view('admin.courseProducts.show', compact('courseProduct'));
    }

    public function destroy(CourseProduct $courseProduct)
    {
        abort_if(Gate::denies('course_product_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courseProduct->delete();

        return back();
    }

    public function massDestroy(MassDestroyCourseProductRequest $request)
    {
        CourseProduct::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('course_product_create') && Gate::denies('course_product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new CourseProduct();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

<?php

namespace App\Http\Controllers\Api\V1\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreCourseProductRequest;
use App\Http\Requests\UpdateCourseProductRequest;
use App\Http\Resources\Admin\CourseProductResource;
use App\Models\CourseProduct;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CourseProductApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('course_product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CourseProductResource(CourseProduct::with(['field_course_type', 'field_course_credit_type', 'field_practice_type', 'field_media_provider', 'field_media_delivery_type', 'field_web_category', 'field_topics_nodes'])->get());
    }

    public function store(StoreCourseProductRequest $request)
    {
        $courseProduct = CourseProduct::create($request->all());
        $courseProduct->field_topics_nodes()->sync($request->input('field_topics_nodes', []));

        return (new CourseProductResource($courseProduct))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CourseProduct $courseProduct)
    {
        abort_if(Gate::denies('course_product_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CourseProductResource($courseProduct->load(['field_course_type', 'field_course_credit_type', 'field_practice_type', 'field_media_provider', 'field_media_delivery_type', 'field_web_category', 'field_topics_nodes']));
    }

    public function update(UpdateCourseProductRequest $request, CourseProduct $courseProduct)
    {
        $courseProduct->update($request->all());
        $courseProduct->field_topics_nodes()->sync($request->input('field_topics_nodes', []));

        return (new CourseProductResource($courseProduct))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CourseProduct $courseProduct)
    {
        abort_if(Gate::denies('course_product_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courseProduct->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTestimonialTypeRequest;
use App\Http\Requests\StoreTestimonialTypeRequest;
use App\Http\Requests\UpdateTestimonialTypeRequest;
use App\Models\TestimonialType;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class TestimonialTypeController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('testimonial_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $testimonialTypes = TestimonialType::all();

        return view('admin.testimonialTypes.index', compact('testimonialTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('testimonial_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.testimonialTypes.create');
    }

    public function store(StoreTestimonialTypeRequest $request)
    {
        $testimonialType = TestimonialType::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $testimonialType->id]);
        }

        return redirect()->route('admin.testimonial-types.index');
    }

    public function edit(TestimonialType $testimonialType)
    {
        abort_if(Gate::denies('testimonial_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.testimonialTypes.edit', compact('testimonialType'));
    }

    public function update(UpdateTestimonialTypeRequest $request, TestimonialType $testimonialType)
    {
        $testimonialType->update($request->all());

        return redirect()->route('admin.testimonial-types.index');
    }

    public function show(TestimonialType $testimonialType)
    {
        abort_if(Gate::denies('testimonial_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $testimonialType->load('fieldTestimonialTypeTestimonials');

        return view('admin.testimonialTypes.show', compact('testimonialType'));
    }

    public function destroy(TestimonialType $testimonialType)
    {
        abort_if(Gate::denies('testimonial_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $testimonialType->delete();

        return back();
    }

    public function massDestroy(MassDestroyTestimonialTypeRequest $request)
    {
        TestimonialType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('testimonial_type_create') && Gate::denies('testimonial_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new TestimonialType();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

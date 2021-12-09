<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTestimonialRequest;
use App\Http\Requests\StoreTestimonialRequest;
use App\Http\Requests\UpdateTestimonialRequest;
use App\Models\ContentPage;
use App\Models\Testimonial;
use App\Models\TestimonialType;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class TestimonialController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('testimonial_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $testimonials = Testimonial::with(['field_testimonial_types', 'show_on_pages', 'media'])->get();

        $testimonial_types = TestimonialType::get();

        $content_pages = ContentPage::get();

        return view('admin.testimonials.index', compact('testimonials', 'testimonial_types', 'content_pages'));
    }

    public function create()
    {
        abort_if(Gate::denies('testimonial_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $field_testimonial_types = TestimonialType::pluck('name', 'id');

        $show_on_pages = ContentPage::pluck('title', 'id');

        return view('admin.testimonials.create', compact('field_testimonial_types', 'show_on_pages'));
    }

    public function store(StoreTestimonialRequest $request)
    {
        $testimonial = Testimonial::create($request->all());
        $testimonial->field_testimonial_types()->sync($request->input('field_testimonial_types', []));
        $testimonial->show_on_pages()->sync($request->input('show_on_pages', []));
        if ($request->input('featured_image', false)) {
            $testimonial->addMedia(storage_path('tmp/uploads/' . basename($request->input('featured_image'))))->toMediaCollection('featured_image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $testimonial->id]);
        }

        return redirect()->route('admin.testimonials.index');
    }

    public function edit(Testimonial $testimonial)
    {
        abort_if(Gate::denies('testimonial_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $field_testimonial_types = TestimonialType::pluck('name', 'id');

        $show_on_pages = ContentPage::pluck('title', 'id');

        $testimonial->load('field_testimonial_types', 'show_on_pages');

        return view('admin.testimonials.edit', compact('field_testimonial_types', 'show_on_pages', 'testimonial'));
    }

    public function update(UpdateTestimonialRequest $request, Testimonial $testimonial)
    {
        $testimonial->update($request->all());
        $testimonial->field_testimonial_types()->sync($request->input('field_testimonial_types', []));
        $testimonial->show_on_pages()->sync($request->input('show_on_pages', []));
        if ($request->input('featured_image', false)) {
            if (!$testimonial->featured_image || $request->input('featured_image') !== $testimonial->featured_image->file_name) {
                if ($testimonial->featured_image) {
                    $testimonial->featured_image->delete();
                }
                $testimonial->addMedia(storage_path('tmp/uploads/' . basename($request->input('featured_image'))))->toMediaCollection('featured_image');
            }
        } elseif ($testimonial->featured_image) {
            $testimonial->featured_image->delete();
        }

        return redirect()->route('admin.testimonials.index');
    }

    public function show(Testimonial $testimonial)
    {
        abort_if(Gate::denies('testimonial_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $testimonial->load('field_testimonial_types', 'show_on_pages');

        return view('admin.testimonials.show', compact('testimonial'));
    }

    public function destroy(Testimonial $testimonial)
    {
        abort_if(Gate::denies('testimonial_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $testimonial->delete();

        return back();
    }

    public function massDestroy(MassDestroyTestimonialRequest $request)
    {
        Testimonial::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('testimonial_create') && Gate::denies('testimonial_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Testimonial();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

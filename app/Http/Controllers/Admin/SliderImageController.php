<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySliderImageRequest;
use App\Http\Requests\StoreSliderImageRequest;
use App\Http\Requests\UpdateSliderImageRequest;
use App\Models\Slider;
use App\Models\SliderImage;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class SliderImageController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('slider_image_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sliderImages = SliderImage::with(['field_sliders', 'media'])->get();

        $sliders = Slider::get();

        return view('admin.sliderImages.index', compact('sliderImages', 'sliders'));
    }

    public function create()
    {
        abort_if(Gate::denies('slider_image_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $field_sliders = Slider::pluck('name', 'id');

        return view('admin.sliderImages.create', compact('field_sliders'));
    }

    public function store(StoreSliderImageRequest $request)
    {
        $sliderImage = SliderImage::create($request->all());
        $sliderImage->field_sliders()->sync($request->input('field_sliders', []));
        if ($request->input('field_slide_image', false)) {
            $sliderImage->addMedia(storage_path('tmp/uploads/' . basename($request->input('field_slide_image'))))->toMediaCollection('field_slide_image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $sliderImage->id]);
        }

        return redirect()->route('admin.slider-images.index');
    }

    public function edit(SliderImage $sliderImage)
    {
        abort_if(Gate::denies('slider_image_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $field_sliders = Slider::pluck('name', 'id');

        $sliderImage->load('field_sliders');

        return view('admin.sliderImages.edit', compact('field_sliders', 'sliderImage'));
    }

    public function update(UpdateSliderImageRequest $request, SliderImage $sliderImage)
    {
        $sliderImage->update($request->all());
        $sliderImage->field_sliders()->sync($request->input('field_sliders', []));
        if ($request->input('field_slide_image', false)) {
            if (!$sliderImage->field_slide_image || $request->input('field_slide_image') !== $sliderImage->field_slide_image->file_name) {
                if ($sliderImage->field_slide_image) {
                    $sliderImage->field_slide_image->delete();
                }
                $sliderImage->addMedia(storage_path('tmp/uploads/' . basename($request->input('field_slide_image'))))->toMediaCollection('field_slide_image');
            }
        } elseif ($sliderImage->field_slide_image) {
            $sliderImage->field_slide_image->delete();
        }

        return redirect()->route('admin.slider-images.index');
    }

    public function show(SliderImage $sliderImage)
    {
        abort_if(Gate::denies('slider_image_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sliderImage->load('field_sliders');

        return view('admin.sliderImages.show', compact('sliderImage'));
    }

    public function destroy(SliderImage $sliderImage)
    {
        abort_if(Gate::denies('slider_image_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sliderImage->delete();

        return back();
    }

    public function massDestroy(MassDestroySliderImageRequest $request)
    {
        SliderImage::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('slider_image_create') && Gate::denies('slider_image_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new SliderImage();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

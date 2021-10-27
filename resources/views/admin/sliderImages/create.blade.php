@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.sliderImage.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.slider-images.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.sliderImage.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.sliderImage.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="page_text">{{ trans('cruds.sliderImage.fields.page_text') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('page_text') ? 'is-invalid' : '' }}" name="page_text" id="page_text">{!! old('page_text') !!}</textarea>
                @if($errors->has('page_text'))
                    <span class="text-danger">{{ $errors->first('page_text') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.sliderImage.fields.page_text_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="field_slide_image">{{ trans('cruds.sliderImage.fields.field_slide_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('field_slide_image') ? 'is-invalid' : '' }}" id="field_slide_image-dropzone">
                </div>
                @if($errors->has('field_slide_image'))
                    <span class="text-danger">{{ $errors->first('field_slide_image') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.sliderImage.fields.field_slide_image_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="field_sliders">{{ trans('cruds.sliderImage.fields.field_slider') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('field_sliders') ? 'is-invalid' : '' }}" name="field_sliders[]" id="field_sliders" multiple>
                    @foreach($field_sliders as $id => $field_slider)
                        <option value="{{ $id }}" {{ in_array($id, old('field_sliders', [])) ? 'selected' : '' }}>{{ $field_slider }}</option>
                    @endforeach
                </select>
                @if($errors->has('field_sliders'))
                    <span class="text-danger">{{ $errors->first('field_sliders') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.sliderImage.fields.field_slider_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="field_weight">{{ trans('cruds.sliderImage.fields.field_weight') }}</label>
                <input class="form-control {{ $errors->has('field_weight') ? 'is-invalid' : '' }}" type="number" name="field_weight" id="field_weight" value="{{ old('field_weight', '') }}" step="1">
                @if($errors->has('field_weight'))
                    <span class="text-danger">{{ $errors->first('field_weight') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.sliderImage.fields.field_weight_helper') }}</span>
            </div>
            <div class="form-group">
                @include('partials.buttons.save')
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
    @include('partials.scripts.simpleUpload',['route'=>'slider-images',])
    @include('partials.scripts.imagesDropzone',['route'=>'slider-images','key'=>'field_slide_image',])
@endsection

@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.slider.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.sliders.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.slider.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.slider.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.slider.fields.description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description') !!}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.slider.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('field_is_subsite_content') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="field_is_subsite_content" value="0">
                    <input class="form-check-input" type="checkbox" name="field_is_subsite_content" id="field_is_subsite_content" value="1" {{ old('field_is_subsite_content', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="field_is_subsite_content">{{ trans('cruds.slider.fields.field_is_subsite_content') }}</label>
                </div>
                @if($errors->has('field_is_subsite_content'))
                    <span class="text-danger">{{ $errors->first('field_is_subsite_content') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.slider.fields.field_is_subsite_content_helper') }}</span>
            </div>
            <div class="form-group">
                @include('partials.buttons.save')
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
    @include('partials.scripts.simpleUpload',['route'=>'sliders'])
@endsection

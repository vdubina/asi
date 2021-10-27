@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.taxonomyCourseType.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.taxonomy-course-types.update", [$taxonomyCourseType->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.taxonomyCourseType.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $taxonomyCourseType->name) }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyCourseType.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.taxonomyCourseType.fields.description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description', $taxonomyCourseType->description) !!}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyCourseType.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="field_offsiteid">{{ trans('cruds.taxonomyCourseType.fields.field_offsiteid') }}</label>
                <input class="form-control {{ $errors->has('field_offsiteid') ? 'is-invalid' : '' }}" type="number" name="field_offsiteid" id="field_offsiteid" value="{{ old('field_offsiteid', $taxonomyCourseType->field_offsiteid) }}" step="1" required>
                @if($errors->has('field_offsiteid'))
                    <span class="text-danger">{{ $errors->first('field_offsiteid') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyCourseType.fields.field_offsiteid_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('field_adsubscribable') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="field_adsubscribable" value="0">
                    <input class="form-check-input" type="checkbox" name="field_adsubscribable" id="field_adsubscribable" value="1" {{ $taxonomyCourseType->field_adsubscribable || old('field_adsubscribable', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="field_adsubscribable">{{ trans('cruds.taxonomyCourseType.fields.field_adsubscribable') }}</label>
                </div>
                @if($errors->has('field_adsubscribable'))
                    <span class="text-danger">{{ $errors->first('field_adsubscribable') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyCourseType.fields.field_adsubscribable_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('field_custom_course_layout') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="field_custom_course_layout" value="0">
                    <input class="form-check-input" type="checkbox" name="field_custom_course_layout" id="field_custom_course_layout" value="1" {{ $taxonomyCourseType->field_custom_course_layout || old('field_custom_course_layout', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="field_custom_course_layout">{{ trans('cruds.taxonomyCourseType.fields.field_custom_course_layout') }}</label>
                </div>
                @if($errors->has('field_custom_course_layout'))
                    <span class="text-danger">{{ $errors->first('field_custom_course_layout') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyCourseType.fields.field_custom_course_layout_helper') }}</span>
            </div>
            <div class="form-group">
                @include('partials.buttons.save')
                @include('partials.buttons.back', ['url'=>route('admin.taxonomy-course-types.index')])
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
    @include('partials.scripts.simpleUpload',['route'=>'taxonomy-course-types', 'id'=>$taxonomyCourseType->id])
@endsection

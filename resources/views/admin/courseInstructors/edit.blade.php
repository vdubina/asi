@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.courseInstructor.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.course-instructors.update", [$courseInstructor->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.courseInstructor.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $courseInstructor->name) }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseInstructor.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.courseInstructor.fields.description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description', $courseInstructor->description) !!}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseInstructor.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="field_image">{{ trans('cruds.courseInstructor.fields.field_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('field_image') ? 'is-invalid' : '' }}" id="field_image-dropzone">
                </div>
                @if($errors->has('field_image'))
                    <span class="text-danger">{{ $errors->first('field_image') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseInstructor.fields.field_image_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="field_course_products">{{ trans('cruds.courseInstructor.fields.field_course_products') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('field_course_products') ? 'is-invalid' : '' }}" name="field_course_products[]" id="field_course_products" multiple>
                    @foreach($field_course_products as $id => $field_course_product)
                        <option value="{{ $id }}" {{ (in_array($id, old('field_course_products', [])) || $courseInstructor->field_course_products->contains($id)) ? 'selected' : '' }}>{{ $field_course_product }}</option>
                    @endforeach
                </select>
                @if($errors->has('field_course_products'))
                    <span class="text-danger">{{ $errors->first('field_course_products') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseInstructor.fields.field_course_products_helper') }}</span>
            </div>
            <div class="form-group">
                @include('partials.buttons.save')
                @include('partials.buttons.back', ['url'=>route('admin.course-instructors.index')])
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
    @include('partials.scripts.simpleUpload',['route'=>'content-blocks','id'=>$courseInstructor->id,])
    @include('partials.scripts.imagesDropzone',['route'=>'content-blocks','key'=>'field_image','current' => $courseInstructor->field_image])
@endsection

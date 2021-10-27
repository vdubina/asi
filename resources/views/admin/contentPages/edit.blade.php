@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.contentPage.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.content-pages.update", [$contentPage->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.contentPage.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $contentPage->title) }}" required>
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contentPage.fields.title_helper') }}</span>
            </div>
            <div class="form-group" style="display:none">
                <label for="categories">{{ trans('cruds.contentPage.fields.category') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('categories') ? 'is-invalid' : '' }}" name="categories[]" id="categories" multiple>
                    @foreach($categories as $id => $category)
                        <option value="{{ $id }}" {{ (in_array($id, old('categories', [])) || $contentPage->categories->contains($id)) ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
                @if($errors->has('categories'))
                    <span class="text-danger">{{ $errors->first('categories') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contentPage.fields.category_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tags">{{ trans('cruds.contentPage.fields.tag') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('tags') ? 'is-invalid' : '' }}" name="tags[]" id="tags" multiple>
                    @foreach($tags as $id => $tag)
                        <option value="{{ $id }}" {{ (in_array($id, old('tags', [])) || $contentPage->tags->contains($id)) ? 'selected' : '' }}>{{ $tag }}</option>
                    @endforeach
                </select>
                @if($errors->has('tags'))
                    <span class="text-danger">{{ $errors->first('tags') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contentPage.fields.tag_helper') }}</span>
            </div>
        <div class="form-group">
            <label for="slider_id">{{ trans('cruds.contentPage.fields.slider') }}</label>
            <select class="form-control select2 {{ $errors->has('slider') ? 'is-invalid' : '' }}" name="slider_id" id="slider_id">
                @foreach($sliders as $id => $entry)
                <option value="{{ $id }}" {{ (old('slider_id') ? old('slider_id') : $contentPage->slider->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                @endforeach
            </select>
            @if($errors->has('slider'))
            <span class="text-danger">{{ $errors->first('slider') }}</span>
            @endif
            <span class="help-block">{{ trans('cruds.contentPage.fields.slider_helper') }}</span>
        </div>
            <div class="form-group">
                <label for="page_text">{{ trans('cruds.contentPage.fields.page_text') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('page_text') ? 'is-invalid' : '' }}" name="page_text" id="page_text">{!! old('page_text', $contentPage->page_text) !!}</textarea>
                @if($errors->has('page_text'))
                    <span class="text-danger">{{ $errors->first('page_text') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contentPage.fields.page_text_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="excerpt">{{ trans('cruds.contentPage.fields.excerpt') }}</label>
                <textarea class="form-control {{ $errors->has('excerpt') ? 'is-invalid' : '' }}" name="excerpt" id="excerpt">{{ old('excerpt', $contentPage->excerpt) }}</textarea>
                @if($errors->has('excerpt'))
                    <span class="text-danger">{{ $errors->first('excerpt') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contentPage.fields.excerpt_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="featured_image">{{ trans('cruds.contentPage.fields.featured_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('featured_image') ? 'is-invalid' : '' }}" id="featured_image-dropzone">
                </div>
                @if($errors->has('featured_image'))
                    <span class="text-danger">{{ $errors->first('featured_image') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contentPage.fields.featured_image_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('field_is_subsite_content') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="field_is_subsite_content" value="0">
                    <input class="form-check-input" type="checkbox" name="field_is_subsite_content" id="field_is_subsite_content" value="1" {{ $contentPage->field_is_subsite_content || old('field_is_subsite_content', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="field_is_subsite_content">{{ trans('cruds.contentPage.fields.field_is_subsite_content') }}</label>
                </div>
                @if($errors->has('field_is_subsite_content'))
                    <span class="text-danger">{{ $errors->first('field_is_subsite_content') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contentPage.fields.field_is_subsite_content_helper') }}</span>
            </div>
            <div class="form-group">
                @include('partials.buttons.save')
                @include('partials.buttons.back', ['url'=>route('admin.content-pages.index')])
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
    @include('partials.scripts.simpleUpload',['route'=>'content-pages','id'=>$contentPage->id,])
    @include('partials.scripts.imagesDropzone',['route'=>'content-pages','key'=>'featured_image','current' => $contentPage->featured_image])
@endsection

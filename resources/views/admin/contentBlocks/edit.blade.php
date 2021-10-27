@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{$contentBlockType->name}} {{ trans('global.item') }} {{ trans('global.edit') }}
        </div>

        <div class="card-body">
            <form method="POST"
                  action="{{ route("admin.content-blocks.update", [$contentBlockType->id, $contentBlock->id]) }}"
                  enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="title">{{ trans('cruds.contentBlock.fields.title') }}</label>
                    <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title"
                           id="title" value="{{ old('title', $contentBlock->title) }}" required>
                    @if($errors->has('title'))
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.contentBlock.fields.title_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="content">{{ trans('cruds.contentBlock.fields.content') }}</label>
                    <textarea class="form-control ckeditor {{ $errors->has('content') ? 'is-invalid' : '' }}"
                              name="content" id="content">{!! old('content', $contentBlock->content) !!}</textarea>
                    @if($errors->has('content'))
                        <span class="text-danger">{{ $errors->first('content') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.contentBlock.fields.content_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="images">{{ trans('cruds.contentBlock.fields.images') }}</label>
                    <div class="needsclick dropzone {{ $errors->has('images') ? 'is-invalid' : '' }}"
                         id="images-dropzone">
                    </div>
                    @if($errors->has('images'))
                        <span class="text-danger">{{ $errors->first('images') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.contentBlock.fields.images_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="type_id">{{ trans('cruds.contentBlock.fields.type') }}</label>
                    <select class="form-control select2 {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type_id"
                            id="type_id" required>
                        @foreach($contentBlockTypes as $id => $entry)
                            <option
                                value="{{ $id }}" {{ (old('type_id') ? old('type_id') : $contentBlock->type->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('type'))
                        <span class="text-danger">{{ $errors->first('type') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.contentBlock.fields.type_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="show_on_pages">{{ trans('cruds.contentBlock.fields.show_on_pages') }}</label>
                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all"
                              style="border-radius: 0">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all"
                              style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('show_on_pages') ? 'is-invalid' : '' }}"
                            name="show_on_pages[]" id="show_on_pages" multiple>
                        @foreach($show_on_pages as $id => $show_on_page)
                            <option
                                value="{{ $id }}" {{ (in_array($id, old('show_on_pages', [])) || $contentBlock->show_on_pages->contains($id)) ? 'selected' : '' }}>{{ $show_on_page }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('show_on_pages'))
                        <span class="text-danger">{{ $errors->first('show_on_pages') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.contentBlock.fields.show_on_pages_helper') }}</span>
                </div>
                <div class="form-group">
                    @include('partials.buttons.save')
                    @include('partials.buttons.back', ['url'=>route('admin.content-blocks.index',$contentBlockType->id)])
                </div>
            </form>
        </div>
    </div>



@endsection

@section('scripts')
    @include('partials.scripts.simpleUpload',['route'=>'content-blocks','id'=>$contentBlock->id,])
    @include('partials.scripts.imagesDropzone',['route'=>'content-blocks','key'=>'images','current' => $contentBlock->images])
@endsection

@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.taxonomyArmsCode.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.taxonomy-arms-codes.update", [$taxonomyArmsCode->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.taxonomyArmsCode.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $taxonomyArmsCode->name) }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyArmsCode.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.taxonomyArmsCode.fields.description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description', $taxonomyArmsCode->description) !!}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyArmsCode.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="field_offsiteid">{{ trans('cruds.taxonomyArmsCode.fields.field_offsiteid') }}</label>
                <input class="form-control {{ $errors->has('field_offsiteid') ? 'is-invalid' : '' }}" type="number" name="field_offsiteid" id="field_offsiteid" value="{{ old('field_offsiteid', $taxonomyArmsCode->field_offsiteid) }}" step="1" required>
                @if($errors->has('field_offsiteid'))
                    <span class="text-danger">{{ $errors->first('field_offsiteid') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyArmsCode.fields.field_offsiteid_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="field_arms_category_id">{{ trans('cruds.taxonomyArmsCode.fields.field_arms_category') }}</label>
                <select class="form-control select2 {{ $errors->has('field_arms_category') ? 'is-invalid' : '' }}" name="field_arms_category_id" id="field_arms_category_id" required>
                    @foreach($field_arms_categories as $id => $entry)
                        <option value="{{ $id }}" {{ (old('field_arms_category_id') ? old('field_arms_category_id') : $taxonomyArmsCode->field_arms_category->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('field_arms_category'))
                    <span class="text-danger">{{ $errors->first('field_arms_category') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyArmsCode.fields.field_arms_category_helper') }}</span>
            </div>
            <div class="form-group">
                @include('partials.buttons.save')
                @include('partials.buttons.back', ['url'=>route('admin.taxonomy-arms-codes.index')])
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
    @include('partials.scripts.simpleUpload',['route'=>'taxonomy-arms-codes', 'id'=>$taxonomyArmsCode->id])
@endsection

@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.taxonomyCertificationType.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.taxonomy-certification-types.update", [$taxonomyCertificationType->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.taxonomyCertificationType.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $taxonomyCertificationType->name) }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyCertificationType.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.taxonomyCertificationType.fields.description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description', $taxonomyCertificationType->description) !!}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyCertificationType.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="field_offsiteid">{{ trans('cruds.taxonomyCertificationType.fields.field_offsiteid') }}</label>
                <input class="form-control {{ $errors->has('field_offsiteid') ? 'is-invalid' : '' }}" type="number" name="field_offsiteid" id="field_offsiteid" value="{{ old('field_offsiteid', $taxonomyCertificationType->field_offsiteid) }}" step="1" required>
                @if($errors->has('field_offsiteid'))
                    <span class="text-danger">{{ $errors->first('field_offsiteid') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyCertificationType.fields.field_offsiteid_helper') }}</span>
            </div>
            <div class="form-group">
                @include('partials.buttons.save')
                @include('partials.buttons.back', ['url'=>route('admin.taxonomy-certification-types.index')])
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
    @include('partials.scripts.simpleUpload',['route'=>'taxonomy-certification-types', 'id'=>$taxonomyCertificationType->id])
@endsection

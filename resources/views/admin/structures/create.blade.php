@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.structure.title_node') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.structures.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="label">{{ trans('cruds.structure.fields.label') }}</label>
                <input class="form-control {{ $errors->has('label') ? 'is-invalid' : '' }}" type="text" name="label" id="label" value="{{ old('label', '') }}" required>
                @if($errors->has('label'))
                    <span class="text-danger">{{ $errors->first('label') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.structure.fields.label_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.structure.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type" required>
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Structure::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <span class="text-danger">{{ $errors->first('type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.structure.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link">{{ trans('cruds.structure.fields.link') }}</label>
                <input class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}" type="text" name="link" id="link" value="{{ old('link', '') }}">
                @if($errors->has('link'))
                    <span class="text-danger">{{ $errors->first('link') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.structure.fields.link_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('external') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="external" value="0">
                    <input class="form-check-input" type="checkbox" name="external" id="external" value="1" {{ old('external', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="external">{{ trans('cruds.structure.fields.external') }}</label>
                </div>
                @if($errors->has('external'))
                    <span class="text-danger">{{ $errors->first('external') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.structure.fields.external_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="page_id">{{ trans('cruds.structure.fields.page') }}</label>
                <select class="form-control select2 {{ $errors->has('page') ? 'is-invalid' : '' }}" name="page_id" id="page_id">
                    @foreach($pages as $id => $entry)
                        <option value="{{ $id }}" {{ old('page_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('page'))
                    <span class="text-danger">{{ $errors->first('page') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.structure.fields.page_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

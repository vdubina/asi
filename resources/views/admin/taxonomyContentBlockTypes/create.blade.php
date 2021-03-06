@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.taxonomyContentBlockType.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.taxonomy-content-block-types.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.taxonomyContentBlockType.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyContentBlockType.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="fa_icon">{{ trans('cruds.taxonomyContentBlockType.fields.fa_icon') }}</label>
                <input class="form-control {{ $errors->has('fa_icon') ? 'is-invalid' : '' }}" type="text" name="fa_icon" id="fa_icon" value="{{ old('fa_icon', 'tag') }}">
                @if($errors->has('fa_icon'))
                    <span class="text-danger">{{ $errors->first('fa_icon') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyContentBlockType.fields.fa_icon_helper') }}</span>
            </div>
            <div class="form-group">
                @include('partials.buttons.save')
            </div>
        </form>
    </div>
</div>



@endsection

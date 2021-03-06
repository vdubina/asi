@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.taxonomyTag.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.taxonomy-tags.update", [$taxonomyTag->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.taxonomyTag.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $taxonomyTag->name) }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyTag.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                @include('partials.buttons.save')
                @include('partials.buttons.back', ['url'=>route('admin.taxonomy-tags.index')])
            </div>
        </form>
    </div>
</div>



@endsection

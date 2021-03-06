@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.taxonomyProfession.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.taxonomy-professions.update", [$taxonomyProfession->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.taxonomyProfession.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $taxonomyProfession->name) }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyProfession.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.taxonomyProfession.fields.description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description', $taxonomyProfession->description) !!}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyProfession.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="field_offsiteid">{{ trans('cruds.taxonomyProfession.fields.field_offsiteid') }}</label>
                <input class="form-control {{ $errors->has('field_offsiteid') ? 'is-invalid' : '' }}" type="number" name="field_offsiteid" id="field_offsiteid" value="{{ old('field_offsiteid', $taxonomyProfession->field_offsiteid) }}" step="1" required>
                @if($errors->has('field_offsiteid'))
                    <span class="text-danger">{{ $errors->first('field_offsiteid') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyProfession.fields.field_offsiteid_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="field_salutation">{{ trans('cruds.taxonomyProfession.fields.field_salutation') }}</label>
                <input class="form-control {{ $errors->has('field_salutation') ? 'is-invalid' : '' }}" type="text" name="field_salutation" id="field_salutation" value="{{ old('field_salutation', $taxonomyProfession->field_salutation) }}">
                @if($errors->has('field_salutation'))
                    <span class="text-danger">{{ $errors->first('field_salutation') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyProfession.fields.field_salutation_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('field_allied_professional') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="field_allied_professional" value="0">
                    <input class="form-check-input" type="checkbox" name="field_allied_professional" id="field_allied_professional" value="1" {{ $taxonomyProfession->field_allied_professional || old('field_allied_professional', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="field_allied_professional">{{ trans('cruds.taxonomyProfession.fields.field_allied_professional') }}</label>
                </div>
                @if($errors->has('field_allied_professional'))
                    <span class="text-danger">{{ $errors->first('field_allied_professional') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyProfession.fields.field_allied_professional_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="field_ad_customer_category">{{ trans('cruds.taxonomyProfession.fields.field_ad_customer_category') }}</label>
                <input class="form-control {{ $errors->has('field_ad_customer_category') ? 'is-invalid' : '' }}" type="text" name="field_ad_customer_category" id="field_ad_customer_category" value="{{ old('field_ad_customer_category', $taxonomyProfession->field_ad_customer_category) }}">
                @if($errors->has('field_ad_customer_category'))
                    <span class="text-danger">{{ $errors->first('field_ad_customer_category') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyProfession.fields.field_ad_customer_category_helper') }}</span>
            </div>
            <div class="form-group">
                @include('partials.buttons.save')
                @include('partials.buttons.back', ['url'=>route('admin.taxonomy-professions.index')])
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
    @include('partials.scripts.simpleUpload',['route'=>'taxonomy-professions', 'id'=>$taxonomyProfession->id])
@endsection

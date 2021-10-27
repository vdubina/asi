@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.taxonomyAdService.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.taxonomy-ad-services.update", [$taxonomyAdService->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.taxonomyAdService.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $taxonomyAdService->name) }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyAdService.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.taxonomyAdService.fields.description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description', $taxonomyAdService->description) !!}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyAdService.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="field_offsiteid">{{ trans('cruds.taxonomyAdService.fields.field_offsiteid') }}</label>
                <input class="form-control {{ $errors->has('field_offsiteid') ? 'is-invalid' : '' }}" type="number" name="field_offsiteid" id="field_offsiteid" value="{{ old('field_offsiteid', $taxonomyAdService->field_offsiteid) }}" step="1" required>
                @if($errors->has('field_offsiteid'))
                    <span class="text-danger">{{ $errors->first('field_offsiteid') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyAdService.fields.field_offsiteid_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="field_ad_service_code">{{ trans('cruds.taxonomyAdService.fields.field_ad_service_code') }}</label>
                <input class="form-control {{ $errors->has('field_ad_service_code') ? 'is-invalid' : '' }}" type="text" name="field_ad_service_code" id="field_ad_service_code" value="{{ old('field_ad_service_code', $taxonomyAdService->field_ad_service_code) }}" required>
                @if($errors->has('field_ad_service_code'))
                    <span class="text-danger">{{ $errors->first('field_ad_service_code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyAdService.fields.field_ad_service_code_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('field_audio_digest_subscription') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="field_audio_digest_subscription" value="0">
                    <input class="form-check-input" type="checkbox" name="field_audio_digest_subscription" id="field_audio_digest_subscription" value="1" {{ $taxonomyAdService->field_audio_digest_subscription || old('field_audio_digest_subscription', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="field_audio_digest_subscription">{{ trans('cruds.taxonomyAdService.fields.field_audio_digest_subscription') }}</label>
                </div>
                @if($errors->has('field_audio_digest_subscription'))
                    <span class="text-danger">{{ $errors->first('field_audio_digest_subscription') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyAdService.fields.field_audio_digest_subscription_helper') }}</span>
            </div>
            <div class="form-group">
                @include('partials.buttons.save')
                @include('partials.buttons.back', ['url'=>route('admin.taxonomy-ad-services.index')])
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
    @include('partials.scripts.simpleUpload',['route'=>'taxonomy-ad-services', 'id'=>$taxonomyAdService->id])
@endsection

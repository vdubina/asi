@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.taxonomyAdService.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.taxonomy-ad-services.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.taxonomyAdService.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyAdService.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.taxonomyAdService.fields.description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description') !!}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyAdService.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="field_offsiteid">{{ trans('cruds.taxonomyAdService.fields.field_offsiteid') }}</label>
                <input class="form-control {{ $errors->has('field_offsiteid') ? 'is-invalid' : '' }}" type="number" name="field_offsiteid" id="field_offsiteid" value="{{ old('field_offsiteid', '') }}" step="1" required>
                @if($errors->has('field_offsiteid'))
                    <span class="text-danger">{{ $errors->first('field_offsiteid') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyAdService.fields.field_offsiteid_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="field_ad_service_code">{{ trans('cruds.taxonomyAdService.fields.field_ad_service_code') }}</label>
                <input class="form-control {{ $errors->has('field_ad_service_code') ? 'is-invalid' : '' }}" type="text" name="field_ad_service_code" id="field_ad_service_code" value="{{ old('field_ad_service_code', '') }}" required>
                @if($errors->has('field_ad_service_code'))
                    <span class="text-danger">{{ $errors->first('field_ad_service_code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyAdService.fields.field_ad_service_code_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('field_audio_digest_subscription') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="field_audio_digest_subscription" value="0">
                    <input class="form-check-input" type="checkbox" name="field_audio_digest_subscription" id="field_audio_digest_subscription" value="1" {{ old('field_audio_digest_subscription', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="field_audio_digest_subscription">{{ trans('cruds.taxonomyAdService.fields.field_audio_digest_subscription') }}</label>
                </div>
                @if($errors->has('field_audio_digest_subscription'))
                    <span class="text-danger">{{ $errors->first('field_audio_digest_subscription') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.taxonomyAdService.fields.field_audio_digest_subscription_helper') }}</span>
            </div>
            <div class="form-group">
                @include('partials.buttons.save')
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.taxonomy-ad-services.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $taxonomyAdService->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

@endsection
